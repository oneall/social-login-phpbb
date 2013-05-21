<?php
/**
 * @package   	OneAll Social Login Mod
 * @copyright 	Copyright 2012 http://www.oneall.com - All rights reserved.
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
if (!defined ('IN_PHPBB'))
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
	public function main ($id, $mode)
	{
		//Tasks
		switch (request_var ('task', ''))
		{
			case 'verify_api_settings':
				return $this->admin_ajax_verify_api_settings ();
				break;

			case 'autodetect_api_connection':
				return $this->admin_ajax_autodetect_api_connection ();
				break;

			default:
				return $this->admin_main ();
				break;
		}
	}

	/**
	 * Admin Main Page
	 */
	public function admin_main ()
	{
		global $db, $user, $auth, $template, $config, $phpbb_root_path, $phpbb_admin_path, $phpEx, $table_prefix;

		// Set up the page
		$this->tpl_name = 'acp_oa_social_login';
		$this->page_title = 'Social Login Settings';

		//Required Class
		include_once ($phpbb_root_path . 'includes/functions_oa_social_login.' . $phpEx);

		//API Connection
		$oa_social_login_api_connection_handler = ((isset ($config ['oa_social_login_api_connection_handler']) && $config ['oa_social_login_api_connection_handler'] == 'fsockopen') ? 'fsockopen' : 'curl');
		$oa_social_login_api_connection_port = ((isset ($config ['oa_social_login_api_connection_port']) && $config ['oa_social_login_api_connection_port'] == '80') ? '80' : '443');
		$oa_social_login_api_subdomain = (isset ($config ['oa_social_login_api_subdomain']) ? $config ['oa_social_login_api_subdomain'] : '');
		$oa_social_login_api_key = (isset ($config ['oa_social_login_api_key']) ? $config ['oa_social_login_api_key'] : '');
		$oa_social_login_api_secret = (isset ($config ['oa_social_login_api_secret']) ? $config ['oa_social_login_api_secret'] : '');
		$oa_social_login_providers = (isset ($config ['oa_social_login_providers']) ? explode (",", $config ['oa_social_login_providers']) : array ());
		$oa_social_login_disable = ((isset ($config ['oa_social_login_disable']) && $config ['oa_social_login_disable'] == '1') ? '1' : '0');
		$oa_social_login_disable_linking = ((isset ($config ['oa_social_login_disable_linking']) && $config ['oa_social_login_disable_linking'] == '1') ? '1' : '0');
		$oa_social_login_redirect = (isset ($config ['oa_social_login_redirect']) ? $config ['oa_social_login_redirect'] : '');

		//Triggers a form message
		$oa_social_login_settings_saved = false;

		//Security Check
		add_form_key ('acp_oa_social_login');

		//Form submitted
		if (!empty ($_POST ['submit']))
		{
			//Triggers a form message
			$oa_social_login_settings_saved = true;

			//Security Check
			if (!check_form_key ('acp_oa_social_login'))
			{
				trigger_error ($user->lang ['FORM_INVALID'] . adm_back_link ($this->u_action), E_USER_WARNING);
			}

			//API Connection
			$oa_social_login_api_connection_handler = (request_var ('oa_social_login_api_connection_handler', 'curl') == 'fsockopen' ? 'fsockopen' : 'curl');
			$oa_social_login_api_connection_port = (request_var ('oa_social_login_api_connection_port', '443') == '80' ? '80' : '443');
			$oa_social_login_api_subdomain = request_var ('oa_social_login_api_subdomain', '');
			$oa_social_login_api_key = request_var ('oa_social_login_api_key', '');
			$oa_social_login_api_secret = request_var ('oa_social_login_api_secret', '');

			//Check for full subdomain
			if (preg_match ("/([a-z0-9\-]+)\.api\.oneall\.com/i", $oa_social_login_api_subdomain, $matches))
			{
				$oa_social_login_api_subdomain = $matches [1];
			}

			//Social Networks
			$oa_social_login_providers = array ();
			foreach (oa_social_login::get_providers () AS $provider_key => $provider_data)
			{
				if (request_var ('oa_social_login_provider_' . $provider_key, 0) == 1)
				{
					$oa_social_login_providers [] = $provider_key;
				}
			}

			//Options
			$oa_social_login_disable = ((request_var ('oa_social_login_disable', 0) == 1) ? 1 : 0);
			$oa_social_login_disable_linking = ((request_var ('oa_social_login_disable_linking', 0) == 1) ? 1 : 0);
			$oa_social_login_redirect = request_var ('oa_social_login_redirect', '');


			//Save Config
			set_config ('oa_social_login_disable', $oa_social_login_disable);
			set_config ('oa_social_login_disable_linking', $oa_social_login_disable_linking);
			set_config ('oa_social_login_redirect', $oa_social_login_redirect);
			set_config ('oa_social_login_api_subdomain', $oa_social_login_api_subdomain);
			set_config ('oa_social_login_api_key', $oa_social_login_api_key);
			set_config ('oa_social_login_api_secret', $oa_social_login_api_secret);
			set_config ('oa_social_login_providers', implode (",", $oa_social_login_providers));
			set_config ('oa_social_login_api_connection_handler', $oa_social_login_api_connection_handler);
			set_config ('oa_social_login_api_connection_port', $oa_social_login_api_connection_port);
		}


		//Setup Social Network Vars
		foreach (oa_social_login::get_providers () AS $key => $data)
		{
			$template->assign_block_vars ('provider', array (
				'KEY' => $key,
				'NAME' => $data ['name'],
				'ENABLE' => in_array ($key, $oa_social_login_providers)
			));
		}

		//Setup Vars
		$template->assign_vars (array (
			'U_ACTION' => $this->u_action,
			'CURRENT_SID' => $user->data ['session_id'],
			'OA_SOCIAL_LOGIN_SETTINGS_SAVED' => $oa_social_login_settings_saved,
			'OA_SOCIAL_LOGIN_DISABLE' => ($oa_social_login_disable == '1'),
			'OA_SOCIAL_LOGIN_DISABLE_LINKING' => ($oa_social_login_disable_linking == '1'),
			'OA_SOCIAL_LOGIN_REDIRECT' => $oa_social_login_redirect,
			'OA_SOCIAL_LOGIN_API_SUBDOMAIN' => $oa_social_login_api_subdomain,
			'OA_SOCIAL_LOGIN_API_KEY' => $oa_social_login_api_key,
			'OA_SOCIAL_LOGIN_API_SECRET' => $oa_social_login_api_secret,
			'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER' => $oa_social_login_api_connection_handler,
			'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER_CURL' => ($oa_social_login_api_connection_handler <> 'fsockopen'),
			'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER_FSOCKOPEN' => ($oa_social_login_api_connection_handler == 'fsockopen'),
			'OA_SOCIAL_LOGIN_API_CONNECTION_PORT' => $oa_social_login_api_connection_port,
			'OA_SOCIAL_LOGIN_API_CONNECTION_PORT_443' => ($oa_social_login_api_connection_port <> '80'),
			'OA_SOCIAL_LOGIN_API_CONNECTION_PORT_80' => ($oa_social_login_api_connection_port == '80'),
		));

		//Done
		return true;
	}


	/**
	 * AutoDetect API Settings - Ajax Call
	 */
	public function admin_ajax_autodetect_api_connection ()
	{
		global $template, $phpbb_root_path, $phpEx;

		// Set up the page
		$this->tpl_name = 'acp_oa_social_login_ajax_result';

		//Required Class
		include_once ($phpbb_root_path . 'includes/functions_oa_social_login.' . $phpEx);

		//Status
		$status_message = '';
		$status_is_error = null;

		//Check CURL HTTPS - Port 443
		if (oa_social_login::check_curl (true) === true)
		{
			$status_is_error = false;
			$status_message = 'success_autodetect_api_curl_443';
		}
		//Check CURL HTTP - Port 80
		elseif (oa_social_login::check_curl (false) === true)
		{
			$status_is_error = false;
			$status_message = 'success_autodetect_api_curl_80';
		}
		//Check FSOCKOPEN HTTPS - Port 443
		elseif (oa_social_login::check_fsockopen (true) == true)
		{
			$status_is_error = false;
			$status_message = 'success_autodetect_api_fsockopen_443';
		}
		//Check FSOCKOPEN HTTP - Port 80
		elseif (oa_social_login::check_fsockopen (false) == true)
		{
			$status_is_error = false;
			$status_message = 'success_autodetect_api_fsockopen_80';
		}
		//No working handler found
		else
		{
			$status_is_error = true;
			$status_message = 'error_autodetect_api_no_handler';
		}

		//Setup Vars
		$template->assign_vars (array (
			'OA_SOCIAL_LOGIN_STATUS_IS_ERROR' => $status_is_error,
			'OA_SOCIAL_LOGIN_STATUS_MESSAGE' => $status_message
		));

		//Done
		return true;
	}


	/**
	 * Check API Settings - Ajax Call
	 */
	public function admin_ajax_verify_api_settings ()
	{
		global $template, $phpbb_root_path, $phpEx;

		// Set up the page
		$this->tpl_name = 'acp_oa_social_login_ajax_result';

		//Required Class
		include_once ($phpbb_root_path . 'includes/functions_oa_social_login.' . $phpEx);

		//Status
		$status_message = '';
		$status_is_error = null;

		//Read arguments
		$api_subdomain = trim (strtolower (request_var ('api_subdomain', '')));
		$api_key = trim (request_var ('api_key', ''));
		$api_secret = trim (request_var ('api_secret', ''));
		$api_connection_port = request_var ('api_connection_port', '');
		$api_connection_handler = request_var ('api_connection_handler', '');

		//Check if all fields have been filled out
		if (strlen ($api_subdomain) == 0 || strlen ($api_key) == 0 || strlen ($api_secret) == 0)
		{
			$status_is_error = true;
			$status_message = 'error_not_all_fields_filled_out';
		}
		else
		{
			//Check the handler
			$api_connection_handler = ($api_connection_handler <> 'fsockopen' ? 'curl' : 'fsockopen');
			$api_connection_use_https = ($api_connection_port <> '80' ? true : false);

			//FSOCKOPEN
			if ($api_connection_handler == 'fsockopen')
			{
				if (!oa_social_login::check_fsockopen ($api_connection_use_https))
				{
					$status_is_error = true;
					$status_message = 'error_selected_handler_faulty';
				}
			}
			//CURL
			else
			{
				if (!oa_social_login::check_curl ($api_connection_use_https))
				{
					$status_is_error = true;
					$status_message = 'error_selected_handler_faulty';
				}
			}

			//No errors until now
			if ($status_is_error !== true)
			{
				//Full domain entered
				if (preg_match ("/([a-z0-9\-]+)\.api\.oneall\.com/i", $api_subdomain, $matches))
				{
					$api_subdomain = $matches [1];
				}

				//Check subdomain format
				if (!preg_match ("/^[a-z0-9\-]+$/i", $api_subdomain))
				{
					$status_is_error = true;
					$status_message = 'error_subdomain_wrong_syntax';
				}
				else
				{
					//Domain
					$api_domain = $api_subdomain . '.api.oneall.com';

					//Connection to
					$api_resource_url = ($api_connection_use_https ? 'https' : 'http') . '://' . $api_domain . '/tools/ping.json';

					//Get connection details
					$result = oa_social_login::do_api_request ($api_connection_handler, $api_resource_url, array (
						'api_key' => $api_key,
						'api_secret' => $api_secret
					), 15);

					//Parse result
					if (is_object ($result) && property_exists ($result, 'http_code') && property_exists ($result, 'http_data'))
					{
						switch ($result->http_code)
						{
							//Success
							case 200:
								$status_is_error = false;
								$status_message = 'success';
								break;

							//Authentication Error
							case 401:
								$status_is_error = true;
								$status_message = 'error_authentication_credentials_wrong';
								break;

							//Wrong Subdomain
							case 404:
								$status_is_error = true;
								$status_message = 'error_subdomain_wrong';
								break;

							//Other error
							default:
								$status_is_error = true;
								$status_message = 'error_communication';
								break;
						}
					}
					else
					{
						$status_is_error = true;
						$status_message = 'error_communication';
					}
				}
			}
		}

		//Save Status
		set_config ('oa_social_login_api_settings_ok', ($status_is_error ? '0' : '1'));

		//Setup Vars
		$template->assign_vars (array (
			'OA_SOCIAL_LOGIN_STATUS_IS_ERROR' => $status_is_error,
			'OA_SOCIAL_LOGIN_STATUS_MESSAGE' => $status_message
		));

		//Done
		return true;
	}
}