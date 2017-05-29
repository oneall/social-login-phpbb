<?php
/**
 * @package   	OneAll Social Login
 * @copyright 	Copyright 2011-2017 http://www.oneall.com
 * @license   	GNU/GPL 2 or later
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
	// Version
	const USER_AGENT = 'SocialLogin/2.8 phpBB/3.1.x (+http://www.oneall.com/)';

	// @var \phpbb\config\config
	protected $config;

	// @var \phpbb\config\db_text
	protected $config_text;

	// @var \phpbb\db\driver\driver_interface
	protected $db;

	// @var \phpbb\log\log
	protected $log;

	// @var \phpbb\request\request
	protected $request;

	// @var \phpbb\template\template
	protected $template;

	// @var \phpbb\user
	protected $user;

	// @var ContainerInterface
	protected $phpbb_container;

	// @var string
	protected $phpbb_root_path;

	// @var string
	protected $php_ext;

	// @var string
	public $u_action;

	/**
	 * Main Function
	 */
	public function main ($id, $mode)
	{
		global $request;

		// Task that needs to be done
		$task = $request->variable('task', '');

		// Tasks
		switch ($task)
		{
			// Verify API settings.
			case 'verify_api_settings' :
				return $this->admin_ajax_verify_api_settings ();

			// Autodetect API connection.
			case 'autodetect_api_connection' :
				return $this->admin_ajax_autodetect_api_connection ();

			// Show Settings.
			default:
				return $this->admin_main ();
		}
	}

	/**
	 * Admin Main Page
	 */
	public function admin_main ()
	{
		global $db, $user, $auth, $template, $config, $phpbb_root_path, $phpbb_admin_path, $phpEx, $table_prefix, $request;

		// Add the language file.
		$user->add_lang_ext ('oneall/sociallogin', 'backend');

		// Set up the page
		$this->tpl_name = 'sociallogin';
		$this->page_title = $user->lang ['OA_SOCIAL_LOGIN_ACP'];

		// Enable Social Login?
		$oa_social_login_disable = ((isset ($config ['oa_social_login_disable']) && $config ['oa_social_login_disable'] == '1') ? '1' : '0');

		// API Connection
		$oa_social_login_api_connection_handler = ((isset ($config ['oa_social_login_api_connection_handler']) && $config ['oa_social_login_api_connection_handler'] == 'fsockopen') ? 'fsockopen' : 'curl');
		$oa_social_login_api_connection_port = ((isset ($config ['oa_social_login_api_connection_port']) && $config ['oa_social_login_api_connection_port'] == 80) ? 80 : 443);
		$oa_social_login_api_subdomain = (isset ($config ['oa_social_login_api_subdomain']) ? $config ['oa_social_login_api_subdomain'] : '');
		$oa_social_login_api_key = (isset ($config ['oa_social_login_api_key']) ? $config ['oa_social_login_api_key'] : '');
		$oa_social_login_api_secret = (isset ($config ['oa_social_login_api_secret']) ? $config ['oa_social_login_api_secret'] : '');

		// Social Networks.
		$oa_social_login_providers = (isset ($config ['oa_social_login_providers']) ? explode (",", $config ['oa_social_login_providers']) : array());

		// Profile Validation.
		if (isset ($config ['oa_social_login_validate']) && $config ['oa_social_login_validate'] == '1')
		{
			$oa_social_login_validate = 1;
		}
		elseif (isset ($config ['oa_social_login_validate']) && $config ['oa_social_login_validate'] == '2')
		{
			$oa_social_login_validate = 2;
		}
		else
		{
			$oa_social_login_validate = 0;
		}

		// Social Link.
		$oa_social_login_disable_linking = ((isset ($config ['oa_social_login_disable_linking']) && $config ['oa_social_login_disable_linking'] == '1') ? '1' : '0');

		// Upload Avatars.
		$oa_social_login_avatars_enable = ((isset ($config ['oa_social_login_avatars_enable']) && $config ['oa_social_login_avatars_enable'] == '1') ? '1' : '0');

		// Redirection.
		$oa_social_login_redirect = (isset ($config ['oa_social_login_redirect']) ? $config ['oa_social_login_redirect'] : '');

		// Login Page.
		$oa_social_login_login_page_disable = ((isset ($config ['oa_social_login_login_page_disable']) && $config ['oa_social_login_login_page_disable'] == '1') ? '1' : '0');
        $oa_social_login_login_page_caption = (isset ($config ['oa_social_login_login_page_caption']) ? $config ['oa_social_login_login_page_caption'] : 'Login with your social network account');

        // Login Page - Inline.
		$oa_social_login_inline_page_disable = ((isset ($config ['oa_social_login_inline_page_disable']) && $config ['oa_social_login_inline_page_disable'] == '1') ? '1' : '0');
        $oa_social_login_inline_page_caption = (isset ($config ['oa_social_login_inline_page_caption']) ? $config ['oa_social_login_inline_page_caption'] : 'or Login with your social network account');

		// Registration Page.
		$oa_social_login_registration_page_disable = ((isset ($config ['oa_social_login_registration_page_disable']) && $config ['oa_social_login_registration_page_disable'] == '1') ? '1' : '0');
		$oa_social_login_registration_page_caption = (isset ($config ['oa_social_login_registration_page_caption']) ? $config ['oa_social_login_registration_page_caption'] : 'Connect with your social network account');

		// Index Page.
		$oa_social_login_index_page_disable = ((isset ($config ['oa_social_login_index_page_disable']) && $config ['oa_social_login_index_page_disable'] == '1') ? '1' : '0');
		$oa_social_login_index_page_caption = (isset ($config ['oa_social_login_index_page_caption']) ? $config ['oa_social_login_index_page_caption'] : 'Connect with your social network account');

		// Index Page.
		$oa_social_login_other_page_disable = (empty ($config ['oa_social_login_other_page_disable']) ? '0' : 1);
		$oa_social_login_other_page_caption = (isset ($config ['oa_social_login_other_page_caption']) ? $config ['oa_social_login_other_page_caption'] : 'Connect with your social network account');

		// Triggers a form message.
		$oa_social_login_settings_saved = false;

		// Security Check.
		add_form_key ('oa_social_login');

		// Form submitted.
		if ($request->variable('submit', '') <> '')
		{
			// Form Security Check.
			if (!check_form_key ('oa_social_login'))
			{
				trigger_error ($user->lang ['FORM_INVALID'] . adm_back_link ($this->u_action), E_USER_WARNING);
			}

			// Triggers the settings saved message,
			$oa_social_login_settings_saved = true;

			// Gather API Connection details.
			$oa_social_login_api_connection_handler = ($request->variable ('oa_social_login_api_connection_handler', 'curl') == 'fs' ? 'fsockopen' : 'curl');
			$oa_social_login_api_connection_port = ($request->variable ('oa_social_login_api_connection_port', 443) == 80 ? 80 : 443);
			$oa_social_login_api_subdomain = $request->variable ('oa_social_login_api_subdomain', '');
			$oa_social_login_api_key = $request->variable ('oa_social_login_api_key', '');
			$oa_social_login_api_secret = $request->variable ('oa_social_login_api_secret', '');

			// Check for full subdomain.
			if (preg_match ("/([a-z0-9\-]+)\.api\.oneall\.com/i", $oa_social_login_api_subdomain, $matches))
			{
				$oa_social_login_api_subdomain = $matches [1];
			}

			// Social Networks.
			$oa_social_login_providers = array();
			foreach (self::get_providers () as $provider_key => $provider_data)
			{
				if ($request->variable ('oa_social_login_provider_' . $provider_key, 0) == 1)
				{
					$oa_social_login_providers [] = $provider_key;
				}
			}

			// Other options.
			$oa_social_login_disable = (($request->variable ('oa_social_login_disable', 0) == 1) ? 1 : 0);
			$oa_social_login_disable_linking = (($request->variable ('oa_social_login_disable_linking', 0) == 1) ? 1 : 0);
			$oa_social_login_avatars_enable = (($request->variable ('oa_social_login_avatars_enable', 0) == 1) ? 1 : 0);
			$oa_social_login_redirect = $request->variable ('oa_social_login_redirect', '');
			$oa_social_login_validate_tmp = $request->variable ('oa_social_login_validate', 0);
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
			$oa_social_login_login_page_disable = (($request->variable ('oa_social_login_login_page_disable', 0) == 1) ? 1 : 0);
			$oa_social_login_login_page_caption = $request->variable ('oa_social_login_login_page_caption', '', true);

			// Login page inline, default 1.
			$oa_social_login_inline_page_disable = (($request->variable ('oa_social_login_inline_page_disable', 0) == 1) ? 1 : 0);
            $oa_social_login_inline_page_caption = $request->variable ('oa_social_login_inline_page_caption', '', true);

			// Registration page, default 1.
			$oa_social_login_registration_page_disable = (($request->variable ('oa_social_login_registration_page_disable', 0) == 1) ? 1 : 0);
			$oa_social_login_registration_page_caption = $request->variable ('oa_social_login_registration_page_caption', '', true);

			// Main page, default 1.
			$oa_social_login_index_page_disable = (($request->variable ('oa_social_login_index_page_disable', 0) == 1) ? 1 : 0);
			$oa_social_login_index_page_caption = $request->variable ('oa_social_login_index_page_caption', '', true);

			// Other pages, default 0.
			$oa_social_login_other_page_disable = (($request->variable ('oa_social_login_other_page_disable', 1) == 0) ? 0 : 1);
			$oa_social_login_other_page_caption = $request->variable ('oa_social_login_other_page_caption', '', true);

			// Save configuration.
			$config->set ('oa_social_login_disable', $oa_social_login_disable);
			$config->set ('oa_social_login_disable_linking', $oa_social_login_disable_linking);
			$config->set ('oa_social_login_avatars_enable', $oa_social_login_avatars_enable);
			$config->set ('oa_social_login_redirect', $oa_social_login_redirect);
			$config->set ('oa_social_login_api_subdomain', $oa_social_login_api_subdomain);
			$config->set ('oa_social_login_api_key', $oa_social_login_api_key);
			$config->set ('oa_social_login_api_secret', $oa_social_login_api_secret);
			$config->set ('oa_social_login_providers', implode (",", $oa_social_login_providers));
			$config->set ('oa_social_login_api_connection_handler', $oa_social_login_api_connection_handler);
			$config->set ('oa_social_login_api_connection_port', $oa_social_login_api_connection_port);
			$config->set ('oa_social_login_login_page_disable', $oa_social_login_login_page_disable);
			$config->set ('oa_social_login_login_page_caption', $oa_social_login_login_page_caption);
			$config->set ('oa_social_login_inline_page_disable', $oa_social_login_inline_page_disable);
			$config->set ('oa_social_login_inline_page_caption', $oa_social_login_inline_page_caption);
			$config->set ('oa_social_login_registration_page_disable', $oa_social_login_registration_page_disable);
			$config->set ('oa_social_login_registration_page_caption', $oa_social_login_registration_page_caption);
			$config->set ('oa_social_login_index_page_disable', $oa_social_login_index_page_disable);
			$config->set ('oa_social_login_index_page_caption', $oa_social_login_index_page_caption);
			$config->set ('oa_social_login_other_page_disable', $oa_social_login_other_page_disable);
			$config->set ('oa_social_login_other_page_caption', $oa_social_login_other_page_caption);
			$config->set ('oa_social_login_validate', $oa_social_login_validate);
		}

		// Setup Social Network Vars
		foreach (self::get_providers () as $key => $data)
		{
			$template->assign_block_vars ('provider', array(
				'KEY' => $key,
				'NAME' => $data ['name'],
				'ENABLE' => in_array ($key, $oa_social_login_providers)
			));
		}

		// Setup Vars
		$template->assign_vars (array(
			'U_ACTION' => $this->u_action,
			'CURRENT_SID' => $user->data ['session_id'],
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
			'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION' => $oa_social_login_other_page_caption
		));

		// Done
		return true;
	}

	/**
	 * AutoDetect API Settings - Ajax Call
	 */
	public function admin_ajax_autodetect_api_connection ()
	{
		global $phpbb_root_path, $phpEx, $user;

		// Add the language file.
		$user->add_lang_ext ('oneall/sociallogin', 'backend');

		// Check CURL HTTPS - Port 443.
		if (self::check_curl (true) === true)
		{
			$status_message = 'success|curl_443|' . sprintf ($user->lang ['OA_SOCIAL_LOGIN_API_DETECT_CURL'], 443);
		}
		// Check CURL HTTP - Port 80.
		elseif (self::check_curl (false) === true)
		{
			$status_message = 'success|curl_80|' . sprintf ($user->lang ['OA_SOCIAL_LOGIN_API_DETECT_CURL'], 80);
		}
		// Check FSOCKOPEN HTTPS - Port 443.
		elseif (self::check_fsockopen (true) == true)
		{
			$status_message = 'success|fsockopen_443|' . sprintf ($user->lang ['OA_SOCIAL_LOGIN_API_DETECT_FSOCKOPEN'], 443);
		}
		// Check FSOCKOPEN HTTP - Port 80.
		elseif (self::check_fsockopen (false) == true)
		{
			$status_message = 'success|fsockopen_80|' . sprintf ($user->lang ['OA_SOCIAL_LOGIN_API_DETECT_FSOCKOPEN'], 80);
		}
		// No working handler found.
		else
		{
			$status_message = 'error|none|' . $user->lang ['OA_SOCIAL_LOGIN_API_DETECT_NONE'];
		}

		// Call the garbage collector.
		garbage_collection ();

		// Output for AJAX.
		die ($status_message);
	}

	/**
	 * Check API Settings - Ajax Call
	 */
	public function admin_ajax_verify_api_settings ()
	{
		global $phpbb_root_path, $phpEx, $user, $request;

		// Add language file.
		$user->add_lang_ext ('oneall/sociallogin', 'backend');

		// Read arguments.
		$api_subdomain = trim (strtolower ($request->variable ('api_subdomain', '')));
		$api_key = trim ($request->variable ('api_key', ''));
		$api_secret = trim ($request->variable ('api_secret', ''));
		$api_connection_port = $request->variable ('api_connection_port', '');
		$api_connection_handler = $request->variable ('api_connection_handler', '');

		// Init status message.
		$status_message = null;

		// Check if all fields have been filled out.
		if (strlen ($api_subdomain) == 0 || strlen ($api_key) == 0 || strlen ($api_secret) == 0)
		{
			$status_message = 'error_|' . $user->lang ['OA_SOCIAL_LOGIN_API_CREDENTIALS_FILL_OUT'];
		}
		else
		{
			// Check the handler
			$api_connection_handler = ($api_connection_handler == 'fs' ? 'fsockopen' : 'curl');
			$api_connection_use_https = ($api_connection_port == 443 ? true : false);

			// FSOCKOPEN
			if ($api_connection_handler == 'fsockopen')
			{
				if (!self::check_fsockopen ($api_connection_use_https))
				{
					$status_message = 'error|' . $user->lang ['OA_SOCIAL_LOGIN_API_CREDENTIALS_USE_AUTO'];
				}
			}
			// CURL
			else
			{
				if (!self::check_curl ($api_connection_use_https))
				{
					$status_message = 'error|' . $user->lang ['OA_SOCIAL_LOGIN_API_CREDENTIALS_USE_AUTO'];
				}
			}

			// No errors until now.
			if (empty ($status_message))
			{
				// The full domain has been entered.
				if (preg_match ("/([a-z0-9\-]+)\.api\.oneall\.com/i", $api_subdomain, $matches))
				{
					$api_subdomain = $matches [1];
				}

				// Check format of the subdomain.
				if (!preg_match ("/^[a-z0-9\-]+$/i", $api_subdomain))
				{
					$status_message = 'error|' . $user->lang ['OA_SOCIAL_LOGIN_API_CREDENTIALS_SUBDOMAIN_WRONG'];
				}
				else
				{
					// Construct full API Domain.
					$api_domain = $api_subdomain . '.api.oneall.com';
					$api_resource_url = ($api_connection_use_https ? 'https' : 'http') . '://' . $api_domain . '/tools/ping.json';

					// API Credentialls.
					$api_credentials = array();
					$api_credentials ['api_key'] = $api_key;
					$api_credentials ['api_secret'] = $api_secret;

					// Try to establish a connection.
					$result = self::do_api_request ($api_connection_handler, $api_resource_url, $api_credentials);

					// Parse result.
					if (is_object ($result) && property_exists ($result, 'http_code') && property_exists ($result, 'http_data'))
					{
						switch ($result->http_code)
						{
							// Connection successfull.
							case 200 :
								$status_message = 'success|' . $user->lang ['OA_SOCIAL_LOGIN_API_CREDENTIALS_OK'];
							break;

							// Authentication Error.
							case 401 :
								$status_message = 'error|' . $user->lang ['OA_SOCIAL_LOGIN_API_CREDENTIALS_KEYS_WRONG'];
							break;

							// Wrong Subdomain.
							case 404 :
								$status_message = 'error|' . $user->lang ['OA_SOCIAL_LOGIN_API_CREDENTIALS_SUBDOMAIN_WRONG'];
							break;

							// Other error.
							default :
								$status_message = 'error|' . $user->lang ['OA_SOCIAL_LOGIN_API_CREDENTIALS_CHECK_COM'];
							break;
						}
					}
					else
					{
						$status_message = 'error|' . $user->lang ['OA_SOCIAL_LOGIN_API_CREDENTIALS_CHECK_COM'];
					}
				}
			}
		}

		// Garbage Collector.
		garbage_collection ();

		// Output for Ajax.
		die ($status_message);
	}

	/**
	 * Counts a login for the identity token
	 */
	public function count_login_identity_token ($identity_token)
	{
		global $db, $table_prefix;

		// Update the counter for the given identity_token.
		$sql = "UPDATE " . $table_prefix . "oasl_identity SET num_logins=num_logins+1, date_updated='" . time () . "' WHERE identity_token = '" . $db->sql_escape ($identity_token) . "'";
		$query = $db->sql_query ($sql);
	}

	/**
	 * Unlinks the identity token.
	 * Eventually clean the oasl_user table.
	 */
	public function unlink_identity_token ($identity_token)
	{
		global $db, $table_prefix;

		// Retrieve the oasl_user_id from the identity_token, using the oasl_identity table.
		$sql = "SELECT oasl_user_id FROM " . $table_prefix . 'oasl_identity' . " WHERE identity_token = '" . $db->sql_escape ($identity_token) . "'";
		$query = $db->sql_query ($sql);
		$result = $db->sql_fetchrow ($query);
		$db->sql_freeresult ($query);

		// No identity token found
		if (!is_array ($result) || empty ($result ['oasl_user_id']))
		{
			return false;
		}

		$user_id = $result ['oasl_user_id'];

		// Delete the identity_token.
		$sql = "DELETE FROM " . $table_prefix . 'oasl_identity' . " WHERE  identity_token = '" . $db->sql_escape ($identity_token) . "'";
		$query = $db->sql_query ($sql);

		// Check if there are any other identities linked to the user_id.
		$sql = "SELECT oasl_user_id FROM " . $table_prefix . 'oasl_identity' . " WHERE oasl_user_id = '" . $db->sql_escape ($user_id) . "'";
		$query = $db->sql_query ($sql);
		$result = $db->sql_fetchrow ($query);
		$db->sql_freeresult ($query);

		// If no identity linked to the oasl_user_id: delete oasl_user_id row from oasl_user table.
		if (!is_array ($result))
		{
			$sql = "DELETE FROM " . $table_prefix . 'oasl_user' . " WHERE  oasl_user_id = '" . $db->sql_escape ($user_id) . "'";
			$query = $db->sql_query ($sql);
		}

		return true;
	}

	/**
	 * Links the user/identity tokens to a user
	 */
	public function link_tokens_to_user_id ($user_id, $user_token, $identity_token, $identity_provider)
	{
		global $db, $table_prefix;

		// Make sure that that the user exists.
		$sql = "SELECT user_id FROM " . USERS_TABLE . " WHERE user_id  = " . intval ($user_id) . "";
		$query = $db->sql_query_limit ($sql, 1);
		$result = $db->sql_fetchrow ($query);
		$db->sql_freeresult ($query);

		// The user exists.
		if (is_array ($result) && !empty ($result ['user_id']))
		{
			$user_id = $result ['user_id'];

			$oasl_user_id = null;
			$oasl_identity_id = null;

			// Delete superfluous user_token.
			$sql = "SELECT oasl_user_id FROM " . $table_prefix . 'oasl_user' . "
							WHERE user_id = " . intval ($user_id) . " AND user_token <> '" . $db->sql_escape ($user_token) . "'";
			$query = $db->sql_query ($sql);
			while ( $row = $db->sql_fetchrow ($query) )
			{
				// Delete the wrongly linked user_token.
				$sql = "DELETE FROM " . $table_prefix . 'oasl_user' . "
								WHERE oasl_user_id = '" . $db->sql_escape ($row ['oasl_user_id']) . "'";
				$query = $db->sql_query ($sql);

				// Delete the wrongly linked identity_token.
				$sql = "DELETE FROM " . $table_prefix . 'oasl_identity' . "
								WHERE oasl_user_id = '" . $db->sql_escape ($row ['oasl_user_id']) . "'";
				$query = $db->sql_query ($sql);
			}
			$db->sql_freeresult ($query);

			// Read the entry for the given user_token.
			$sql = "SELECT oasl_user_id, user_id
							FROM " . $table_prefix . 'oasl_user' . "
							WHERE user_token = '" . $db->sql_escape ($user_token) . "'";
			$query = $db->sql_query ($sql);
			$result = $db->sql_fetchrow ($query);
			$db->sql_freeresult ($query);

			// The user_token exists
			if (is_array ($result) && !empty ($result ['oasl_user_id']))
			{
				$oasl_user_id = $result ['oasl_user_id'];
			}

			// The user_token either does not exist or has been reset.
			if (empty ($oasl_user_id))
			{
				// Add new link.
				$sql_arr = array(
					'user_id' => intval ($user_id),
					'user_token' => $user_token,
					'date_added' => time ()
				);
				$sql = "INSERT INTO " . $table_prefix . 'oasl_user' . " " . $db->sql_build_array ('INSERT', $sql_arr);
				$query = $db->sql_query ($sql);

				// Identifier of the newly created user_token entry.
				$oasl_user_id = $db->sql_nextid ();
			}

			// Read the entry for the given identity_token.
			$sql = "SELECT oasl_identity_id, oasl_user_id, identity_token
							FROM " . $table_prefix . 'oasl_identity' . "
							WHERE identity_token = '" . $db->sql_escape ($identity_token) . "'";
			$query = $db->sql_query ($sql);
			$result = $db->sql_fetchrow ($query);
			$db->sql_freeresult ($query);

			// The identity_token exists
			if (is_array ($result) && !empty ($result ['oasl_identity_id']))
			{
				$oasl_identity_id = $result ['oasl_identity_id'];

				// The identity_token is linked to another user_token.
				if (!empty ($result ['oasl_user_id']) && $result ['oasl_user_id'] != $oasl_user_id)
				{
					// Delete the wrongly linked identity_token.
					$sql = "DELETE FROM " . $table_prefix . "oasl_identity WHERE oasl_identity_id = " . intval ($oasl_identity_id);
					$query = $db->sql_query_limit ($sql, 1);

					// Reset the identifier
					$oasl_identity_id = null;
				}
			}

			// The identity_token either does not exist or has been reset.
			if (empty ($oasl_identity_id))
			{
				// Add new link.
				$sql_arr = array(
					'oasl_user_id' => intval ($oasl_user_id),
					'identity_token' => $identity_token,
					'identity_provider' => $identity_provider,
					'num_logins' => 1,
					'date_added' => time (),
					'date_updated' => time ()
				);
				$sql = "INSERT INTO " . $table_prefix . 'oasl_identity' . " " . $db->sql_build_array ('INSERT', $sql_arr);
				$query = $db->sql_query ($sql);

				// Identifier of the newly created identity_token entry.
				$oasl_identity_id = $db->sql_nextid ();
			}

			// Done.
			return true;
		}

		// An error occured.
		return false;
	}

	/**
	 * Insert temporary user_data for validation in oasl_session table
	 */
	public function put_session_validation_data ($session_id, $validation)
	{
		global $db, $table_prefix;
		$this->delete_session_validation_data ($session_id);
		$sql_arr = array(
			'session_id' => $session_id,
			'user_data' => $validation,
			'date_creation' => time ()
		);
		$sql = "INSERT INTO " . $table_prefix . 'oasl_session' . " " . $db->sql_build_array ('INSERT', $sql_arr);
		$query = $db->sql_query ($sql);
	}

	/**
	 * Retrieve temporary user_data for validation
	 */
	public function get_session_validation_data ($session_id)
	{
		global $db, $table_prefix;
		$sql = "SELECT * FROM " . $table_prefix . 'oasl_session' . " WHERE session_id = '" . $db->sql_escape ($session_id) . "'";
		$query = $db->sql_query ($sql);
		$result = $db->sql_fetchrow ($query);
		$db->sql_freeresult ($query);
		return $result;
	}

	/**
	 * Delete temporary user_data for validation
	 */
	public function delete_session_validation_data ($session_id)
	{
		global $db, $table_prefix;
		$sql = "DELETE FROM " . $table_prefix . "oasl_session" . " WHERE session_id = '" . $db->sql_escape ($session_id) . "' OR date_creation < NOW() - INTERVAL 120 MINUTE";
		$query = $db->sql_query ($sql);
	}

	/**
	 * Generates a random email address
	 */
	protected function generate_random_email ()
	{
		do
		{
			$email = $this->generate_hash (10) . "@example.com";
		}
		while ( $this->get_user_id_by_email ($email) !== false );

		// Done
		return $email;
	}

	/**
	 * Generates a random hash of the given length
	 */
	protected function generate_hash ($length)
	{
		$hash = '';

		for($i = 0; $i < $length; $i ++)
		{
			do
			{
				$char = chr (mt_rand (48, 122));
			}
			while ( !preg_match ('/[a-zA-Z0-9]/', $char) );
			$hash .= $char;
		}

		// Done
		return $hash;
	}

	/**
	 * Login the current user with the give $user_id.
	 */
	protected function do_login ($user_id, $check_admin = false)
	{
		global $auth, $db, $user, $table_prefix;

		// Grab the list of admins to check if this user is an administrator.
		if ($check_admin === true)
		{
			$admin_user_ids = $auth->acl_get_list (false, 'a_user', false);
			$admin_user_ids = (!empty ($admin_user_ids [0] ['a_user'])) ? $admin_user_ids [0] ['a_user'] : array();
			$is_admin = (in_array ($user_id, $admin_user_ids) ? true : false);

			// Store the old session id for later use.
			$old_session_id = $user->session_id;

			// This user is an administrator.
			if ($is_admin === true)
			{
				global $SID, $_SID;

				// Refresh the cookie.
				$cookie_expire = time () - 31536000;
				$user->set_cookie ('u', '', $cookie_expire);
				$user->set_cookie ('sid', '', $cookie_expire);

				// Refresh the session id.
				$SID = '?sid=';
				$user->session_id = $_SID = '';
			}
		}
		else
		{
			$is_admin = false;
		}

		// Log the user in.
		$result = $user->session_create ($user_id, $is_admin);

		// Session created successfully.
		if ($result === true)
		{
			// For admins we remove the old session entry because a new one has been created.
			if ($is_admin === true)
			{
				$sql = 'DELETE FROM ' . SESSIONS_TABLE . " WHERE session_id = '" . $db->sql_escape ($old_session_id) . "' AND session_user_id = " . intval ($user_id) . "";
				$db->sql_query ($sql);
			}

			// We re-init the auth array to get correct results on login/logout.
			$auth->acl ($user->data);

			// Done.
			return true;
		}

		// An error has occurred.
		return false;
	}

	/**
	 * Get the user_id for a given email address.
	 */
	protected function get_user_id_by_email ($email)
	{
		global $db, $table_prefix;

		// Read the user_id for this email address.
		$sql = "SELECT user_id FROM " . USERS_TABLE . " WHERE user_email  = '" . $db->sql_escape ($email) . "'";
		$query = $db->sql_query_limit ($sql, 1);
		$result = $db->sql_fetchrow ($query);
		$db->sql_freeresult ($query);

		// We have found an user_id.
		if (is_array ($result) && !empty ($result ['user_id']))
		{
			return $result ['user_id'];
		}

		// Not found.
		return false;
	}

	/**
	 * Get the user_id for a given a username.
	 */
	protected function get_user_id_by_username ($user_login)
	{
		global $db, $table_prefix;

		// Read the user_id for this login
		$sql = "SELECT user_id FROM " . USERS_TABLE . " WHERE username_clean = '" . $db->sql_escape (utf8_clean_string ($user_login)) . "'";
		$query = $db->sql_query_limit ($sql, 1);
		$result = $db->sql_fetchrow ($query);
		$db->sql_freeresult ($query);

		// We have found an user_id.
		if (is_array ($result) && !empty ($result ['user_id']))
		{
			return $result ['user_id'];
		}

		// Not found.
		return false;
	}

	/**
	 * Returns the user_id for a given token.
	 */
	protected function get_user_id_for_user_token ($user_token)
	{
		global $db, $table_prefix;

		// Make sure it is not empty.
		$user_token = trim ($user_token);
		if (strlen ($user_token) == 0)
		{
			return false;
		}

		// Read the user_id for this user_token.
		$sql = "SELECT oasl_user_id, user_id FROM " . $table_prefix . 'oasl_user' . " WHERE user_token = '" . $db->sql_escape ($user_token) . "'";
		$query = $db->sql_query ($sql);
		$result = $db->sql_fetchrow ($query);
		$db->sql_freeresult ($query);

		// The user_token exists
		if (is_array ($result) && !empty ($result ['oasl_user_id']))
		{
			$user_id = intval ($result ['user_id']);
			$oasl_user_id = intval ($result ['oasl_user_id']);

			// Check if the user account exists.
			$sql = "SELECT user_id FROM " . USERS_TABLE . " WHERE user_id = " . intval ($user_id);
			$query = $db->sql_query_limit ($sql, 1);
			$result = $db->sql_fetchrow ($query);
			$db->sql_freeresult ($query);

			// The user account exists, return it's identifier.
			if (is_array ($result) && !empty ($result ['user_id']))
			{
				return $result ['user_id'];
			}

			// Delete the wrongly linked user_token.
			$sql = "DELETE FROM " . $table_prefix . 'oasl_user' . " WHERE user_token = '" . $db->sql_escape ($user_token) . "'";
			$query = $db->sql_query ($sql);

			// Delete the wrongly linked identity_token.
			$sql = "DELETE FROM " . $table_prefix . 'oasl_identity' . " WHERE oasl_user_id = " . intval ($oasl_user_id) . "";
			$query = $db->sql_query ($sql);
		}

		// No entry found.
		return false;
	}

	/**
	 * Get the user_token from a user_id
	 */
	public function get_user_token_for_user_id ($user_id)
	{
		global $db, $table_prefix;

		// Read the user_id for this user_token.
		$sql = "SELECT user_token FROM " . $table_prefix . 'oasl_user' . " WHERE user_id = " . intval ($user_id);
		$query = $db->sql_query_limit ($sql, 1);
		$result = $db->sql_fetchrow ($query);
		$db->sql_freeresult ($query);

		// The user_token exists
		if (is_array ($result) && !empty ($result ['user_token']))
		{
			return $result ['user_token'];
		}

		// Not found
		return false;
	}

	/**
	 * Returns the user_id for a login token
	 */
	protected function get_user_id_for_login_token ($login_token)
	{
		global $db, $table_prefix;

		// Read the user_id for this login_token
		$sql = "SELECT user_id FROM " . $table_prefix . 'oasl_login_token' . " WHERE login_token = '" . $db->sql_escape ($login_token) . "'";
		$query = $db->sql_query_limit ($sql, 1);
		$result = $db->sql_fetchrow ($query);
		$db->sql_freeresult ($query);

		// The login_token exists
		if (is_array ($result) && !empty ($result ['user_id']))
		{
			return $result ['user_id'];
		}

		// Not found
		return false;
	}

	/**
	 * Create a login token for a user_id
	 */
	public function create_login_token_for_user_id ($user_id)
	{
		global $db, $table_prefix;

		// Remove old or existing login token.
		$sql = "DELETE FROM " . $table_prefix . 'oasl_login_token' . " WHERE (user_id = " . intval ($user_id) . " OR date_creation < " . (time () - 60 * 5) . ")";
		$query = $db->sql_query ($sql);

		// Create a new and unique token.
		do
		{
			$login_token = $this->get_uuid_v4 ();
		}
		while ( $this->get_user_id_for_login_token ($login_token) !== false );

		// Add the new token.
		$sql_arr = array(
			'login_token' => $login_token,
			'user_id' => $user_id,
			'date_creation' => time ()
		);

		$sql = "INSERT INTO " . $table_prefix . 'oasl_login_token' . " " . $db->sql_build_array ('INSERT', $sql_arr);
		$query = $db->sql_query ($sql);

		// Done
		return $login_token;
	}

	/**
	 * Get the default group_id for new users
	 */
	function get_default_group_id ()
	{
		global $db;

		// Read the default group.
		$sql = "SELECT group_id FROM " . GROUPS_TABLE . " WHERE group_name = 'REGISTERED' AND group_type = " . GROUP_SPECIAL;
		$query = $db->sql_query ($sql);
		$result = $db->sql_fetchrow ($query);
		$db->sql_freeresult ($query);

		// Group found;
		if (is_array ($result) && isset ($result ['group_id']))
		{
			return $result ['group_id'];
		}

		// Not found
		return false;
	}

	/**
	 * Get the user data for a user_id
	 */
	function get_user_data_by_user_id ($user_id)
	{
		global $db, $table_prefix;

		// Read the user data.
		$sql = "SELECT * FROM " . USERS_TABLE . " WHERE user_id = " . intval ($user_id) . "";
		$query = $db->sql_query_limit ($sql, 1);
		$result = $db->sql_fetchrow ($query);
		$db->sql_freeresult ($query);

		// The user has been found.
		if (is_array ($result))
		{
			return $result;
		}

		// Not found.
		return array();
	}

	/**
	 * Generates a v4 UUID.
	 */
	function get_uuid_v4 ()
	{
		return sprintf ('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand (0, 0xffff), mt_rand (0, 0xffff), mt_rand (0, 0xffff), mt_rand (0, 0x0fff) | 0x4000, mt_rand (0, 0x3fff) | 0x8000, mt_rand (0, 0xffff), mt_rand (0, 0xffff), mt_rand (0, 0xffff));
	}

	/**
	 * Returns the list of available social networks.
	 */
	public function get_providers ()
	{
		$providers = array(
			'amazon' => array(
				'name' => 'Amazon'
			),
			'blogger' => array(
				'name' => 'Blogger'
			),
			'disqus' => array(
				'name' => 'Disqus'
			),
			'draugiem' => array(
				'name' => 'Draugiem'
			),
			'dribbble' => array(
				'name' => 'Dribbble'
			),
			'facebook' => array(
				'name' => 'Facebook'
			),
			'foursquare' => array(
				'name' => 'Foursquare'
			),
			'github' => array(
				'name' => 'Github.com'
			),
			'google' => array(
				'name' => 'Google'
			),
			'instagram' => array(
				'name' => 'Instagram'
			),
			'linkedin' => array(
				'name' => 'LinkedIn'
			),
			'livejournal' => array(
				'name' => 'LiveJournal'
			),
			'mailru' => array(
				'name' => 'Mail.ru'
			),
			'odnoklassniki' => array(
				'name' => 'Odnoklassniki'
			),
			'openid' => array(
				'name' => 'OpenID'
			),
			'paypal' => array(
				'name' => 'PayPal'
			),
			'reddit' => array(
				'name' => 'Reddit'
			),
			'skyrock' => array(
				'name' => 'Skyrock.com'
			),
			'stackexchange' => array(
				'name' => 'StackExchange'
			),
			'steam' => array(
				'name' => 'Steam'
			),
			'twitch' => array(
				'name' => 'Twitch.tv'
			),
			'twitter' => array(
				'name' => 'Twitter'
			),
			'vimeo' => array(
				'name' => 'Vimeo'
			),
			'vkontakte' => array(
				'name' => 'VKontakte'
			),
			'windowslive' => array(
				'name' => 'Windows Live'
			),
			'wordpress' => array(
				'name' => 'WordPress.com'
			),
			'yahoo' => array(
				'name' => 'Yahoo'
			),
			'youtube' => array(
				'name' => 'YouTube'
			),
			'battlenet' => array(
				'name' => 'BattleNet'
			)
		);
		return $providers;
	}

	/**
	 * Returns a list of disabled PHP functions.
	 */
	protected function get_php_disabled_functions ()
	{
		$disabled_functions = trim (ini_get ('disable_functions'));
		if (strlen ($disabled_functions) == 0)
		{
			$disabled_functions = array();
		}
		else
		{
			$disabled_functions = explode (',', $disabled_functions);
			$disabled_functions = array_map ('trim', $disabled_functions);
		}
		return $disabled_functions;
	}

	/**
	 * Sends an API request by using the given handler.
	 */
	public function do_api_request ($handler, $url, $options = array(), $timeout = 30)
	{
		// FSOCKOPEN
		if ($handler == 'fsockopen')
		{
			return $this->fsockopen_request ($url, $options, $timeout);
		}
		// CURL
		else
		{

			return $this->curl_request ($url, $options, $timeout);
		}
	}

	/**
	 * Checks if CURL can be used.
	 */
	public function check_curl ($secure = true)
	{
		if (in_array ('curl', get_loaded_extensions ()) && function_exists ('curl_exec') && !in_array ('curl_exec', $this->get_php_disabled_functions ()))
		{
			$result = $this->curl_request (($secure ? 'https' : 'http') . '://www.oneall.com/ping.html');
			if (is_object ($result) && property_exists ($result, 'http_code') && $result->http_code == 200)
			{
				if (property_exists ($result, 'http_data'))
				{
					if (strtolower ($result->http_data) == 'ok')
					{
						return true;
					}
				}
			}
		}
		return false;
	}

	/**
	 * Checks if fsockopen can be used.
	 */
	public function check_fsockopen ($secure = true)
	{
		if (function_exists ('fsockopen') && !in_array ('fsockopen', $this->get_php_disabled_functions ()))
		{
			$result = $this->fsockopen_request (($secure ? 'https' : 'http') . '://www.oneall.com/ping.html');
			if (is_object ($result) && property_exists ($result, 'http_code') && $result->http_code == 200)
			{
				if (property_exists ($result, 'http_data'))
				{
					if (strtolower ($result->http_data) == 'ok')
					{
						return true;
					}
				}
			}
		}
		return false;
	}

	/**
	 * Sends a CURL request.
	 */
	function curl_request ($url, $options = array(), $timeout = 30, $num_redirects = 0)
	{
		// Store the result
		$result = new \stdClass ();

		// Send request
		$curl = curl_init ();
		curl_setopt ($curl, CURLOPT_URL, $url);
		curl_setopt ($curl, CURLOPT_HEADER, 1);
		curl_setopt ($curl, CURLOPT_TIMEOUT, $timeout);
		curl_setopt ($curl, CURLOPT_REFERER, $url);
		curl_setopt ($curl, CURLOPT_VERBOSE, 0);
		curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ($curl, CURLOPT_USERAGENT, self::USER_AGENT);

		// Does not work in PHP Safe Mode, we manually follow the locations if necessary.
		curl_setopt ($curl, CURLOPT_FOLLOWLOCATION, 0);

		// BASIC AUTH?
		if (isset ($options ['api_key']) && isset ($options ['api_secret']))
		{
			curl_setopt ($curl, CURLOPT_USERPWD, $options ['api_key'] . ':' . $options ['api_secret']);
		}

		// Proxy Settings
		if ( ! empty ($options ['proxy_url']))
		{
			// Proxy Location
			curl_setopt ($curl, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
			curl_setopt ($curl, CURLOPT_PROXY, $options ['proxy_url']);

			// Proxy Port
			if ( ! empty ($options ['proxy_port']))
			{
				curl_setopt ($curl, CURLOPT_PROXYPORT, $options ['proxy_port']);
			}

			// Proxy Authentication
			if ( ! empty ($options ['proxy_username']) && ! empty ($options ['proxy_password']))
			{
				curl_setopt ($curl, CURLOPT_PROXYAUTH, CURLAUTH_ANY);
				curl_setopt ($curl, CURLOPT_PROXYUSERPWD, $options ['proxy_username'] . ':' . $options ['proxy_password']);
			}
		}

		// Make request
		if (($response = curl_exec ($curl)) !== false)
		{
			// Get Information
			$curl_info = curl_getinfo ($curl);

			// Save result
			$result->http_code = $curl_info ['http_code'];
			$result->http_headers = preg_split ('/\r\n|\n|\r/', trim (substr ($response, 0, $curl_info ['header_size'])));
			$result->http_data = trim (substr ($response, $curl_info ['header_size']));
			$result->http_error = null;

			// Check if we have a redirection header
			if (in_array ($result->http_code, array(301, 302)) && $num_redirects < 4)
			{
				// Make sure we have http headers
				if (is_array ($result->http_headers))
				{
					// Header found ?
					$header_found = false;

					// Loop through headers.
					while ( !$header_found && (list (, $header) = each ($result->http_headers)) )
					{
						// Try to parse a redirection header.
						if (preg_match ("/(Location:|URI:)[^(\n)]*/", $header, $matches))
						{
							// Sanitize redirection url.
							$url_tmp = trim (str_replace ($matches [1], "", $matches [0]));
							$url_parsed = parse_url ($url_tmp);
							if (!empty ($url_parsed))
							{
								// Header found!
								$header_found = true;

								// Follow redirection url.
								$result = self::curl_request ($url_tmp, $options, $timeout, $num_redirects + 1);
							}
						}
					}
				}
			}
		}
		else
		{
			$result->http_code = -1;
			$result->http_data = null;
			$result->http_error = curl_error ($curl);
		}

		// Done
		return $result;
	}

	/**
	 * Sends an fsockopen request.
	 */
	protected function fsockopen_request ($url, $options = array(), $timeout = 30, $num_redirects = 0)
	{
		// Store the result
		$result = new \stdClass ();

		// Make that this is a valid URL
		if (($uri = parse_url ($url)) == false)
		{
			$result->http_code = -1;
			$result->http_data = null;
			$result->http_error = 'invalid_uri';
			return $result;
		}

		// Make sure we can handle the schema
		switch ($uri ['scheme'])
		{
			case 'http' :
				$port = (isset ($uri ['port']) ? $uri ['port'] : 80);
				$host = ($uri ['host'] . ($port != 80 ? ':' . $port : ''));
				$fp = @fsockopen ($uri ['host'], $port, $errno, $errstr, $timeout);
			break;

			case 'https' :
				$port = (isset ($uri ['port']) ? $uri ['port'] : 443);
				$host = ($uri ['host'] . ($port != 443 ? ':' . $port : ''));
				$fp = @fsockopen ('ssl://' . $uri ['host'], $port, $errno, $errstr, $timeout);
			break;

			default :
				$result->http_code = -1;
				$result->http_data = null;
				$result->http_error = 'invalid_schema';
				return $result;
			break;
		}

		// Make sure the socket opened properly
		if (!$fp)
		{
			$result->http_code = -$errno;
			$result->http_data = null;
			$result->http_error = trim ($errstr);
			return $result;
		}

		// Construct the path to act on
		$path = (isset ($uri ['path']) ? $uri ['path'] : '/');
		if (isset ($uri ['query']))
		{
			$path .= '?' . $uri ['query'];
		}

		// Create HTTP request
		$defaults = array();
		$defaults ['Host'] = 'Host: ' . $host;
		$defaults ['User-Agent'] = 'User-Agent: ' . self::USER_AGENT;

		// BASIC AUTH?
		if (isset ($options ['api_key']) && isset ($options ['api_secret']))
		{
			$defaults ['Authorization'] = 'Authorization: Basic ' . base64_encode ($options ['api_key'] . ":" . $options ['api_secret']);
		}

		// Build and send request
		$request = 'GET ' . $path . " HTTP/1.0\r\n";
		$request .= implode ("\r\n", $defaults);
		$request .= "\r\n\r\n";
		fwrite ($fp, $request);

		// Fetch response
		$response = '';
		while ( !feof ($fp) )
		{
			$response .= fread ($fp, 1024);
		}

		// Close connection
		fclose ($fp);

		// Parse response
		list ($response_header, $response_body) = explode ("\r\n\r\n", $response, 2);

		// Parse header
		$response_header = preg_split ("/\r\n|\n|\r/", $response_header);
		list ($header_protocol, $header_code, $header_status_message) = explode (' ', trim (array_shift ($response_header)), 3);

		// Set result
		$result->http_code = $header_code;
		$result->http_headers = $response_header;
		$result->http_data = $response_body;

		// Make sure we we have a redirection status code
		if (in_array ($result->http_code, array(301, 302)) && $num_redirects <= 4)
		{
			// Make sure we have http headers
			if (is_array ($result->http_headers))
			{
				// Header found?
				$header_found = false;

				// Loop through headers.
				while ( !$header_found && (list (, $header) = each ($result->http_headers)) )
				{
					// Check for location header
					if (preg_match ("/(Location:|URI:)[^(\n)]*/", $header, $matches))
					{
						// Found
						$header_found = true;

						// Clean url
						$url_tmp = trim (str_replace ($matches [1], "", $matches [0]));
						$url_parsed = parse_url ($url_tmp);

						// Found
						if (!empty ($url_parsed))
						{
							$result = self::fsockopen_request ($url_tmp, $options, $timeout, $num_redirects + 1);
						}
					}
				}
			}
		}

		// Done
		return $result;
	}

	/**
	 * Inverts CamelCase -> camel_case.
	 */
	public static function undo_camel_case ($input)
	{
		$result = $input;

		if (preg_match_all ('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches))
		{
			$ret = $matches [0];

			foreach ($ret as &$match)
			{
				$match = ($match == strtoupper ($match) ? strtolower ($match) : lcfirst ($match));
			}

			$result = implode ('_', $ret);
		}

		return $result;
	}

	/**
	 * Extracts the social network data from a result-set returned by the OneAll API.
	 */
	public static function extract_social_network_profile ($reply)
	{
		// Check API result.
		if (is_object ($reply) && property_exists ($reply, 'http_code') && $reply->http_code == 200 && property_exists ($reply, 'http_data'))
		{
			// Decode the social network profile Data.
			$social_data = json_decode ($reply->http_data);

			// Make sur that the data has beeen decoded properly
			if (is_object ($social_data))
			{
				// Provider may report an error inside message:
				if (!empty ($social_data->response->result->status->flag) && $social_data->response->result->status->code >= 400)
				{
					error_log ($social_data->response->result->status->info . ' (' . $social_data->response->result->status->code . ')');
					return false;
				}

				// Container for user data
				$data = array();

				// Parse plugin data.
				if (isset ($social_data->response->result->data->plugin))
				{
					// Plugin.
					$plugin = $social_data->response->result->data->plugin;

					// Add plugin data.
					$data ['plugin_key'] = $plugin->key;
					$data ['plugin_action'] = (isset ($plugin->data->action) ? $plugin->data->action : null);
					$data ['plugin_operation'] = (isset ($plugin->data->operation) ? $plugin->data->operation : null);
					$data ['plugin_reason'] = (isset ($plugin->data->reason) ? $plugin->data->reason : null);
					$data ['plugin_status'] = (isset ($plugin->data->status) ? $plugin->data->status : null);
				}

				// Do we have a user?
				if (isset ($social_data->response->result->data->user) && is_object ($social_data->response->result->data->user))
				{
					// User.
					$user = $social_data->response->result->data->user;

					// Add user data.
					$data ['user_token'] = $user->user_token;

					// Do we have an identity ?
					if (isset ($user->identity) && is_object ($user->identity))
					{
						// Identity.
						$identity = $user->identity;

						// Add identity data.
						$data ['identity_token'] = $identity->identity_token;
						$data ['identity_provider'] = !empty ($identity->source->name) ? $identity->source->name : '';

						$data ['user_first_name'] = !empty ($identity->name->givenName) ? $identity->name->givenName : '';
						$data ['user_last_name'] = !empty ($identity->name->familyName) ? $identity->name->familyName : '';
						$data ['user_formatted_name'] = !empty ($identity->name->formatted) ? $identity->name->formatted : '';
						$data ['user_location'] = !empty ($identity->currentLocation) ? $identity->currentLocation : '';
						$data ['user_constructed_name'] = trim ($data ['user_first_name'] . ' ' . $data ['user_last_name']);
						$data ['user_picture'] = !empty ($identity->pictureUrl) ? $identity->pictureUrl : '';
						$data ['user_thumbnail'] = !empty ($identity->thumbnailUrl) ? $identity->thumbnailUrl : '';
						$data ['user_current_location'] = !empty ($identity->currentLocation) ? $identity->currentLocation : '';
						$data ['user_about_me'] = !empty ($identity->aboutMe) ? $identity->aboutMe : '';
						$data ['user_note'] = !empty ($identity->note) ? $identity->note : '';

						// Birthdate - MM/DD/YYYY
						if (!empty ($identity->birthday) && preg_match ('/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/', $identity->birthday, $matches))
						{
							$data ['user_birthdate'] = str_pad ($matches [2], 2, '0', STR_PAD_LEFT);
							$data ['user_birthdate'] .= '/' . str_pad ($matches [1], 2, '0', STR_PAD_LEFT);
							$data ['user_birthdate'] .= '/' . str_pad ($matches [3], 4, '0', STR_PAD_LEFT);
						}
						else
						{
							$data ['user_birthdate'] = '';
						}

						// Fullname.
						if (!empty ($identity->name->formatted))
						{
							$data ['user_full_name'] = $identity->name->formatted;
						}
						elseif (!empty ($identity->name->displayName))
						{
							$data ['user_full_name'] = $identity->name->displayName;
						}
						else
						{
							$data ['user_full_name'] = $data ['user_constructed_name'];
						}

						// Preferred Username.
						if (!empty ($identity->preferredUsername))
						{
							$data ['user_login'] = $identity->preferredUsername;
						}
						elseif (!empty ($identity->displayName))
						{
							$data ['user_login'] = $identity->displayName;
						}
						else
						{
							$data ['user_login'] = $data ['user_full_name'];
						}

						// phpBB does not like spaces here
						$data ['user_login'] = str_replace (' ', '', trim ($data ['user_login']));

						// Website/Homepage.
						$data ['user_website'] = '';
						if (!empty ($identity->profileUrl))
						{
							$data ['user_website'] = $identity->profileUrl;
						}
						elseif (!empty ($identity->urls [0]->value))
						{
							$data ['user_website'] = $identity->urls [0]->value;
						}

						// Gender.
						$data ['user_gender'] = '';
						if (!empty ($identity->gender))
						{
							switch ($identity->gender)
							{
								case 'male' :
									$data ['user_gender'] = 'm';
								break;

								case 'female' :
									$data ['user_gender'] = 'f';
								break;
							}
						}

						// Email Addresses.
						$data ['user_emails'] = array();
						$data ['user_emails_simple'] = array();

						// Email Address.
						$data ['user_email'] = '';
						$data ['user_email_is_verified'] = false;

						// Extract emails.
						if (property_exists ($identity, 'emails') && is_array ($identity->emails))
						{
							// Loop through emails.
							foreach ($identity->emails as $email)
							{
								// Add to simple list.
								$data ['user_emails_simple'] [] = $email->value;

								// Add to list.
								$data ['user_emails'] [] = array(
									'user_email' => $email->value,
									'user_email_is_verified' => $email->is_verified
								);

								// Keep one, if possible a verified one.
								if (empty ($data ['user_email']) || $email->is_verified)
								{
									$data ['user_email'] = $email->value;
									$data ['user_email_is_verified'] = $email->is_verified;
								}
							}
						}

						// Addresses.
						$data ['user_addresses'] = array();
						$data ['user_addresses_simple'] = array();

						// Extract entries.
						if (property_exists ($identity, 'addresses') && is_array ($identity->addresses))
						{
							// Loop through entries.
							foreach ($identity->addresses as $address)
							{
								// Add to simple list.
								$data ['user_addresses_simple'] [] = $address->formatted;

								// Add to list.
								$data ['user_addresses'] [] = array(
									'formatted' => $address->formatted
								);
							}
						}

						// Phone Number.
						$data ['user_phone_numbers'] = array();
						$data ['user_phone_numbers_simple'] = array();

						// Extract entries.
						if (property_exists ($identity, 'phoneNumbers') && is_array ($identity->phoneNumbers))
						{
							// Loop through entries.
							foreach ($identity->phoneNumbers as $phone_number)
							{
								// Add to simple list.
								$data ['user_phone_numbers_simple'] [] = $phone_number->value;

								// Add to list.
								$data ['user_phone_numbers'] [] = array(
									'value' => $phone_number->value,
									'type' => (isset ($phone_number->type) ? $phone_number->type : null)
								);
							}
						}

						// URLs.
						$data ['user_interests'] = array();
						$data ['user_interests_simple'] = array();

						// Extract entries.
						if (property_exists ($identity, 'interests') && is_array ($identity->interests))
						{
							// Loop through entries.
							foreach ($identity->interests as $interest)
							{
								// Add to simple list.
								$data ['user_interests_simple'] [] = $interest->value;

								// Add to list.
								$data ['users_interests'] [] = array(
									'value' => $interest->value,
									'category' => (isset ($interest->category) ? $interest->category : null)
								);
							}
						}

						// URLs.
						$data ['user_urls'] = array();
						$data ['user_urls_simple'] = array();

						// Extract entries.
						if (property_exists ($identity, 'urls') && is_array ($identity->urls))
						{
							// Loop through entries.
							foreach ($identity->urls as $url)
							{
								// Add to simple list.
								$data ['user_urls_simple'] [] = $url->value;

								// Add to list.
								$data ['user_urls'] [] = array(
									'value' => $url->value,
									'type' => (isset ($url->type) ? $url->type : null)
								);
							}
						}

						// Certifications.
						$data ['user_certifications'] = array();
						$data ['user_certifications_simple'] = array();

						// Extract entries.
						if (property_exists ($identity, 'certifications') && is_array ($identity->certifications))
						{
							// Loop through entries.
							foreach ($identity->certifications as $certification)
							{
								// Add to simple list.
								$data ['user_certifications_simple'] [] = $certification->name;

								// Add to list.
								$data ['user_certifications'] [] = array(
									'name' => $certification->name,
									'number' => (isset ($certification->number) ? $certification->number : null),
									'authority' => (isset ($certification->authority) ? $certification->authority : null),
									'start_date' => (isset ($certification->startDate) ? $certification->startDate : null)
								);
							}
						}

						// Recommendations.
						$data ['user_recommendations'] = array();
						$data ['user_recommendations_simple'] = array();

						// Extract entries.
						if (property_exists ($identity, 'recommendations') && is_array ($identity->recommendations))
						{
							// Loop through entries.
							foreach ($identity->recommendations as $recommendation)
							{
								// Add to simple list.
								$data ['user_recommendations_simple'] [] = $recommendation->value;

								// Build data.
								$data_entry = array(
									'value' => $recommendation->value
								);

								// Add recommender
								if (property_exists ($recommendation, 'recommender') && is_object ($recommendation->recommender))
								{
									$data_entry ['recommender'] = array();

									// Add recommender details
									foreach (get_object_vars ($recommendation->recommender) as $field => $value)
									{
										$data_entry ['recommender'] [self::undo_camel_case ($field)] = $value;
									}
								}

								// Add to list.
								$data ['user_recommendations'] [] = $data_entry;
							}
						}

						// Accounts.
						$data ['user_accounts'] = array();

						// Extract entries.
						if (property_exists ($identity, 'accounts') && is_array ($identity->accounts))
						{
							// Loop through entries.
							foreach ($identity->accounts as $account)
							{
								// Add to list.
								$data ['user_accounts'] [] = array(
									'domain' => (isset ($account->domain) ? $account->domain : null),
									'userid' => (isset ($account->userid) ? $account->userid : null),
									'username' => (isset ($account->username) ? $account->username : null)
								);
							}
						}

						// Photos.
						$data ['user_photos'] = array();
						$data ['user_photos_simple'] = array();

						// Extract entries.
						if (property_exists ($identity, 'photos') && is_array ($identity->photos))
						{
							// Loop through entries.
							foreach ($identity->photos as $photo)
							{
								// Add to simple list.
								$data ['user_photos_simple'] [] = $photo->value;

								// Add to list.
								$data ['user_photos'] [] = array(
									'value' => $photo->value,
									'size' => $photo->size
								);
							}
						}

						// Languages.
						$data ['user_languages'] = array();
						$data ['user_languages_simple'] = array();

						// Extract entries.
						if (property_exists ($identity, 'languages') && is_array ($identity->languages))
						{
							// Loop through entries.
							foreach ($identity->languages as $language)
							{
								// Add to simple list
								$data ['user_languages_simple'] [] = $language->value;

								// Add to list.
								$data ['user_languages'] [] = array(
									'value' => $language->value,
									'type' => $language->type
								);
							}
						}

						// Educations.
						$data ['user_educations'] = array();
						$data ['user_educations_simple'] = array();

						// Extract entries.
						if (property_exists ($identity, 'educations') && is_array ($identity->educations))
						{
							// Loop through entries.
							foreach ($identity->educations as $education)
							{
								// Add to simple list.
								$data ['user_educations_simple'] [] = $education->value;

								// Add to list.
								$data ['user_educations'] [] = array(
									'value' => $education->value,
									'type' => $education->type
								);
							}
						}

						// Organizations.
						$data ['user_organizations'] = array();
						$data ['user_organizations_simple'] = array();

						// Extract entries.
						if (property_exists ($identity, 'organizations') && is_array ($identity->organizations))
						{
							// Loop through entries.
							foreach ($identity->organizations as $organization)
							{
								// At least the name is required.
								if (!empty ($organization->name))
								{
									// Add to simple list.
									$data ['user_organizations_simple'] [] = $organization->name;

									// Build entry.
									$data_entry = array();

									// Add all fields.
									foreach (get_object_vars ($organization) as $field => $value)
									{
										$data_entry [self::undo_camel_case ($field)] = $value;
									}

									// Add to list.
									$data ['user_organizations'] [] = $data_entry;
								}
							}
						}
					}
				}
				return $data;
			}
		}
		return false;
	}

	/**
	 * Callback Handler.
	 */
	public function handle_callback ()
	{
		// Required global variables.
		global $db, $auth, $user, $config, $template, $phpbb_root_path, $phpbb_admin_path, $phpEx, $request;

		// Add language file.
		$user->add_lang_ext ('oneall/sociallogin', 'frontend');

		// Read arguments.
		$connection_token = trim ($request->variable ('connection_token', ''));
		$login_token = trim ($request->variable ('oa_social_login_login_token', ''));
		$oa_action = strtolower (trim ($request->variable ('oa_action', '')));

		// Make sure we need to call the callback handler.
		if (strlen ($oa_action) > 0 && strlen ($connection_token) > 0)
		{
			// Make sure Social Login is enabled.
			if (empty ($config ['oa_social_login_disable']))
			{
				// Required settings.
				if (!empty ($config ['oa_social_login_api_subdomain']) && !empty ($config ['oa_social_login_api_key']) && !empty ($config ['oa_social_login_api_secret']))
				{
					// API Settings.
					$api_connection_handler = ((!empty ($config ['oa_social_login_api_connection_handler']) && $config ['oa_social_login_api_connection_handler'] == 'fsockopen') ? 'fsockopen' : 'curl');
					$api_connection_use_https = ((!empty ($config ['oa_social_login_api_connection_port']) && $config ['oa_social_login_api_connection_port'] == '80') ? false : true);
					$api_connection_url = ($api_connection_use_https ? 'https' : 'http') . '://' . $config ['oa_social_login_api_subdomain'] . '.api.oneall.com/connections/' . $connection_token . '.json';

					// API Credentials.
					$api_credentials = array();
					$api_credentials ['api_key'] = $config ['oa_social_login_api_key'];
					$api_credentials ['api_secret'] = $config ['oa_social_login_api_secret'];

					// Make Request.
					$result = $this->do_api_request ($api_connection_handler, $api_connection_url, $api_credentials);

					// Parse result
					if (is_object ($result) && property_exists ($result, 'http_code') && $result->http_code == 200)
					{
						// Extract data
						if (($user_data = $this->extract_social_network_profile ($result)) !== false)
						{
							// Social Login
							if ($oa_action == 'social_login')
							{
								return $this->social_login_handle_callback ($user_data);
							}
							// Social Link
							elseif ($oa_action == 'social_link')
							{
								// This argument is required.
								if (!empty ($login_token))
								{
									// Read the user_id for this login_token.
									$user_id_login_token = $this->get_user_id_for_login_token ($login_token);

									// We have a user for this login token
									if (is_numeric ($user_id_login_token))
									{
										// Update the tokens?
										$update_tokens = true;

										// Read the user_id for this user_token
										$user_id_user_token = $this->get_user_id_for_user_token ($user_data ['user_token']);

										// There is already a user_id for this token
										if (!empty ($user_id_user_token))
										{
											// The existing user_id does not match the logged in user
											if ($user_id_user_token != $user_id_login_token)
											{
												// Show an error to the user.
												$template->assign_var ('OA_SOCIAL_LINK_ERROR', $user->lang ['OA_SOCIAL_LOGIN_ACCOUNT_ALREADY_LINKED']);

												// Do not updated the tokens.
												$update_tokens = false;
											}
										}

										// Update token?
										if ($update_tokens === true)
										{
											if (!empty ($user_data ['plugin_action']) && $user_data ['plugin_action'] == 'link_identity')
											{
												$this->link_tokens_to_user_id ($user_id_login_token, $user_data ['user_token'], $user_data ['identity_token'], $user_data ['identity_provider']);
											}
											else
											{
												$this->unlink_identity_token ($user_data ['identity_token']);
											}
										}

										// Log the user in
										$this->do_login ($user_id_login_token);

										// Redirect to the same page
										self::http_redirect (append_sid (self::get_current_url ()));
									}
								}
							}
						}
					}
				}
			}
		}
		else
		{
			return '';
		}
	}

	/**
	 * Handle callback for social login
	 */
	protected function social_login_handle_callback ($user_data)
	{
		global $db, $auth, $user, $config, $template, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$error_message = null;
		$user_id = null;

		// Get user_id by token.
		$user_id_tmp = $this->get_user_id_for_user_token ($user_data ['user_token']);

		// We already have a user for this token.
		if (is_numeric ($user_id_tmp))
		{
			// Process this user.
			$user_id = $user_id_tmp;

			// Load user data.
			$user_profile = $this->get_user_data_by_user_id ($user_id);

			// The user account needs to be activated.
			if (!empty ($user_profile ['user_inactive_reason']))
			{
				if ($config ['require_activation'] == USER_ACTIVATION_ADMIN)
				{
					$error_message = $user->lang ['OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_ADMIN'];
				}
				else
				{
					$error_message = $user->lang ['OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_OTHER'];
				}
			}
		}
		// No user has been found for this token.
		else
		{
			// Make sure that account linking is enabled.
			if (empty ($config ['oa_social_login_disable_linking']))
			{
				// Make sure that the email has been verified.
				if (!empty ($user_data ['user_email']) && isset ($user_data ['user_email_is_verified']) && $user_data ['user_email_is_verified'] === true)
				{
					// Read existing user
					$user_id_tmp = $this->get_user_id_by_email ($user_data ['user_email']);

					// Existing user found
					if (is_numeric ($user_id_tmp))
					{
						// Link the user to this social network.
						if ($this->link_tokens_to_user_id ($user_id_tmp, $user_data ['user_token'], $user_data ['identity_token'], $user_data ['identity_provider']) !== false)
						{
							$user_id = $user_id_tmp;
						}
					}
				}
			}
			// No user has been linked to this token yet.
			if (!is_numeric ($user_id))
			{
				// User functions
				if (!function_exists ('user_add'))
				{
					require ($phpbb_root_path . 'includes/functions_user.' . $phpEx);
				}

				// Will validation be required ('1' means always).
				$do_validation = $config ['oa_social_login_validate'] === '1' ? true : false;

				// Username is mandatory.
				if (!isset ($user_data ['user_login']) || strlen (trim ($user_data ['user_login'])) == 0)
				{
					$user_data ['user_login'] = $user_data ['identity_provider'] . 'User';
				}
				// Username must be unique.
				if ($this->get_user_id_by_username ($user_data ['user_login']) !== false)
				{
					$i = 1;
					$user_login_tmp = $user_data ['user_login'] . ($i);
					while ( $this->get_user_id_by_username ($user_login_tmp) !== false )
					{
						$user_login_tmp = $user_data ['user_login'] . ($i ++);
					}
					$user_data ['user_login'] = $user_login_tmp;
					if (!$do_validation && $config ['oa_social_login_validate'] !== '0')
					{
						$do_validation = true;
					}
				}

				if (!$do_validation && $config ['oa_social_login_validate'] !== '0' && (empty ($user_data ['user_email']) || (!empty ($user_data ['user_email']) && $this->get_user_id_by_email ($user_data ['user_email']) !== false && $config ['oa_social_login_disable_linking'] === '1')))
				{
					$do_validation = true;
				}
				// Email must be unique
				if (empty ($user_data ['user_email']) || $this->get_user_id_by_email ($user_data ['user_email']) !== false)
				{
					// Create a random email
					$user_data ['user_email'] = $this->generate_random_email ();

					// This is a random email (the flag is used further down)
					$user_random_email = true;
				}
				else
				{
					// This is not a random email.
					$user_random_email = false;
				}
				// Return to controller
				if ($do_validation === true)
				{
					$user_data ['user_email'] = $user_random_email ? '' : $user_data ['user_email'];
					return $user_data;
				}
				list ($error_message, $user_id) = $this->social_login_user_add ($user_random_email, $user_data);
			}
		}
		$this->social_login_redirect ($error_message, $user_id, $user_data);
	}

	/**
	 * Resume social login callback once login/email are validated.
	 */
	public function social_login_resume_handle_callback ($user_data)
	{
		list ($error_message, $user_id) = $this->social_login_user_add (false, $user_data);
		$this->social_login_redirect ($error_message, $user_id, $user_data);
	}

	/**
	 * Continue social login callback once credentials validated.
	 */
	protected function social_login_user_add ($user_random_email, $user_data)
	{
		global $db, $auth, $user, $config, $template, $phpbb_root_path, $phpbb_log, $phpbb_admin_path, $phpEx, $phpbb_dispatcher, $phpbb_container;

		$error_message = null;
		$user_id = null;

		// User functions
		if (!function_exists ('user_add'))
		{
			require ($phpbb_root_path . 'includes/functions_user.' . $phpEx);
		}
		// Detect the default language of the forum.
		if (!empty ($config ['default_lang']))
		{
			$user_row ['user_lang'] = trim ($config ['default_lang']);
		}
		// Use english
		else
		{
			$user_row ['user_lang'] = 'en';
		}

		// Default group_id is required.
		$group_id = $this->get_default_group_id ();

		// No group has been set.
		if (!is_numeric ($group_id))
		{
			trigger_error ('NO_GROUP');
		}

		// Activation Required.
		if (!$user_random_email && ($config ['require_activation'] == USER_ACTIVATION_SELF || $config ['require_activation'] == USER_ACTIVATION_ADMIN) && $config ['email_enable'])
		{
			$user_type = USER_INACTIVE;
			$user_actkey = gen_rand_string (mt_rand (6, 10));

			$user_inactive_reason = INACTIVE_REGISTER;
			$user_inactive_time = time ();
		}
		// No Activation Required.
		else
		{
			$user_type = USER_NORMAL;
			$user_actkey = '';

			$user_inactive_reason = 0;
			$user_inactive_time = 0;
		}

		// Generate a random password.
		$new_password = $this->generate_hash ($config ['min_pass_chars'] + rand (3, 5));

		// Instantiate passwords manager.
		$passwords_manager = $phpbb_container->get('passwords.manager');

		// Setup user details.
		$user_row = array(
			'group_id' => $group_id,
			'user_type' => $user_type,
			'user_actkey' => $user_actkey,
			'user_password' => $passwords_manager->hash($new_password),
			'user_ip' => $user->ip,
			'user_inactive_reason' => $user_inactive_reason,
			'user_inactive_time' => $user_inactive_time,
			'user_lastvisit' => time (),
			'user_lang' => $user_row ['user_lang'],
			'username' => $user_data ['user_login'],
			'user_email' => $user_data ['user_email']
		);

		// Adds the user to the Newly registered users group.
		if ($config ['new_member_post_limit'])
		{
			$user_row ['user_new'] = 1;
		}

		/**
		* Use this event to modify the values to be inserted when a user is added
		* Inspired by the core event: core.user_add_modify_data (which does not get our profile data)
		*
		* @event oneall_sociallogin.user_add_modify_data
		* @var array	user_row		Array of user details submited to user_add
		* @var array	cp_data			Array of Custom profile fields submited to user_add
		* @var array	social_profile	Array of social network profile, as read only
		*/
		$cp_data = array();
		$social_profile = $user_data;  // Copy of profile user_data, updates ignore, to simulate read-only.
		$evt_vars = array('user_row', 'cp_data', 'social_profile');
		extract ($phpbb_dispatcher->trigger_event ('oneall_sociallogin.user_add_modify_data', compact ($evt_vars)));

		// Register user, with optional custom fields.
		$user_id_tmp = user_add ($user_row, $cp_data);

		// This should not happen, because the required variables are listed above.
		if ($user_id_tmp === false)
		{
			trigger_error ('NO_USER', E_USER_ERROR);
		}
		// User added successfully.
		else
		{
			// Add user to special group of OneAll registered users OA_SOCIAL_LOGIN_REGISTER.
			$sql = 'SELECT group_id FROM '. GROUPS_TABLE ."
				WHERE group_name = 'OA_SOCIAL_LOGIN_REGISTER' AND group_type = ". GROUP_SPECIAL;
			$result = $db->sql_query ($sql);
			$oa_group_id = (int) $db->sql_fetchfield ('group_id');
			$db->sql_freeresult ($result);
			$error = group_user_add ($oa_group_id, $user_id_tmp);
			if ($error !== false)
			{
				trigger_error ($error, E_USER_ERROR);
			}
			// Link the user to this social network.
			if ($this->link_tokens_to_user_id ($user_id_tmp, $user_data ['user_token'], $user_data ['identity_token'], $user_data ['identity_provider']) !== false)
			{
				// Process this user.
				$user_id = $user_id_tmp;

				// Add the avatar
				if ($config ['oa_social_login_avatars_enable'] == 0)
				{
					$this->upload_user_avatar ($user_id, $user_data);
				}

				// Send Email (Only if it is not a random email address).
				if ($config ['email_enable'] && !$user_random_email)
				{
					// Do we have to include messenger?
					require ($phpbb_root_path . "includes/functions_messenger." . $phpEx);

					// Activation Type.
					if ($config ['require_activation'] == USER_ACTIVATION_SELF)
					{
						$error_message = $user->lang ['OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_OTHER'];
						$email_template = 'user_welcome_inactive';
					}
					else if ($config ['require_activation'] == USER_ACTIVATION_ADMIN)
					{
						$error_message = $user->lang ['OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_ADMIN'];
						$email_template = 'admin_welcome_inactive';
					}
					else
					{
						$email_template = 'user_welcome';
					}

					// Url for activation.
					$server_url = generate_board_url ();

					// Send email to new user
					$messenger = new \messenger (false);
					$messenger->template ($email_template, $user_row ['user_lang']);
					$messenger->to ($user_row ['user_email'], $user_row ['username']);
					$messenger->anti_abuse_headers ($config, $user);
					$messenger->assign_vars (array(
						'WELCOME_MSG' => htmlspecialchars_decode (sprintf ($user->lang ['WELCOME_SUBJECT'], $config ['sitename'])),
						'USERNAME' => htmlspecialchars_decode ($user_row ['username']),
						'PASSWORD' => htmlspecialchars_decode ($new_password),
						'U_ACTIVATE' => $server_url . '/ucp.' . $phpEx . '?mode=activate&u=' . $user_id . '&k=' . $user_actkey
					));
					$messenger->send (NOTIFY_EMAIL);
					$messenger->save_queue ();

					// Send email to administrators.
					if ($config ['require_activation'] == USER_ACTIVATION_ADMIN)
					{
						// Read founders.
						$sql = 'SELECT user_id, username, user_email, user_lang, user_jabber, user_notify_type FROM ' . USERS_TABLE . ' WHERE user_type = ' . USER_FOUNDER;

						// Grab an array of user_id's with a_user permissions ... these users can activate a user.
						$acl_admins = $auth->acl_get_list (false, 'a_user', false);
						$acl_admins = (!empty ($acl_admins [0] ['a_user'])) ? $acl_admins [0] ['a_user'] : array();

						// Include admins
						if (is_array ($acl_admins) && count ($acl_admins) > 0)
						{
							$sql .= ' OR ' . $db->sql_in_set ('user_id', $acl_admins);
						}

						// Retrieve founders/admins
						$query = $db->sql_query ($sql);

						// Send emails to them
						while ( $row = $db->sql_fetchrow ($query) )
						{
							$messenger->template ('admin_activate', $row ['user_lang']);
							$messenger->set_addresses ($row);

							$messenger->assign_vars (array(
								'USERNAME' => htmlspecialchars_decode ($user_row ['username']),
								'U_USER_DETAILS' => $server_url . '/memberlist.' . $phpEx . '?mode=viewprofile&u=' . $user_id,
								'U_ACTIVATE' => $server_url . '/ucp.' . $phpEx . '?mode=activate&u=' . $user_id . '&k=' . $user_actkey
							));

							$messenger->send ($row ['user_notify_type']);
						}
						$db->sql_freeresult ($query);
					}
				}
			}
			return array(
				$error_message,
				$user_id
			);
		}
	}

	/**
	 * Complete callback once credentials validated.
	 */
	protected function social_login_redirect ($error_message, $user_id, $user_data)
	{
		global $user, $phpbb_root_path, $phpEx, $config, $request;

		// Display an error message
		if (isset ($error_message))
		{
			$error_message = $error_message . '<br /><br />' . sprintf ($user->lang ['RETURN_INDEX'], '<a href="' . append_sid ("{$phpbb_root_path}index.$phpEx") . '">', '</a>');
			trigger_error ($error_message);
		}
		// Process
		else
		{
			if (is_numeric ($user_id))
			{
				// Update statistics
				$this->count_login_identity_token ($user_data ['identity_token']);

				// Log the user in
				$this->do_login ($user_id);

				// Redirect to a custom page
				if (!empty ($config ['oa_social_login_redirect']))
				{
					self::http_redirect (append_sid ($config ['oa_social_login_redirect']));
				}

				// Do not stay on the login/registration page
				if (in_array ($request->variable ('mode', ''), array('login', 'register')))
				{
					self::http_redirect (append_sid ($phpbb_root_path . 'index.' . $phpEx));
				}

				// If the user validated his credentials, then the original page is in session data:
				if (isset ($user_data ['redirect']))
				{
					self::http_redirect (append_sid ($user_data ['redirect']));
				}

				// Default: Reload the page
				self::http_redirect (append_sid (self::get_current_url ()));
			}
		}
	}


	// Redirection
	public static function http_redirect ($url)
	{
		redirect ($url, false, true);
	}

	/**
	 * Check if the current connection is being made over https
	 */
	private static function is_https_on ()
	{
		global $request;

		if ($request->server ('SERVER_PORT') == 443)
		{
			return true;
		}

		if ($request->server ('HTTP_X_FORWARDED_PROTO') == 'https')
		{
			return true;
		}

		if (in_array (strtolower (trim ($request->server ('HTTPS'))), array(
			'on',
			'1'
		)))
		{
			return true;
		}

		return false;
	}

	/**
	 * Returns the current url
	 */
	function get_current_url ($remove_vars = array ('oa_social_login_login_token', 'sid'))
	{
		global $request;

		// Extract Uri
		if (strlen (trim ($request->server ('REQUEST_URI'))) > 0)
		{
			$request_uri = trim ($request->server ('REQUEST_URI'));
		}
		else
		{
			$request_uri = trim ($request->server ('PHP_SELF'));
		}

		// Decod
		$request_uri = htmlspecialchars_decode ($request_uri);

		// Extract Protocol
		if (self::is_https_on ())
		{
			$request_protocol = 'https';
		}
		else
		{
			$request_protocol = 'http';
		}

		// Extract Host
		if (strlen (trim ($request->server ('HTTP_X_FORWARDED_HOST'))) > 0)
		{
			$request_host = trim ($request->server ('HTTP_X_FORWARDED_HOST'));
		}
		elseif (strlen (trim ($request->server ('HTTP_HOST'))) > 0)
		{
			$request_host = trim ($request->server ('HTTP_HOST'));
		}
		else
		{
			$request_host = trim ($request->server ('SERVER_NAME'));
		}

		// Port of this request
		$request_port = '';

		// We are using a proxy
		if (strlen (trim ($request->server ('HTTP_X_FORWARDED_PORT'))) > 0)
		{
			// SERVER_PORT is usually wrong on proxies, don't use it!
			$request_port = intval ($request->server ('HTTP_X_FORWARDED_PORT'));
		}
		// Does not seem like a proxy
		else if (strlen (trim ($request->server ('SERVER_PORT'))) > 0)
		{
			$request_port = intval ($request->server ('SERVER_PORT'));
		}

		// Remove standard ports
		$request_port = (!in_array ($request_port, array(80, 443)) ? $request_port : '');

		// Build url
		$current_url = $request_protocol . '://' . $request_host . (!empty ($request_port) ? (':' . $request_port) : '') . $request_uri;

		// Remove query arguments.
		if (is_array ($remove_vars) && count ($remove_vars) > 0)
		{
			// Break up url
			list ($url_part, $query_part) = array_pad (explode ('?', $current_url), 2, '');
			parse_str ($query_part, $query_vars);

			// Remove argument.
			if (is_array ($query_vars))
			{
				foreach ($remove_vars as $var)
				{
					if (isset ($query_vars [$var]))
					{
						unset ($query_vars [$var]);
					}
				}

				// Build new url
				$current_url = $url_part . ((is_array ($query_vars) and count ($query_vars) > 0) ? ('?' . http_build_query ($query_vars)) : '');
			}
		}

		// Done
		return $current_url;
	}

	/**
	 * Upload a new avatar
	 */
	public function upload_user_avatar ($user_id, $user_data)
	{
		global $db, $phpbb_root_path, $phpEx, $user, $config;

		// Make sure avatars are allowed
		if ($config ['allow_avatar_upload'])
		{
			// Check format
			if (is_array ($user_data) && (!empty ($user_data ['user_thumbnail']) || !empty ($user_data ['user_picture'])))
			{
				// Use this avatar
				$user_avatar_url = (!empty ($user_data ['user_picture']) ? $user_data ['user_picture'] : $user_data ['user_thumbnail']);

				// Which connection handler do we have to use?
				$api_connection_handler = ((!empty ($config ['oa_social_login_api_connection_handler']) && $config ['oa_social_login_api_connection_handler'] == 'fsockopen') ? 'fsockopen' : 'curl');

				// Retrieve file data
				$api_result = self::do_api_request ($api_connection_handler, $user_avatar_url);

				// Success?
				if (is_object ($api_result) && property_exists ($api_result, 'http_code') && $api_result->http_code == 200)
				{
					// File data
					$file_data = $api_result->http_data;

					// Temporary filename
					$file_tmp_path = (@ini_get ('open_basedir') || @ini_get ('safe_mode') || strtolower (@ini_get ('safe_mode')) == 'on') ? $phpbb_root_path . 'cache' : false;
					$file_tmp_name = tempnam ($file_tmp_path, unique_id () . '-');

					// Save file
					if (($fp = @fopen ($file_tmp_name, 'wb')) !== false)
					{
						// Write file
						$avatar_size = fwrite ($fp, $file_data);
						fclose ($fp);

						// Allowed file extensions
						$file_exts = array();
						$file_exts [IMAGETYPE_GIF] = 'gif';
						$file_exts [IMAGETYPE_JPEG] = 'jpg';
						$file_exts [IMAGETYPE_PNG] = 'png';

						// Get image data
						list ($width, $height, $type, $attr) = @getimagesize ($file_tmp_name);

						// Check image size and type
						if ($width > $config ['avatar_min_width'] && $height > $config ['avatar_min_height'] && isset ($file_exts [$type]))
						{
							// File extension
							$file_ext = $file_exts [$type];

							// Check if we can resize the image if needd
							if (function_exists ('imagecreatetruecolor') && function_exists ('imagecopyresampled'))
							{
								$max_height = $config ['avatar_max_height'];
								$max_width = $config ['avatar_max_width'];

								// Check if we need to resize
								if ($width > $max_width || $height > $max_height)
								{
									// Keep original size
									$orig_height = $height;
									$orig_width = $width;

									// Taller
									if ($height > $max_height)
									{
										$width = ($max_height / $height) * $width;
										$height = $max_height;
									}

									// Wider
									if ($width > $max_width)
									{
										$height = ($max_width / $width) * $height;
										$width = $max_width;
									}

									// Destination
									$destination = imagecreatetruecolor ($width, $height);

									// Resize
									switch ($file_ext)
									{
										case 'gif' :
											$source = imagecreatefromgif ($file_tmp_name);
											imagecopyresampled ($destination, $source, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
											imagegif ($destination, $file_tmp_name);
										break;

										case 'png' :
											$source = imagecreatefrompng ($file_tmp_name);
											imagecopyresampled ($destination, $source, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
											imagepng ($destination, $file_tmp_name);
										break;

										case 'jpg' :
											$source = imagecreatefromjpeg ($file_tmp_name);
											imagecopyresampled ($destination, $source, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
											imagejpeg ($destination, $file_tmp_name);
										break;
									}
								}
							}

							// Final path
							$avatar_name = $config ['avatar_salt'] . '_' . $user_id . '.' . $file_exts [$type];
							$avatar_full_name = $phpbb_root_path . $config ['avatar_path'] . '/' . $avatar_name;

							// Move file
							if (@copy ($file_tmp_name, $avatar_full_name))
							{
								// Remove temporary file
								@unlink ($file_tmp_name);

								$sql_arr = array();
								$sql_arr ['user_avatar'] = ($user_id . '_' . time () . '.' . $file_ext);
								$sql_arr ['user_avatar_type'] = AVATAR_UPLOAD;
								$sql_arr ['user_avatar_width'] = $width;
								$sql_arr ['user_avatar_height'] = $height;

								// Update user
								$sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array ('UPDATE', $sql_arr) . ' WHERE user_id = ' . $user_id;
								$db->sql_query ($sql);

								// Done
								return true;
							}
						}

						// Error
						@unlink ($file_tmp_name);
						return false;
					}
				}
			}
		}

		// Error
		return false;
	}
}
