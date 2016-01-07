<?php

namespace Drupal\social_login\Controller;

use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Component\Utility\Unicode;

/**
 * Contains the callback handler used by the OneAll Social Login Module.
 */
class SocialLoginCore extends ControllerBase
{
	/**
	 * This is the callback handler (referenced by routing.yml).
	 */
	public function callback_handler() {

		// Read Settings.
		$settings = \social_login_get_settings();

		// No need to do anything if we haven't received these arguments.
		if (isset($_POST) && !empty($_POST['connection_token']) && !empty($_POST['oa_action']) && in_array($_POST['oa_action'], array('social_login', 'social_link'))) {

			// Clear session.
			\social_login_clear_session();
			
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
			$registration_method = (in_array($registration_method, array(
					'manual',
					'auto_random_email',
					'auto_manual_email',
			)) ? $registration_method : 'manual');

			// Require approval?
			$registration_approval = (!empty($settings['registration_approval']) ? $settings['registration_approval'] : '');
			$registration_approval = (in_array($registration_approval, array(
					'inherit',
					'disable',
					'enable',
			)) ? $registration_approval : 'inherit');

			// Retrieved connection_token.
			$token = trim($_POST['connection_token']);

			// Settings missing.
			if (empty($api_subdomain) || empty($api_key) || empty($api_secret)) {
				drupal_set_message(t('OneAll Social Login is not setup correctly, please request the administrator to verify the API Settings'), 'error');
				\Drupal::logger('social_login')->notice('The API Settings are not filled out correctly', array());
			}
			// Settings filled out.
			else {

				// Request identity details API.
				$data = \social_login_do_api_request($handler, $protocol . '://' . $api_subdomain . '.api.oneall.com/connections/' . $token . '.json', array(
						'api_key' => $api_key,
						'api_secret' => $api_secret,
				));

				if (is_array($data) && !empty($data['http_data'])) {
					$social_data = @\Drupal\Component\Serialization\Json::decode($data['http_data']);

					// Everything seems to be ok.
					if (is_array($social_data) && isset($social_data['response']) && isset($social_data['response']['request']['status']['code']) && $social_data['response']['request']['status']['code'] == 200) {

						// The plugin that has been uses social_login/social_link.
						$data = $social_data['response']['result']['data'];

						// Save the social network data in a session.
						$_SESSION['social_login_session_open'] = 1;
						$_SESSION['social_login_session_time'] = time();
						$_SESSION['social_login_social_data'] = serialize($social_data);
						$_SESSION['social_login_origin'] = (!empty($_GET['origin']) ? $_GET['origin'] : '');

						// Unique user_token.
						$user_token = $data['user']['user_token'];

						// Extract identity.
						$identity = $data['user']['identity'];

						// Unique identity_token.
						$identity_token = $identity['identity_token'];

						// Social Network that has been used to connect.
						$provider_name = (!empty($identity['source']['name']) ? $identity['source']['name'] : t('Unkown'));

						// Try restoring the user for the token.
						$user_for_token = \social_login_get_user_for_user_token($user_token);
						
						// Existing user.
						if (is_object($user_for_token) && !empty($user_for_token->id())) {
							
							// Social Login Plugin used?
							if ($data['plugin']['key'] == 'social_login') {
								// Make sure that the user has not been blocked.
								$name = $user_for_token->get('name')->value;
								// $user_for_token->getAccountName();
								if (!user_is_blocked($name)) {
									user_login_finalize($user_for_token);
								} 
								else {
									drupal_set_message(t('Your account is blocked.'), 'error');
									// Clear session.
									\social_login_clear_session();
								}
							}
							// Social Link Plugin used?
							elseif ($data['plugin']['key'] == 'social_link') {

								// The user should be logged in.
								$user = \Drupal::currentUser();

								// User is logged in.
								if (is_object($user) && $user->isAuthenticated()) {

									// The existing token does not match the current user!
									if ($user_for_token->id() <> $user->id()) {
										drupal_set_message(t('This @social_network account is already linked to another user.', array(
												'@social_network' => $provider_name,
										)), 'error');
									}
									// The existing token matches the current user!
									else {
										// Link identity.
										if ($data['plugin']['data']['action'] == 'link_identity') {
											\social_login_map_identity_token_to_user_token($user, $identity_token, $user_token, $provider_name);
											drupal_set_message(t('The @social_network account has been linked to your account.', array(
													'@social_network' => $provider_name,
											)), 'status');
										}
										// Unlink identity.
										else {
											\social_login_unmap_identity_token($identity_token);
											drupal_set_message(t('The social network account has been unlinked from your account.'), 'status');
										}

										// Clear session.
										\social_login_clear_session();

										// Redirect to profile.
										\Drupal::logger('social_login')->notice('- '. __FUNCTION__ .'@'. __LINE__ .' redirecting to '. \Drupal::url('user.page'));
										return new RedirectResponse(\Drupal::url('user.page'));
									}
								}
								// User is not logged in.
								else {
									drupal_set_message(t('You must be logged in to perform this action.'), 'error');

									// Clear session.
									\social_login_clear_session();

									// Redirect to home.
									return new RedirectResponse(\Drupal::url('<front>'));
								}
							}
						}
						// New user.
						else {
							
							\Drupal::logger('social_login')->notice('- '. __FUNCTION__ .'@'. __LINE__ .' new user');
							
							// New users may register.
							if (\Drupal::config('user.settings')->get('register') != USER_REGISTER_ADMINISTRATORS_ONLY) {
								// Extract the user's email address.
								$user_email = '';
								$user_email_is_verified = NULL;
								$user_email_is_random = NULL;

								if (isset($identity['emails']) && is_array($identity['emails'])) {
									while (!$user_email_is_verified && (list(, $email) = each($identity['emails']))) {
										$user_email = $email['value'];
										$user_email_is_verified = (!empty($email['is_verified']));
									}
								}

								// The admin has chosen the automatic registration.
								if ($registration_method <> 'manual') {

									// No email address / Email address already exists.
									if (empty($user_email) || \social_login_get_uid_for_email($user_email) !== FALSE) {

										// The admin wants users to fill out their email manually.
										if ($registration_method == 'auto_manual_email') {

											// We have to fall back to the default registration.
											$registration_method = 'manual';
										}
										// The admin has enabled the usage of random email addresses.
										else {

											// Create a bogus email.
											$user_email = \social_login_create_random_email();

											// Flag - is used further down.
											$user_email_is_random = TRUE;
										}
									}
								}

								// Automatic registration is still enabled.
								if ($registration_method <> 'manual') {

									// If something goes wrong fall back to manual registration.
									$registration_method = 'manual';

									// Extract User Firstname.
									$user_first_name = (!empty($identity['name']['givenName']) ? $identity['name']['givenName'] : '');

									// Extract User Lastname.
									$user_last_name = (!empty($identity['name']['familyName']) ? $identity['name']['familyName'] : '');

									// Forge User Login.
									$user_login = '';
									if (!empty($identity['preferredUsername'])) {
										$user_login = $identity['preferredUsername'];
									}
									elseif (!empty($identity['displayName'])) {
										$user_login = $identity['displayName'];
									}
									elseif (!empty($identity['name']['formatted'])) {
										$user_login = $identity['name']['formatted'];
									}
									else {
										$user_login = trim($user_first_name . ' ' . $user_last_name);
									}

									// We absolutely need a unique username.
									if (strlen(trim($user_login)) == 0 || \social_login_get_uid_for_name(trim($user_login)) !== FALSE) {
										$i = 1;
										$user_login = $provider_name . t('User');
										while (\social_login_get_uid_for_name($user_login) !== FALSE) {
											$user_login = $provider_name . t('User') . $i++;
										}
									}

									// We also need a password.
									$user_password = user_password(8);

									// Check the approval setting.
									switch ($registration_approval) {
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
											$user_status = \Drupal::config('user.settings')->get('register') == USER_REGISTER_VISITORS ? 1 : 0;
											break;
									}

									$user_roles = array();  // real user accounts get the authenticated user role.
									// Make sure at least one module implements our hook.
									if (count(\Drupal::moduleHandler()->getImplementations('social_login_default_user_roles')) > 0) {
										// Call modules that implements the hook.
										$user_roles = \Drupal::moduleHandler()->invokeAll('social_login_default_user_roles', $user_roles);
									}

									// Setup the user fields.
									$user_fields = array(
											'name' => $user_login,
											'mail' => $user_email,
											'pass' => $user_password,
											'status' => $user_status,
											'init' => $user_email,
											'roles' => $user_roles,
									);

									// Create a new user.
									$account = User::create($user_fields);
									$account->save();

									// The new account has been created correctly.
									if ($account !== FALSE) {

										// Disable Drupal legacy registration.
										$registration_method = 'auto';

										// Log the new user in.
										if (($uid = \Drupal::service("user.auth")->authenticate($user_login, $user_password)) !== FALSE) {

											// Loads a user object.
											$user = User::load($uid);

											user_login_finalize($user);

											// Send email if it's not a random email.
											if ($user_email_is_random !== TRUE) {
												// No approval required.
												if ($user_status == 1) {
													_user_mail_notify('register_no_approval_required', $user);
													drupal_set_message(t('You have succesfully created an account and linked it with your @social_network account.', array(
															'@social_network' => $provider_name,
													)), 'status');
												}
												// Approval required.
												else {
													$a = _user_mail_notify('register_pending_approval', $user);
													drupal_set_message(t('Thank you for applying for an account. Your account is currently pending approval by the site administrator.<br />You will receive an email once your account has been approved and you can then login with your @social_network account.', array(
															'@social_network' => $provider_name,
													)), 'status');
												}
											}
											// Random email used.
											else {
												drupal_set_message(t('You have succesfully created an account and linked it with your @social_network account.', array(
														'@social_network' => $provider_name,
												)), 'status');
											}
										}
										// For some reason we could not log the user in.
										else {
											// Redirect to login page (login manually).
											drupal_set_message(t('Error while logging you in, please try to login manually.'), 'error');
											\Drupal::logger('social_login')->error('- '. __FUNCTION__ .'@'. __LINE__ .' auto login, redirecting to '. \Drupal::url('user.login'));
											return new RedirectResponse(\Drupal::url('user.login'));
										}
									}
									// An error occured during user_save().
									else {
										// Redirect to registration page (register manually).
										drupal_set_message(t('Error while creating your user account, please try to register manually.'), 'error');
										\Drupal::logger('social_login')->error('- '. __FUNCTION__ .'@'. __LINE__ .' auto register, redirecting to '. \Drupal::url('user.register'));
										return new RedirectResponse(\Drupal::url('user.register'));
									}
								}

								// Use the legacy registration form?
								if ($registration_method == 'manual') {
									// Redirect to the registration page (+ prepopulate form with SESSION data).
									\Drupal::logger('social_login')->notice('- '. __FUNCTION__ .'@'. __LINE__ .' manual register, redirecting to '. \Drupal::url('user.register'));
									return new RedirectResponse(\Drupal::url('user.register'));
								}
							}
							// Registration disabled.
							else {
								drupal_set_message(t('Only site administrators can create new user accounts.'), 'error');
								return new RedirectResponse(\Drupal::url('<front>'));
							}
						}
					}
				}
				else {
					\Drupal::logger('social_login')->error('- '. __FUNCTION__ .'@'. __LINE__ .' invalid JSON received from resource');
				}
			}
		}

		// Return to the front page.
		return new RedirectResponse(\Drupal::url('<front>'));
	}
}