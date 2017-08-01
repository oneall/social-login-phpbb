<?php
/**
 * @package   	OneAll Social Login
 * @copyright 	Copyright 2011-2017 http://www.oneall.com
 * @license   	GPL-2.0
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307,USA.
 *
 * The "GNU General Public License" (GPL) is available at
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 */
namespace oneall\sociallogin\acp;

class sociallogin_acp_module
{

    /**
     * Main Function
     */
    public function main($id, $mode)
    {
        global $request;

        // Task that needs to be done
        $task = $request->variable('task', '');

        // Tasks
        switch ($task)
        {
            // Verify API settings.
            case 'verify_api_settings':
                return $this->verify_api_settings();

            // Autodetect API connection.
            case 'autodetect_api_connection':
                return $this->autodetect_api_connection();

            // Show Settings.
            default:
                return $this->display_settings();
        }
    }

    /**
     * Admin Settings
     */
    protected function display_settings()
    {
        global $user, $template, $config, $phpbb_admin_path, $phpEx, $request;

        // Add the language file.
        $user->add_lang_ext('oneall/sociallogin', 'backend');

        // Set up the page
        $this->tpl_name = 'sociallogin';
        $this->page_title = $user->lang['OA_SOCIAL_LOGIN_ACP'];

        // Available Social Networks
        $oa_social_login_all_providers = $this->get_providers();

        // Enable Social Login?
        $oa_social_login_disable = ((isset($config['oa_social_login_disable']) && $config['oa_social_login_disable'] == '1') ? '1' : '0');

        // API Connection
        $oa_social_login_api_connection_handler = ((isset($config['oa_social_login_api_connection_handler']) && $config['oa_social_login_api_connection_handler'] == 'fsockopen') ? 'fsockopen' : 'curl');
        $oa_social_login_api_connection_port = ((isset($config['oa_social_login_api_connection_port']) && $config['oa_social_login_api_connection_port'] == 80) ? 80 : 443);
        $oa_social_login_api_subdomain = (isset($config['oa_social_login_api_subdomain']) ? $config['oa_social_login_api_subdomain'] : '');
        $oa_social_login_api_key = (isset($config['oa_social_login_api_key']) ? $config['oa_social_login_api_key'] : '');
        $oa_social_login_api_secret = (isset($config['oa_social_login_api_secret']) ? $config['oa_social_login_api_secret'] : '');

        // Social Networks.
        $oa_social_login_providers = (isset($config['oa_social_login_providers']) ? explode(",", $config['oa_social_login_providers']) : array());

        // Profile Validation.
        if (isset($config['oa_social_login_validate']) && $config['oa_social_login_validate'] == '1')
        {
            $oa_social_login_validate = 1;
        }
        elseif (isset($config['oa_social_login_validate']) && $config['oa_social_login_validate'] == '2')
        {
            $oa_social_login_validate = 2;
        }
        else
        {
            $oa_social_login_validate = 0;
        }

        // Social Link.
        $oa_social_login_disable_linking = ((isset($config['oa_social_login_disable_linking']) && $config['oa_social_login_disable_linking'] == '1') ? '1' : '0');

        // Upload Avatars.
        $oa_social_login_avatars_enable = ((isset($config['oa_social_login_avatars_enable']) && $config['oa_social_login_avatars_enable'] == '1') ? '1' : '0');

        // Redirection.
        $oa_social_login_redirect = (isset($config['oa_social_login_redirect']) ? $config['oa_social_login_redirect'] : '');

        // Login Page.
        $oa_social_login_login_page_disable = ((isset($config['oa_social_login_login_page_disable']) && $config['oa_social_login_login_page_disable'] == '1') ? '1' : '0');
        $oa_social_login_login_page_caption = (isset($config['oa_social_login_login_page_caption']) ? $config['oa_social_login_login_page_caption'] : 'Login with your social network account');

        // Login Page - Inline.
        $oa_social_login_inline_page_disable = ((isset($config['oa_social_login_inline_page_disable']) && $config['oa_social_login_inline_page_disable'] == '1') ? '1' : '0');
        $oa_social_login_inline_page_caption = (isset($config['oa_social_login_inline_page_caption']) ? $config['oa_social_login_inline_page_caption'] : 'or Login with your social network account');

        // Registration Page.
        $oa_social_login_registration_page_disable = ((isset($config['oa_social_login_registration_page_disable']) && $config['oa_social_login_registration_page_disable'] == '1') ? '1' : '0');
        $oa_social_login_registration_page_caption = (isset($config['oa_social_login_registration_page_caption']) ? $config['oa_social_login_registration_page_caption'] : 'Connect with your social network account');

        // Index Page.
        $oa_social_login_index_page_disable = ((isset($config['oa_social_login_index_page_disable']) && $config['oa_social_login_index_page_disable'] == '1') ? '1' : '0');
        $oa_social_login_index_page_caption = (isset($config['oa_social_login_index_page_caption']) ? $config['oa_social_login_index_page_caption'] : 'Connect with your social network account');

        // Index Page.
        $oa_social_login_other_page_disable = (empty($config['oa_social_login_other_page_disable']) ? '0' : 1);
        $oa_social_login_other_page_caption = (isset($config['oa_social_login_other_page_caption']) ? $config['oa_social_login_other_page_caption'] : 'Connect with your social network account');

        // Triggers a form message.
        $oa_social_login_settings_saved = false;

        // Security Check.
        add_form_key('oa_social_login');

        // Form submitted.
        if ($request->variable('submit', '') != '')
        {
            // Form Security Check.
            if (!check_form_key('oa_social_login'))
            {
                trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action), E_USER_WARNING);
            }

            // Triggers the settings saved message,
            $oa_social_login_settings_saved = true;

            // Gather API Connection details.
            $oa_social_login_api_connection_handler = ($request->variable('oa_social_login_api_connection_handler', 'curl') == 'fs' ? 'fsockopen' : 'curl');
            $oa_social_login_api_connection_port = ($request->variable('oa_social_login_api_connection_port', 443) == 80 ? 80 : 443);
            $oa_social_login_api_subdomain = $request->variable('oa_social_login_api_subdomain', '');
            $oa_social_login_api_key = $request->variable('oa_social_login_api_key', '');
            $oa_social_login_api_secret = $request->variable('oa_social_login_api_secret', '');

            // Check for full subdomain.
            if (preg_match("/([a-z0-9\-]+)\.api\.oneall\.com/i", $oa_social_login_api_subdomain, $matches))
            {
                $oa_social_login_api_subdomain = $matches[1];
            }

            // Social Networks.
            $oa_social_login_providers = array();
            foreach ($oa_social_login_all_providers as $key => $name)
            {
                if ($request->variable('oa_social_login_provider_' . $key, 0) == 1)
                {
                    $oa_social_login_providers[] = $key;
                }
            }

            // Other options.
            $oa_social_login_disable = (($request->variable('oa_social_login_disable', 0) == 1) ? 1 : 0);
            $oa_social_login_disable_linking = (($request->variable('oa_social_login_disable_linking', 0) == 1) ? 1 : 0);
            $oa_social_login_avatars_enable = (($request->variable('oa_social_login_avatars_enable', 0) == 1) ? 1 : 0);
            $oa_social_login_redirect = $request->variable('oa_social_login_redirect', '');
            $oa_social_login_validate_tmp = $request->variable('oa_social_login_validate', 0);

            if ($oa_social_login_validate_tmp == '1')
            {
                $oa_social_login_validate = 1;
            }
            elseif ($oa_social_login_validate_tmp == '2')
            {
                $oa_social_login_validate = 2;
            }
            else
            {
                $oa_social_login_validate = 0;
            }

            // Login page, default 1.
            $oa_social_login_login_page_disable = (($request->variable('oa_social_login_login_page_disable', 0) == 1) ? 1 : 0);
            $oa_social_login_login_page_caption = $request->variable('oa_social_login_login_page_caption', '', true);

            // Login page inline, default 1.
            $oa_social_login_inline_page_disable = (($request->variable('oa_social_login_inline_page_disable', 0) == 1) ? 1 : 0);
            $oa_social_login_inline_page_caption = $request->variable('oa_social_login_inline_page_caption', '', true);

            // Registration page, default 1.
            $oa_social_login_registration_page_disable = (($request->variable('oa_social_login_registration_page_disable', 0) == 1) ? 1 : 0);
            $oa_social_login_registration_page_caption = $request->variable('oa_social_login_registration_page_caption', '', true);

            // Main page, default 1.
            $oa_social_login_index_page_disable = (($request->variable('oa_social_login_index_page_disable', 0) == 1) ? 1 : 0);
            $oa_social_login_index_page_caption = $request->variable('oa_social_login_index_page_caption', '', true);

            // Other pages, default 0.
            $oa_social_login_other_page_disable = (($request->variable('oa_social_login_other_page_disable', 1) == 0) ? 0 : 1);
            $oa_social_login_other_page_caption = $request->variable('oa_social_login_other_page_caption', '', true);

            // Save configuration.
            $config->set('oa_social_login_disable', $oa_social_login_disable);
            $config->set('oa_social_login_disable_linking', $oa_social_login_disable_linking);
            $config->set('oa_social_login_avatars_enable', $oa_social_login_avatars_enable);
            $config->set('oa_social_login_redirect', $oa_social_login_redirect);
            $config->set('oa_social_login_api_subdomain', $oa_social_login_api_subdomain);
            $config->set('oa_social_login_api_key', $oa_social_login_api_key);
            $config->set('oa_social_login_api_secret', $oa_social_login_api_secret);
            $config->set('oa_social_login_providers', implode(",", $oa_social_login_providers));
            $config->set('oa_social_login_api_connection_handler', $oa_social_login_api_connection_handler);
            $config->set('oa_social_login_api_connection_port', $oa_social_login_api_connection_port);
            $config->set('oa_social_login_login_page_disable', $oa_social_login_login_page_disable);
            $config->set('oa_social_login_login_page_caption', $oa_social_login_login_page_caption);
            $config->set('oa_social_login_inline_page_disable', $oa_social_login_inline_page_disable);
            $config->set('oa_social_login_inline_page_caption', $oa_social_login_inline_page_caption);
            $config->set('oa_social_login_registration_page_disable', $oa_social_login_registration_page_disable);
            $config->set('oa_social_login_registration_page_caption', $oa_social_login_registration_page_caption);
            $config->set('oa_social_login_index_page_disable', $oa_social_login_index_page_disable);
            $config->set('oa_social_login_index_page_caption', $oa_social_login_index_page_caption);
            $config->set('oa_social_login_other_page_disable', $oa_social_login_other_page_disable);
            $config->set('oa_social_login_other_page_caption', $oa_social_login_other_page_caption);
            $config->set('oa_social_login_validate', $oa_social_login_validate);
        }

        // Setup Social Network Vars
        foreach ($oa_social_login_all_providers as $key => $name)
        {
            $template->assign_block_vars('provider', array(
                'KEY' => $key,
                'NAME' => $name,
                'ENABLE' => in_array($key, $oa_social_login_providers)
            ));
        }

        // Setup Vars
        $template->assign_vars(array(
            'U_ACTION' => $this->u_action,
            'CURRENT_SID' => $user->data['session_id'],
            'OA_SOCIAL_LOGIN_AJAX_URL_AUTODETECT' => append_sid($phpbb_admin_path . "index." . $phpEx, array(
                'i' => '-oneall-sociallogin-acp-sociallogin_acp_module',
                'mode' => 'settings',
                'task' => 'autodetect_api_connection'), false),
            'OA_SOCIAL_LOGIN_AJAX_URL_VERIFY' => append_sid($phpbb_admin_path . "index." . $phpEx, array(
                'i' => '-oneall-sociallogin-acp-sociallogin_acp_module',
                'mode' => 'settings',
                'task' => 'verify_api_settings'), false),
            'OA_SOCIAL_LOGIN_SETTINGS_SAVED' => $oa_social_login_settings_saved,
            'OA_SOCIAL_LOGIN_VALIDATE' => $oa_social_login_validate,
            'OA_SOCIAL_LOGIN_DISABLE' => ($oa_social_login_disable == '1'),
            'OA_SOCIAL_LOGIN_DISABLE_LINKING' => ($oa_social_login_disable_linking == '1'),
            'OA_SOCIAL_LOGIN_AVATARS_ENABLE' => ($oa_social_login_avatars_enable == '1'),
            'OA_SOCIAL_LOGIN_REDIRECT' => $oa_social_login_redirect,
            'OA_SOCIAL_LOGIN_API_SUBDOMAIN' => $oa_social_login_api_subdomain,
            'OA_SOCIAL_LOGIN_API_KEY' => $oa_social_login_api_key,
            'OA_SOCIAL_LOGIN_API_SECRET' => $oa_social_login_api_secret,
            'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER' => $oa_social_login_api_connection_handler,
            'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER_CURL' => ($oa_social_login_api_connection_handler != 'fsockopen'),
            'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER_FSOCKOPEN' => ($oa_social_login_api_connection_handler == 'fsockopen'),
            'OA_SOCIAL_LOGIN_API_CONNECTION_PORT' => $oa_social_login_api_connection_port,
            'OA_SOCIAL_LOGIN_API_CONNECTION_PORT_443' => ($oa_social_login_api_connection_port != '80'),
            'OA_SOCIAL_LOGIN_API_CONNECTION_PORT_80' => ($oa_social_login_api_connection_port == '80'),
            'OA_SOCIAL_LOGIN_LOGIN_PAGE_DISABLE' => ($oa_social_login_login_page_disable == '1'),
            'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION' => $oa_social_login_login_page_caption,
            'OA_SOCIAL_LOGIN_INLINE_PAGE_DISABLE' => ($oa_social_login_inline_page_disable == '1'),
            'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION' => $oa_social_login_inline_page_caption,
            'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_DISABLE' => ($oa_social_login_registration_page_disable == '1'),
            'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION' => $oa_social_login_registration_page_caption,
            'OA_SOCIAL_LOGIN_INDEX_PAGE_DISABLE' => ($oa_social_login_index_page_disable == '1'),
            'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION' => $oa_social_login_index_page_caption,
            'OA_SOCIAL_LOGIN_OTHER_PAGE_DISABLE' => ($oa_social_login_other_page_disable == '1'),
            'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION' => $oa_social_login_other_page_caption));

        // Done
        return true;
    }

    /**
     * AutoDetect API Settings - Ajax Call
     */
    protected function autodetect_api_connection()
    {
        global $user;

        // Add the language file.
        $user->add_lang_ext('oneall/sociallogin', 'backend');

        // Check CURL HTTPS - Port 443.
        if ($this->check_curl(true) === true)
        {
            $response = array(
                'success' => true,
                'handler' => 'curl',
                'port' => 443,
                'message' => sprintf($user->lang['OA_SOCIAL_LOGIN_API_DETECT_CURL'], 443));
        }
        // Check CURL HTTP - Port 80.
        elseif ($this->check_curl(false) === true)
        {
            $response = array(
                'success' => true,
                'handler' => 'curl',
                'port' => 80,
                'message' => sprintf($user->lang['OA_SOCIAL_LOGIN_API_DETECT_CURL'], 80));
        }
        // Check FSOCKOPEN HTTPS - Port 443.
        elseif ($this->check_fsockopen(true) == true)
        {
            $response = array(
                'success' => true,
                'handler' => 'fsockopen',
                'port' => 443,
                'message' => sprintf($user->lang['OA_SOCIAL_LOGIN_API_DETECT_FSOCKOPEN'], 443));
        }
        // Check FSOCKOPEN HTTP - Port 80.
        elseif ($this->check_fsockopen(false) == true)
        {
            $response = array(
                'success' => true,
                'handler' => 'fsockopen',
                'port' => 80,
                'message' => sprintf($user->lang['OA_SOCIAL_LOGIN_API_DETECT_FSOCKOPEN'], 80));
        }
        // No working handler found.
        else
        {
            $response = array(
                'success' => false,
                'message' => $user->lang['OA_SOCIAL_LOGIN_API_DETECT_NONE']);
        }

        // Output for Ajax.
        $json_response = new \phpbb\json_response();
        $json_response->send($response);
    }

    /**
     * Verify API Settings - Ajax Call
     */
    protected function verify_api_settings()
    {
        global $user, $request, $phpbb_container, $config;

        // Add the language file.
        $user->add_lang_ext('oneall/sociallogin', 'backend');

        // Read arguments.
        $api_subdomain = trim(strtolower($request->variable('api_subdomain', '')));
        $api_key = trim($request->variable('api_key', ''));
        $api_secret = trim($request->variable('api_secret', ''));
        $api_connection_port = $request->variable('api_connection_port', '');
        $api_connection_handler = $request->variable('api_connection_handler', '');

        // Init status message.
        $status_success = false;
        $status_message = null;

        // Check if all fields have been filled out.
        if (strlen($api_subdomain) == 0 || strlen($api_key) == 0 || strlen($api_secret) == 0)
        {
            $status_message = $user->lang['OA_SOCIAL_LOGIN_API_CREDENTIALS_FILL_OUT'];
        }
        else
        {
            // Check the handler
            $api_connection_handler = ($api_connection_handler == 'fs' ? 'fsockopen' : 'curl');
            $api_connection_use_https = ($api_connection_port == 443 ? true : false);

            // FSOCKOPEN
            if ($api_connection_handler == 'fsockopen')
            {
                if (!$this->check_fsockopen($api_connection_use_https))
                {
                    $status_message = $user->lang['OA_SOCIAL_LOGIN_API_CREDENTIALS_USE_AUTO'];
                }
            }
            // CURL
            else
            {
                if (!$this->check_curl($api_connection_use_https))
                {
                    $status_message = $user->lang['OA_SOCIAL_LOGIN_API_CREDENTIALS_USE_AUTO'];
                }
            }

            // No errors until now.
            if (empty($status_message))
            {
                // The full domain has been entered.
                if (preg_match("/([a-z0-9\-]+)\.api\.oneall\.com/i", $api_subdomain, $matches))
                {
                    $api_subdomain = $matches[1];
                }

                // Check format of the subdomain.
                if (!preg_match("/^[a-z0-9\-]+$/i", $api_subdomain))
                {
                    $status_message = $user->lang['OA_SOCIAL_LOGIN_API_CREDENTIALS_SUBDOMAIN_WRONG'];
                }
                else
                {
                    // Construct full API Domain.
                    $api_domain = $api_subdomain . '.api.oneall.com';
                    $api_resource_url = ($api_connection_use_https ? 'https' : 'http') . '://' . $api_domain . '/site/allowed-domains.json';

                    // Domain
                    $phpbb_domain = ($config['server_name'] ?  : $request->server('SERVER_NAME', 'phpbb.generated'));

                    // API Credentialls.
                    $api_options = array();
                    $api_options['api_key'] = $api_key;
                    $api_options['api_secret'] = $api_secret;
                    $api_options['method'] = 'PUT';
                    $api_options['data'] = json_encode(array(
                        'request' => array(
                            'allowed_domains' => array(
                                $phpbb_domain))));

                    // Try to establish a connection, this will also whitelist the domain.
                    $result = $phpbb_container->get('oneall.sociallogin.helper')->do_api_request($api_connection_handler, $api_resource_url, $api_options);

                    switch ($result->get_code())
                    {
                        // Connection successfull.
                        case 200:
                        case 201:
                            $status_message = $user->lang['OA_SOCIAL_LOGIN_API_CREDENTIALS_OK'];
                            $status_success = true;
                            break;

                        // Authentication Error.
                        case 401:
                            $status_message = $user->lang['OA_SOCIAL_LOGIN_API_CREDENTIALS_KEYS_WRONG'];
                            break;

                        // Wrong Subdomain.
                        case 404:
                            $status_message = $user->lang['OA_SOCIAL_LOGIN_API_CREDENTIALS_SUBDOMAIN_WRONG'];
                            break;

                        // Another error.
                        default:
                            $status_message = $user->lang['OA_SOCIAL_LOGIN_API_CREDENTIALS_CHECK_COM'];
                            break;
                    }
                }
            }
        }

        // Output for Ajax.
        $json_response = new \phpbb\json_response();
        $json_response->send(array(
            'success' => $status_success,
            'message' => $status_message));
    }

    /**
     * Returns a list of disabled PHP functions.
     */
    protected function get_php_disabled_functions()
    {
        $disabled_functions = trim(ini_get('disable_functions'));
        if (strlen($disabled_functions) == 0)
        {
            $disabled_functions = array();
        }
        else
        {
            $disabled_functions = explode(',', $disabled_functions);
            $disabled_functions = array_map('trim', $disabled_functions);
        }
        return $disabled_functions;
    }

    /**
     * Checks if CURL can be used.
     */
    public function check_curl($secure = true)
    {
        global $phpbb_container;

        if (in_array('curl', get_loaded_extensions()) && function_exists('curl_exec') && !in_array('curl_exec', $this->get_php_disabled_functions()))
        {
            $result = $phpbb_container->get('oneall.sociallogin.helper')->curl_request(($secure ? 'https' : 'http') . '://www.oneall.com/ping.html');
            if ($result->get_code() == 200 && strtolower($result->get_data()) == 'ok')
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if FSOCKOPEN can be used.
     */
    public function check_fsockopen($secure = true)
    {
        global $phpbb_container;

        if (function_exists('fsockopen') && !in_array('fsockopen', $this->get_php_disabled_functions()))
        {
            $result = $phpbb_container->get('oneall.sociallogin.helper')->fsockopen_request(($secure ? 'https' : 'http') . '://www.oneall.com/ping.html');
            if ($result->get_code() == 200 && strtolower($result->get_data()) == 'ok')
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Returns the list of available social networks.
     */
    public function get_providers()
    {
    	global $user;

    	// Add the language file.
    	$user->add_lang_ext('oneall/sociallogin', 'providers');

    	// Providers
    	$providers = array (
    		'amazon' => $user->lang['OA_SOCIAL_LOGIN_P_AMAZON'],
    		'battlenet' => $user->lang['OA_SOCIAL_LOGIN_P_BATTLENET'],
    		'blogger' => $user->lang['OA_SOCIAL_LOGIN_P_BLOGGER'],
    		'storage' => $user->lang['OA_SOCIAL_LOGIN_P_STORAGE'],
    		'disqus' => $user->lang['OA_SOCIAL_LOGIN_P_DISQUS'],
    		'draugiem' => $user->lang['OA_SOCIAL_LOGIN_P_DRAUGIEM'],
    		'dribbble' => $user->lang['OA_SOCIAL_LOGIN_P_DRIBBBLE'],
    		'facebook' => $user->lang['OA_SOCIAL_LOGIN_P_FACEBOOK'],
    		'foursquare' => $user->lang['OA_SOCIAL_LOGIN_P_FOURSQUARE'],
    		'github' => $user->lang['OA_SOCIAL_LOGIN_P_GITHUBCOM'],
    		'google' => $user->lang['OA_SOCIAL_LOGIN_P_GOOGLE'],
    		'instagram' => $user->lang['OA_SOCIAL_LOGIN_P_INSTAGRAM'],
    		'line' => $user->lang['OA_SOCIAL_LOGIN_P_LINE'],
    		'linkedin' => $user->lang['OA_SOCIAL_LOGIN_P_LINKEDIN'],
    		'livejournal' => $user->lang['OA_SOCIAL_LOGIN_P_LIVEJOURNAL'],
    		'mailru' => $user->lang['OA_SOCIAL_LOGIN_P_MAILRU'],
    		'meetup' => $user->lang['OA_SOCIAL_LOGIN_P_MEETUP'],
    		'odnoklassniki' =>  $user->lang['OA_SOCIAL_LOGIN_P_ODNOKLASSNIKI'],
    		'openid' =>  $user->lang['OA_SOCIAL_LOGIN_P_OPENID'],
    		'paypal' =>  $user->lang['OA_SOCIAL_LOGIN_P_PAYPAL'],
    		'pinterest' =>  $user->lang['OA_SOCIAL_LOGIN_P_PINTEREST'],
    		'pixelpin' => $user->lang['OA_SOCIAL_LOGIN_P_PIXELPIN'],
    		'reddit' =>  $user->lang['OA_SOCIAL_LOGIN_P_REDDIT'],
    		'skyrock' =>  $user->lang['OA_SOCIAL_LOGIN_P_SKYROCKCOM'],
    		'soundcloud' =>  $user->lang['OA_SOCIAL_LOGIN_P_SOUNDCLOUD'],
    		'stackexchange' => $user->lang['OA_SOCIAL_LOGIN_P_STACKEXCHANGE'],
    		'steam' =>  $user->lang['OA_SOCIAL_LOGIN_P_STEAM'],
    		'twitch' =>  $user->lang['OA_SOCIAL_LOGIN_P_TWITCHTV'],
    		'twitter' =>  $user->lang['OA_SOCIAL_LOGIN_P_TWITTER'],
    		'vimeo' =>  $user->lang['OA_SOCIAL_LOGIN_P_VIMEO'],
    		'vkontakte' =>  $user->lang['OA_SOCIAL_LOGIN_P_VKONTAKTE'],
    		'windowslive' =>  $user->lang['OA_SOCIAL_LOGIN_P_WINDOWSLIVE'],
    		'wordpress' =>  $user->lang['OA_SOCIAL_LOGIN_P_WORDPRESSCOM'],
    		'xing' =>  $user->lang['OA_SOCIAL_LOGIN_P_XING'],
    		'yahoo' =>  $user->lang['OA_SOCIAL_LOGIN_P_YAHOO'],
    		'youtube' =>  $user->lang['OA_SOCIAL_LOGIN_P_YOUTUBE']
    	);

    	return $providers;
    }
}
