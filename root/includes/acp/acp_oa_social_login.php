<?php
/**
 * @package   	OneAll Social Login Mod
 * @copyright 	Copyright 2014 http://www.oneall.com - All rights reserved.
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
if (!defined('IN_PHPBB'))
{
	exit;
}

// Display Administration Menu
class acp_oa_social_login
{
	var $u_action;

	/**
	 * Main Function
	 */
	public function main($id, $mode)
	{
		//Tasks
		switch (request_var('task', ''))
		{
			case 'verify_api_settings':
				return $this->admin_ajax_verify_api_settings();

			case 'autodetect_api_connection':
				return $this->admin_ajax_autodetect_api_connection();

			default:
				return $this->admin_main();
		}
	}


	/**
	 * Admin Main Page
	 */
	public function admin_main()
	{
		global $db, $user, $auth, $template, $config, $phpbb_root_path, $phpbb_admin_path, $phpEx, $table_prefix;

		//Add language file.
		$user->add_lang('info_acp_oa_social_login');

		// Include the OneAll toolbox.
		if (!class_exists('oa_social_login'))
		{
			include($phpbb_root_path . 'includes/functions_oa_social_login.' . $phpEx);
		}

		// Set up the page
		$this->tpl_name = 'acp_oa_social_login';
		$this->page_title = $user->lang['OASL_SETTINGS'];

		//API Connection
		$oa_social_login_api_connection_handler = ((isset($config['oa_social_login_api_connection_handler']) && $config['oa_social_login_api_connection_handler'] == 'fsockopen') ? 'fsockopen' : 'curl');
		$oa_social_login_api_connection_port = ((isset($config['oa_social_login_api_connection_port']) && $config['oa_social_login_api_connection_port'] == 80) ? 80 : 443);
		$oa_social_login_api_subdomain = (isset($config['oa_social_login_api_subdomain']) ? $config['oa_social_login_api_subdomain'] : '');
		$oa_social_login_api_key = (isset($config['oa_social_login_api_key']) ? $config['oa_social_login_api_key'] : '');
		$oa_social_login_api_secret = (isset($config['oa_social_login_api_secret']) ? $config['oa_social_login_api_secret'] : '');
		$oa_social_login_providers = (isset($config['oa_social_login_providers']) ? explode(",", $config['oa_social_login_providers']) : array());
		$oa_social_login_disable = ((isset($config['oa_social_login_disable']) && $config['oa_social_login_disable'] == '1') ? '1' : '0');
		$oa_social_login_disable_linking = ((isset($config['oa_social_login_disable_linking']) && $config['oa_social_login_disable_linking'] == '1') ? '1' : '0');
		$oa_social_login_avatars_enable = ((isset($config['oa_social_login_avatars_enable']) && $config['oa_social_login_avatars_enable'] == '1') ? '1' : '0');
		$oa_social_login_redirect = (isset($config['oa_social_login_redirect']) ? $config['oa_social_login_redirect'] : '');

		//Triggers a form message
		$oa_social_login_settings_saved = false;

		//Security Check
		add_form_key('acp_oa_social_login');

		//Form submitted
		if (!empty($_POST['submit']))
		{
			//Triggers a form message
			$oa_social_login_settings_saved = true;

			//Security Check
			if (!check_form_key('acp_oa_social_login'))
			{
				trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action), E_USER_WARNING);
			}

			//Gather API Connection details.
			$oa_social_login_api_connection_handler = (request_var('oa_social_login_api_connection_handler', 'curl') == 'fsockopen' ? 'fsockopen' : 'curl');
			$oa_social_login_api_connection_port = (request_var('oa_social_login_api_connection_port', 443) == 80 ? 80 : 443);
			$oa_social_login_api_subdomain = request_var('oa_social_login_api_subdomain', '');
			$oa_social_login_api_key = request_var('oa_social_login_api_key', '');
			$oa_social_login_api_secret = request_var('oa_social_login_api_secret', '');

			//Check for full subdomain.
			if (preg_match("/([a-z0-9\-]+)\.api\.oneall\.com/i", $oa_social_login_api_subdomain, $matches))
			{
				$oa_social_login_api_subdomain = $matches[1];
			}

			//Social Networks
			$oa_social_login_providers = array();
			foreach (oa_social_login::get_providers() AS $provider_key => $provider_data)
			{
				if (request_var('oa_social_login_provider_' . $provider_key, 0) == 1)
				{
					$oa_social_login_providers[] = $provider_key;
				}
			}

			//Other options.
			$oa_social_login_disable = ((request_var('oa_social_login_disable', 0) == 1) ? 1 : 0);
			$oa_social_login_disable_linking = ((request_var('oa_social_login_disable_linking', 0) == 1) ? 1 : 0);
			$oa_social_login_avatars_enable = ((request_var('oa_social_login_avatars_enable', 0) == 1) ? 1 : 0);
			$oa_social_login_redirect = request_var('oa_social_login_redirect', '');


			//Save configuration.
			set_config('oa_social_login_disable', $oa_social_login_disable);
			set_config('oa_social_login_disable_linking', $oa_social_login_disable_linking);
			set_config('oa_social_login_avatars_enable', $oa_social_login_avatars_enable);
			set_config('oa_social_login_redirect', $oa_social_login_redirect);
			set_config('oa_social_login_api_subdomain', $oa_social_login_api_subdomain);
			set_config('oa_social_login_api_key', $oa_social_login_api_key);
			set_config('oa_social_login_api_secret', $oa_social_login_api_secret);
			set_config('oa_social_login_providers', implode(",", $oa_social_login_providers));
			set_config('oa_social_login_api_connection_handler', $oa_social_login_api_connection_handler);
			set_config('oa_social_login_api_connection_port', $oa_social_login_api_connection_port);
		}


		//Setup Social Network Vars
		foreach (oa_social_login::get_providers() AS $key => $data)
		{
			$template->assign_block_vars('provider', array(
				'KEY' => $key,
				'NAME' => $data['name'],
				'ENABLE' => in_array($key, $oa_social_login_providers)
			));
		}


		//Setup Vars
		$template->assign_vars(
			array(
				'U_ACTION' => $this->u_action,
				'CURRENT_SID' => $user->data['session_id'],
				'OA_SOCIAL_LOGIN_SETTINGS_SAVED' => $oa_social_login_settings_saved,
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
			));

		//Done
		return true;
	}


	/**
	 * AutoDetect API Settings - Ajax Call
	 */
	public function admin_ajax_autodetect_api_connection()
	{
		global $phpbb_root_path, $phpEx, $user;

		//Add the language file.
		$user->add_lang('info_acp_oa_social_login');

		//Include the OneAll toolbox.
		if (!class_exists('oa_social_login'))
		{
			include($phpbb_root_path . 'includes/functions_oa_social_login.' . $phpEx);
		}

		//Check CURL HTTPS - Port 443.
		if (oa_social_login::check_curl(true) === true)
		{
			$status_message = 'success|curl_443|' . sprintf($user->lang['OASL_API_DETECT_CURL'], 443);
		}
		//Check CURL HTTP - Port 80.
		elseif (oa_social_login::check_curl(false) === true)
		{
			$status_message = 'success|curl_80|' . sprintf($user->lang['OASL_API_DETECT_CURL'], 80);
		}
		//Check FSOCKOPEN HTTPS - Port 443.
		elseif (oa_social_login::check_fsockopen(true) == true)
		{
			$status_message = 'success|fsockopen_443|' . sprintf($user->lang['OASL_API_DETECT_FSOCKOPEN'], 443);
		}
		//Check FSOCKOPEN HTTP - Port 80.
		elseif (oa_social_login::check_fsockopen(false) == true)
		{
			$status_message = 'success|fsockopen_80|' . sprintf($user->lang['OASL_API_DETECT_FSOCKOPEN'], 443);
		}
		// No working handler found.
		else
		{
			$status_message = 'error|none|' . $user->lang['OASL_API_DETECT_NONE'];
		}

		//Call the garbage collector.
		garbage_collection();

		//Output for AJAX.
		die($status_message);
	}


	/**
	 * Check API Settings - Ajax Call
	 */
	public function admin_ajax_verify_api_settings()
	{
		global $phpbb_root_path, $phpEx, $user;

		//Add language file.
		$user->add_lang('info_acp_oa_social_login');

		//Include the OneAll toolbox.
		if (!class_exists('oa_social_login'))
		{
			include($phpbb_root_path . 'includes/functions_oa_social_login.' . $phpEx);
		}

		//Read arguments.
		$api_subdomain = trim(strtolower(request_var('api_subdomain', '')));
		$api_key = trim(request_var('api_key', ''));
		$api_secret = trim(request_var('api_secret', ''));
		$api_connection_port = request_var('api_connection_port', '');
		$api_connection_handler = request_var('api_connection_handler', '');

		//Init status message.
		$status_message = null;

		//Check if all fields have been filled out.
		if (strlen($api_subdomain) == 0 || strlen($api_key) == 0 || strlen($api_secret) == 0)
		{
			$status_message = 'error_|' . $user->lang['OASL_API_CREDENTIALS_FILL_OUT'];
		}
		else
		{
			//Check the handler
			$api_connection_handler = ($api_connection_handler != 'fsockopen' ? 'curl' : 'fsockopen');
			$api_connection_use_https = ($api_connection_port != '80' ? true : false);

			//FSOCKOPEN
			if ($api_connection_handler == 'fsockopen')
			{
				if (!oa_social_login::check_fsockopen($api_connection_use_https))
				{
					$status_message = 'error|' . $user->lang['OASL_API_CREDENTIALS_USE_AUTO'];
				}
			}
			//CURL
			else
			{
				if (!oa_social_login::check_curl($api_connection_use_https))
				{
					$status_message = 'error|' . $user->lang['OASL_API_CREDENTIALS_USE_AUTO'];
				}
			}

			//No errors until now.
			if (empty($status_message))
			{
				//The full domain has been entered.
				if (preg_match("/([a-z0-9\-]+)\.api\.oneall\.com/i", $api_subdomain, $matches))
				{
					$api_subdomain = $matches[1];
				}

				//Check format of the subdomain.
				if (!preg_match("/^[a-z0-9\-]+$/i", $api_subdomain))
				{
					$status_message = 'error|' . $user->lang['OASL_API_CREDENTIALS_SUBDOMAIN_WRONG'];
				}
				else
				{
					// Construct full API Domain.
					$api_domain = $api_subdomain . '.api.oneall.com';
					$api_resource_url = ($api_connection_use_https ? 'https' : 'http') . '://' . $api_domain . '/tools/ping.json';

					// Try to establish a connection.
					$result = oa_social_login::do_api_request($api_connection_handler, $api_resource_url, array(
						'api_key' => $api_key,
						'api_secret' => $api_secret
					));

					// Parse result.
					if (is_object($result) && property_exists($result, 'http_code') && property_exists($result, 'http_data'))
					{
						switch ($result->http_code)
						{
							// Connection successfull.
							case 200:
								$status_message = 'success|' . $user->lang['OASL_API_CREDENTIALS_OK'];
								break;

							// Authentication Error.
							case 401:
								$status_message = 'error|' . $user->lang['OASL_API_CREDENTIALS_KEYS_WRONG'];
								break;

							// Wrong Subdomain.
							case 404:
								$status_message = 'error|' . $user->lang['OASL_API_CREDENTIALS_SUBDOMAIN_WRONG'];
								break;

							// Other error.
							default:
								$status_message = 'error|' . $user->lang['OASL_API_CREDENTIALS_CHECK_COM'];
								break;
						}
					}
					else
					{
						$status_message = 'error|' . $user->lang['OASL_API_CREDENTIALS_CHECK_COM'];
					}
				}
			}
		}

		// Garbage Collector.
		garbage_collection();

		// Output for Ajax.
		die($status_message);
	}
}
