<?php

namespace Drupal\social_login\Controller;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

/**
 * Contains the callback handler used by the OneAll Social Login Module.
 */
class SocialLoginController extends ControllerBase
{
    /**
     * This is the callback handler (referenced by routing.yml).
     */
    public function callbackHandler()
    {
        // Read Settings.
        $settings = social_login_get_settings();

        // No need to do anything if we haven't received these arguments.
        if (isset($_POST) && !empty($_POST['connection_token']) && !empty($_POST['oa_action']) && in_array($_POST['oa_action'], ['social_login', 'social_link']))
        {
            // Add system log.
            \Drupal::logger('social_login')->error('Callback handler called using connection_token @connection_token.', [
                '@connection_token' => $_POST['connection_token']
            ]);

            // Clear session.
            social_login_clear_session();

            // API Connection Credentials.
            $api_subdomain = (!empty($settings['api_subdomain']) ? $settings['api_subdomain'] : '');
            $api_key = (!empty($settings['api_key']) ? $settings['api_key'] : '');
            $api_secret = (!empty($settings['api_secret']) ? $settings['api_secret'] : '');

            // API Connection Handler.
            $handler = (!empty($settings['http_handler']) ? $settings['http_handler'] : 'curl');
            $handler = ($handler == 'fsockopen' ? 'fsockopen' : 'curl');

            // API Connection Protocol.
            $protocol = (!empty($settings['http_protocol']) ? $settings['http_protocol'] : 'https');
            $protocol = ($protocol == 'http' ? 'http' : 'https');

            // Automatic or manual registration?
            $registration_method = (!empty($settings['registration_method']) ? $settings['registration_method'] : '');
            $registration_method = (in_array($registration_method, ['manual', 'auto_random_email', 'auto_manual_email']) ? $registration_method : 'manual');

            // Require approval?
            $registration_approval = (!empty($settings['registration_approval']) ? $settings['registration_approval'] : '');
            $registration_approval = (in_array($registration_approval, ['inherit', 'disable', 'enable']) ? $registration_approval : 'inherit');

            // Retrieved connection_token.
            $token = trim($_POST['connection_token']);

            // Settings missing.
            if (empty($api_subdomain) || empty($api_key) || empty($api_secret)) {

                // User message.
                drupal_set_message($this->t('OneAll Social Login is not setup correctly, please request the administrator to verify the API Settings'), 'error');

                // Add log.
                \Drupal::logger('social_login')->error('Unable to use Social Login, the API Settings are not filled out correctly.');

                // Redirect to homepage.
                return social_login_redirect ('drupal.home');
            }
            // Settings filled out.
            else
            {
                // Request connection details.
                $data = social_login_do_api_request($handler, $protocol . '://' . $api_subdomain . '.api.oneall.com/connections/' . $token . '.json', [
                    'api_key' => $api_key,
                    'api_secret' => $api_secret
                ]);

                if (is_array($data) && !empty($data['http_data']))
                {
                    // Decode result.
                    $social_data = Json::decode($data['http_data']);

                    // Everything seems to be ok.
                    if (is_array($social_data) && isset($social_data['response']) && isset($social_data['response']['request']['status']['code']))
                    {
                        // Retrieve the response data.
                        $data = $social_data['response']['result']['data'];

                        // Success
                        if ($social_data['response']['request']['status']['code'] == 200)
                        {
                            // Save the social network data in a session.
                            $_SESSION['social_login_session_open'] = 1;
                            $_SESSION['social_login_social_data'] = serialize($social_data);

                            // Unique user_token.
                            $user_token = $data['user']['user_token'];

                            // Extract identity.
                            $identity = $data['user']['identity'];

                            // Unique identity_token.
                            $identity_token = $identity['identity_token'];

                            // Social Network that has been used to connect.
                            $provider_name = (!empty($identity['source']['name']) ? $identity['source']['name'] : $this->t('Unkown'));

                            // Try restoring the user for the token.
                            $user_for_token = social_login_get_user_for_user_token($user_token);

                            // Existing user.
                            if (is_object($user_for_token) && !empty($user_for_token->id()))
                            {
                                // Existing User Token: Social Login.
                                if ($data['plugin']['key'] == 'social_login')
                                {
                                    // Make sure that the user has not been blocked.
                                    $name = $user_for_token->get('name')->value;

                                    // The user is not blocked.
                                    if (!user_is_blocked($name))
                                    {
                                        // Login the user.
                                        user_login_finalize($user_for_token);

                                        // Clear session.
                                        social_login_clear_session();

                                        // Redirect to specified page.
                                        return social_login_redirect ('settings.login', $user_for_token->id());
                                    }
                                    // The user is blocked.
                                    else
                                    {
                                        // User message.
                                        drupal_set_message($this->t('Your account is blocked.'), 'error');

                                        // Clear session.
                                        social_login_clear_session();

                                        // Redirect to home.
                                        return social_login_redirect ('drupal.home');
                                    }
                                }
                                // Existing User Token: Social Link.
                                elseif ($data['plugin']['key'] == 'social_link')
                                {
                                    // The user must be logged in.
                                    $user = \Drupal::currentUser();

                                    // User is logged in.
                                    if (is_object($user) && $user->isAuthenticated())
                                    {
                                        // The existing token does not match the current user!
                                        if ($user_for_token->id() != $user->id())
                                        {
                                            drupal_set_message($this->t('This @social_network account is already linked to another user.', [
                                                '@social_network' => $provider_name
                                            ]), 'error');
                                        }
                                        // The existing token matches the current user!
                                        else
                                        {
                                            // Link identity.
                                            if ($data['plugin']['data']['action'] == 'link_identity')
                                            {
                                                // Add mapping.
                                                social_login_map_identity_token_to_user_token($user, $identity_token, $user_token, $provider_name);

                                                // Add user message.
                                                drupal_set_message($this->t('The @social_network account has been linked to your account.', [
                                                    '@social_network' => $provider_name
                                                ]), 'status');

                                                // Add log.
                                                \Drupal::logger('social_login')->notice('@name has linked his @provider account, identity @identity_token.', [
                                                    '@name' => $user->getAccountName(),
                                                    '@provider' => $provider_name,
                                                    '@identity_token' => $identity_token
                                                ]);
                                            }
                                            // Unlink identity.
                                            else
                                            {
                                                // Remove mapping.
                                                social_login_unmap_identity_token($identity_token);

                                                // Add user message.
                                                drupal_set_message($this->t('The social network account has been unlinked from your account.'), 'status');

                                                // Add log.
                                                \Drupal::logger('social_login')->notice('@name has unlinked a social network account, identity @identity_token.', [
                                                    '@name' => $user->getAccountName(),
                                                    '@identity_token' => $identity_token
                                                ]);
                                            }

                                            // Clear session.
                                            social_login_clear_session();
                                        }

                                        // Redirect to previous page.
                                        if (!empty($_GET['origin']))
                                        {
                                            return social_login_redirect ('custom.url', $_GET['origin']);
                                        }
                                        // Redirect to profile page.
                                        else
                                        {
                                            return social_login_redirect ('drupal.profile');
                                        }
                                    }
                                    // User is not logged in.
                                    else
                                    {
                                        drupal_set_message($this->t('You must be logged in to perform this action.'), 'error');

                                        // Clear session.
                                        social_login_clear_session();

                                        // Redirect to home.
                                        return social_login_redirect ('drupal.home');
                                    }
                                }
                            }
                            // New User.
                            else
                            {
                                // No Existing User Token: Social Link.
                                if ($data['plugin']['key'] == 'social_link')
                                {
                                    // The user should be logged in.
                                    $user = \Drupal::currentUser();

                                    // User is logged in.
                                    if (is_object($user) && $user->isAuthenticated())
                                    {
                                        // Link identity.
                                        if ($data['plugin']['data']['action'] == 'link_identity')
                                        {
                                            // Add mapping.
                                            social_login_map_identity_token_to_user_token($user, $identity_token, $user_token, $provider_name);

                                            // Add user message.
                                            drupal_set_message($this->t('The @social_network account has been linked to your account.', [
                                                '@social_network' => $provider_name
                                            ]), 'status');

                                            // Add log.
                                            \Drupal::logger('social_login')->notice('@name has linked his @provider account, identity @identity_token.', [
                                                '@name' => $user->getAccountName(),
                                                '@provider' => $provider_name,
                                                '@identity_token' => $identity_token
                                            ]);
                                        }
                                        // Unlink identity.
                                        else
                                        {
                                            // Remove mapping.
                                            social_login_unmap_identity_token($identity_token);

                                            // Add user message.
                                            drupal_set_message($this->t('The social network account has been unlinked from your account.'), 'status');
                                        }

                                        // Clear session.
                                        social_login_clear_session();

                                        // Redirect to previous page.
                                        if (!empty($_GET['origin']))
                                        {
                                             return social_login_redirect ('custom.url', $_GET['origin']);
                                        }
                                        // Redirect to profile page.
                                        else
                                        {
                                            return social_login_redirect ('drupal.profile');
                                        }
                                    }
                                    // User is not logged in.
                                    else
                                    {
                                        // Add user message.
                                        drupal_set_message($this->t('You must be logged in to perform this action.'), 'error');

                                        // Clear session.
                                        social_login_clear_session();

                                        // Redirect to home.
                                        return social_login_redirect ('drupal.home');
                                    }
                                }
                                // No Existing User: Social Login (Default)
                                else
                                {
                                    // New users may register.
                                    if (\Drupal::config('user.settings')->get('register') != USER_REGISTER_ADMINISTRATORS_ONLY)
                                    {
                                        // Extract the user's email address.
                                        $user_email = '';
                                        $user_email_is_verified = null;
                                        $user_email_is_random = null;

                                        // Do we have any emails in the profile data?
                                        if (isset($identity['emails']) && is_array($identity['emails']))
                                        {
                                            // Extract email address.
                                            foreach ($identity['emails'] AS $email)
                                            {
                                               $user_email = $email['value'];
                                               $user_email_is_verified = (!empty($email['is_verified']) ? true : false);
                                               $user_email_is_random = false;

                                               // Stop once we have found a verified email address.
                                               if ($user_email_is_verified)
                                               {
                                                   break;
                                               }
                                            }
                                        }

                                        // The admin has chosen the automatic registration.
                                        if ($registration_method != 'manual')
                                        {
                                            // No email address / Email address already exists.
                                            if (empty($user_email) || social_login_get_uid_for_email($user_email) !== false)
                                            {
                                                // The admin wants users to fill out their email manually.
                                                if ($registration_method == 'auto_manual_email')
                                                {
                                                    // We have to fall back to the default registration.
                                                    $registration_method = 'manual';
                                                }
                                                // The admin has enabled the usage of random emails.
                                                else
                                                {
                                                    // Create a bogus email.
                                                    $user_email = social_login_create_random_email();

                                                    // Flag - is used further down.
                                                    $user_email_is_random = true;
                                                }
                                            }
                                        }

                                        // Automatic registration is enabled.
                                        if ($registration_method != 'manual')
                                        {
                                            // If something goes wrong fall back to manual registration.
                                            $registration_method = 'manual';

                                            // Extract firstname.
                                            $user_first_name = (!empty($identity['name']['givenName']) ? $identity['name']['givenName'] : '');

                                            // Extract lastname.
                                            $user_last_name = (!empty($identity['name']['familyName']) ? $identity['name']['familyName'] : '');

                                            // Forge login.
                                            $user_login = '';
                                            if (!empty($identity['preferredUsername']))
                                            {
                                                $user_login = $identity['preferredUsername'];
                                            }
                                            elseif (!empty($identity['displayName']))
                                            {
                                                $user_login = $identity['displayName'];
                                            }
                                            elseif (!empty($identity['name']['formatted']))
                                            {
                                                $user_login = $identity['name']['formatted'];
                                            }
                                            else
                                            {
                                                $user_login = trim($user_first_name . ' ' . $user_last_name);
                                            }

                                            // The username cannot begin/end with a space.
                                            $user_login = trim ($user_login);

                                            // The username cannot contain multiple spaces in a row.
                                            $user_login = preg_replace('!\s+!', ' ', $user_login);

                                            // Forge unique username.
                                            if (strlen(trim($user_login)) == 0 || social_login_get_uid_for_name(trim($user_login)) !== false)
                                            {
                                                $i = 1;
                                                $user_login = $provider_name . $this->t('User');
                                                while (social_login_get_uid_for_name($user_login) !== false)
                                                {
                                                    $user_login = $provider_name . $this->t('User') . ($i++);
                                                }
                                            }

                                            // Forge password.
                                            $user_password = user_password(8);

                                            // Check the approval setting.
                                            switch ($registration_approval)
                                            {
                                                // No approval required.
                                                case 'disable':
                                                    $user_status = 1;
                                                    break;

                                                // Manual approval required.
                                                case 'enable':
                                                    $user_status = 0;
                                                    break;

                                                // Use the system-wide setting.
                                                default:
                                                    $user_status = ((\Drupal::config('user.settings')->get('register') == USER_REGISTER_VISITORS) ? 1 : 0);
                                                    break;
                                            }

                                            // Real user accounts get the authenticated user role.
                                            $user_roles = [];

                                            // Make sure at least one module implements our hook.
                                            if (count(\Drupal::moduleHandler()->getImplementations('social_login_default_user_roles')) > 0)
                                            {
                                                // Call modules that implement the hook.
                                                $user_roles = \Drupal::moduleHandler()->invokeAll('social_login_default_user_roles', $user_roles);
                                            }

                                            // Setup the user fields.
                                            $user_fields = [
                                                'name' => $user_login,
                                                'mail' => $user_email,
                                                'pass' => $user_password,
                                                'status' => $user_status,
                                                'init' => $user_email,
                                                'roles' => $user_roles
                                            ];

                                            // Create a new user.
                                            $account = \Drupal\user\Entity\User::create($user_fields);
                                            $account->save();

                                            // The new account has been created correctly.
                                            if ($account !== false)
                                            {
                                                // Add log.
                                                \Drupal::logger('social_login')->notice('@name has registered using @provider (@identity_token).', [
                                                    '@name' => $user_login,
                                                    '@provider' => $provider_name,
                                                    '@identity_token' => $identity_token
                                                ]);

                                                // Disable Drupal legacy registration.
                                                $registration_method = 'auto';

                                                // Log the new user in.
                                                if (($uid = \Drupal::service("user.auth")->authenticate($user_login, $user_password)) !== false)
                                                {

                                                    // Loads a user object.
                                                    $user = \Drupal\user\Entity\User::load($uid);

                                                    // Login.
                                                    user_login_finalize($user);

                                                    // Send email, but only if it's not a random address.
                                                    if ($user_email_is_random !== true)
                                                    {

                                                        // No approval is required.
                                                        if ($user_status == 1)
                                                        {
                                                            _user_mail_notify('register_no_approval_required', $user);
                                                            drupal_set_message($this->t('You have successfully created an account and linked it with your @social_network account.', [
                                                                '@social_network' => $provider_name
                                                            ]), 'status');

                                                            // Redirect
                                                            return social_login_redirect ('settings.register', $uid);
                                                        }
                                                        // Approval is required.
                                                        else
                                                        {
                                                            _user_mail_notify('register_pending_approval', $user);
                                                            drupal_set_message($this->t('Thank you for applying for an account. Your account is currently pending approval by the site administrator.<br />You will receive an email once your account has been approved and you can then login with your @social_network account.', [
                                                                '@social_network' => $provider_name
                                                            ]), 'status');

                                                            // Redirect
                                                            return social_login_redirect ('drupal.home');
                                                        }
                                                    }
                                                    // Random email used.
                                                    else
                                                    {
                                                        // Add user message.
                                                        drupal_set_message($this->t('You have successfully created an account and linked it with your @provider account.', [
                                                            '@provider' => $provider_name
                                                        ]), 'status');

                                                        // Redirect.
                                                        return social_login_redirect ('settings.register', $uid);
                                                    }
                                                }
                                                // For some reason we could not log the user in.
                                                else
                                                {
                                                    // Add user message.
                                                    drupal_set_message($this->t('Error while logging you in, please try to login manually.'), 'error');

                                                    // Add system log.
                                                    \Drupal::logger('social_login')->error('Could not create login user @name. User tried to registered using @provider (@identity_token).', [
                                                        '@name' => $user_login,
                                                        '@provider' => $provider_name,
                                                        '@identity_token' => $identity_token
                                                    ]);

                                                    // Redirect to login page to login manually.
                                                    return social_login_redirect ('drupal.login');
                                                }
                                            }
                                            // An error occured during user_save().
                                            else
                                            {
                                                // Add user message.
                                                drupal_set_message($this->t('Error while creating your user account, please try to register manually.'), 'error');

                                                // Add system log.
                                                \Drupal::logger('social_login')->error('Could not save account for user @name. User tried to registered using @provider (@identity_token).', [
                                                    '@name' => $user_login,
                                                    '@provider' => $provider_name,
                                                    '@identity_token' => $identity_token
                                                ]);

                                                // Redirect to registration page to register manually.
                                                return social_login_redirect ('drupal.register');
                                            }
                                        }

                                        // Use the legacy registration form?
                                        if ($registration_method == 'manual')
                                        {
                                            // Go to the registration page (+ prepopulate form).
                                            return social_login_redirect ('drupal.register');
                                        }
                                    }
                                    // Registration is disabled.
                                    else
                                    {
                                        // Add system log.
                                        \Drupal::logger('social_login')->error('Could not create account for user @name. Only admins may create accounts. User tried to registered using @provider (@identity_token).', [
                                            '@name' => $user_login,
                                            '@provider' => $provider_name,
                                            '@identity_token' => $identity_token
                                        ]);

                                        // Add user message.
                                        drupal_set_message($this->t('Only site administrators can create new user accounts.'), 'error');

                                        // Return to homepage.
                                        return social_login_redirect ('drupal.home');
                                    }
                                }
                            }
                        }
                        // Error
                        else
                        {
                            // Success
                            if ($social_data['response']['request']['status']['code'] == 400)
                            {
                                // Link identity.
                                if ($data['plugin']['data']['action'] == 'link_identity')
                                {
                                    // Already linked.
                                    if ($data['plugin']['data']['reason'] == 'identity_is_linked_to_another_user')
                                    {
                                        // Add user message.
                                        drupal_set_message($this->t('This social network account is already linked to another user. First logout and then login with that social network account.'), 'error');

                                        // Redirect to previous page.
                                        if (!empty($_GET['origin']))
                                        {
                                            return social_login_redirect ('custom.url', $_GET['origin']);
                                        }
                                        // Redirect to profile page.
                                        else
                                        {
                                            return social_login_redirect ('drupal.profile');
                                        }
                                    }
                                }
                            }
                        }
                    }
                    // Invalid response.
                    else
                    {
                        // Add user message.
                        drupal_set_message($this->t('OneAll Social Login is not setup correctly, please request the administrator to verify the API Settings'), 'error');

                        // Add log.
                        \Drupal::logger('social_login')->error('Invalid RESPONSE received from OneAll API.');

                        // Return to homepage.
                        return social_login_redirect ('drupal.home');
                    }
                }
                else
                {
                    // Add user message.
                    drupal_set_message($this->t('OneAll Social Login is not setup correctly, please request the administrator to verify the API Settings'), 'error');

                    // Add log.
                    \Drupal::logger('social_login')->error('Invalid JSON received from OneAll API.');

                    // Return to homepage.
                    return social_login_redirect ('drupal.home');
                }
            }
        }
        // Invalid callback arguments.
        else
        {
            // Return to homepage.
            return social_login_redirect ('drupal.home');
        }

        // Some other unhandled case.
        return social_login_redirect ('drupal.home');
    }
}
