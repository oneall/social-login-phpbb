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


//Oneall Social Login
class oa_social_login
{
	const OA_SOCIAL_LOGIN_VERSION = '2.0.0';


	/**
	 * Inject variables into template
	 */
	public function setup_template ($template)
	{
		global $config, $user;

		//Enabled
		if (empty ($config ['oa_social_login_disable']))
		{
			$template->assign_var ('OA_SOCIAL_LOGIN_DISABLE', false);

			//Subdomain is required
			if (!empty ($config ['oa_social_login_api_subdomain']))
			{
				//Providers are required
				if (!empty ($config ['oa_social_login_providers']))
				{
					$oa_social_login_providers = explode (",", $config ['oa_social_login_providers']);

					//HTTP / HTTPS
					$server_protocol = (!empty ($config ['server_protocol'])) ? (str_replace ('://', '', $config ['server_protocol'])) : ($config ['cookie_secure'] ? 'https' : 'http');

					//Set Placeholders
					$template->assign_var ('OA_SOCIAL_LOGIN_VERSION', self::OA_SOCIAL_LOGIN_VERSION);
					$template->assign_var ('OA_SOCIAL_LOGIN_RAND', mt_rand (99999, 9999999));
					$template->assign_var ('OA_SOCIAL_LOGIN_PROTOCOL', $server_protocol);
					$template->assign_var ('OA_SOCIAL_LOGIN_LIBRARY', ($server_protocol . '://' . trim ($config ['oa_social_login_api_subdomain']) . '.api.oneall.com/socialize/library.js'));
					$template->assign_var ('OA_SOCIAL_LOGIN_PROVIDERS', implode ("','", $oa_social_login_providers));

					//User is logged in
					if (is_object ($user) && !empty ($user->data ['user_id']))
					{
						//This is required for Social Link
						$template->assign_var ('OA_SOCIAL_LOGIN_USER_TOKEN', $this->get_token_by_user_id ($user->data ['user_id']));
					}
				}
				else
				{
					$template->assign_var ('OA_SOCIAL_LOGIN_ERROR', 'You have to enable at least one social network');
				}
			}
			else
			{
				$template->assign_var ('OA_SOCIAL_LOGIN_ERROR', 'You have to setup your API Credentials');
			}
		}
		//Disabled
		else
		{
			$template->assign_var ('OA_SOCIAL_LOGIN_DISABLE', true);
		}

		//Done
		return $template;
	}


	/**
	 * Callback Handler
	 */
	public function handle_callback ()
	{
		//Callback Handler
		if (isset ($_POST) && !empty ($_POST ['oa_action']) && in_array ($_POST ['oa_action'], array ('social_login', 'social_link')) && !empty ($_POST ['connection_token']))
		{
			//Global Variables
			global $db, $auth, $user, $config, $user;
			global $phpbb_root_path, $phpbb_admin_path, $phpEx;

			//Language file
			$user->add_lang ('info_acp_oa_social_login');

			//Check if enabled
			if (empty ($config ['oa_social_login_disable']))
			{
				//Required settings
				if (!empty ($config ['oa_social_login_api_subdomain']) && !empty ($config ['oa_social_login_api_key']) && !empty ($config ['oa_social_login_api_secret']))
				{
					//API Settings
					$api_connection_handler = ((!empty ($config ['oa_social_login_api_connection_handler']) && $config ['oa_social_login_api_connection_handler'] == 'fsockopen') ? 'fsockopen' : 'curl');
					$api_connection_use_https = ((!empty ($config ['oa_social_login_api_connection_port']) && $settings ['oa_social_login_api_connection_port'] == '80') ? false : true);
					$api_resource_url = ($api_connection_use_https ? 'https' : 'http') . '://' . $config ['oa_social_login_api_subdomain'] . '.api.oneall.com/connections/' . $_POST ['connection_token'] . '.json';

					//API Credentials
					$args = array ();
					$args ['api_key'] = $config ['oa_social_login_api_key'];
					$args ['api_secret'] = $config ['oa_social_login_api_secret'];

					//Make Request
					$result = self::do_api_request ($api_connection_handler, $api_resource_url, $args, 15);

					//Process
					if (is_object ($result) AND property_exists ($result, 'http_code') AND $result->http_code == 200)
					{
						if (property_exists ($result, 'http_data'))
						{
							//Decode
							$social_data = json_decode ($result->http_data);

							//User Data
							if (is_object ($social_data))
							{
								$identity = $social_data->response->result->data->user->identity;
								$user_token = $social_data->response->result->data->user->user_token;

								//Identity
								$user_identity_id = $identity->id;
								$user_identity_provider = $identity->source->name;


								//Firstname
								if (!empty ($identity->name->givenName))
								{
									$user_first_name = $identity->name->givenName;
								}
								else
								{
									$user_first_name = '';
								}

								//Lastname
								if (!empty ($identity->name->familyName))
								{
									$user_last_name = $identity->name->familyName;
								}
								else
								{
									$user_last_name = '';
								}

								//Construct a full name from first and last names
								$user_constructed_name = trim ($user_first_name . ' ' . $user_last_name);

								//Fullname
								if (!empty ($identity->name->formatted))
								{
									$user_full_name = $identity->name->formatted;
								}
								elseif (!empty ($identity->name->displayName))
								{
									$user_full_name = $identity->name->displayName;
								}
								else
								{
									$user_full_name = $user_constructed_name;
								}

								//Email
								$user_email = '';
								$user_random_email = true;
								if (property_exists ($identity, 'emails') AND is_array ($identity->emails))
								{
									foreach ($identity->emails AS $email)
									{
										$user_email = $email->value;
										$user_email_is_verified = ($email->is_verified == '1');
										$user_random_email = false;
									}
								}

								//User Location
								if (!empty ($identity->currentLocation))
								{
									$user_from = $identity->currentLocation;
								}
								else
								{
									$user_from = '';
								}

								//User Interests
								if (isset ($identity->interests) AND is_array ($identity->interests))
								{
									$user_interests = array ();
									foreach ($identity->interests AS $interest)
									{
										$user_interests [] = $interest->value;
									}
									$user_interests = implode (", ", $user_interests);
								}
								else
								{
									$user_interests = '';
								}

								//User Website
								if (!empty ($identity->profileUrl))
								{
									$user_website = $identity->profileUrl;
								}
								elseif (!empty ($identity->urls [0]->value))
								{
									$user_website = $identity->urls [0]->value;
								}
								else
								{
									$user_website = '';
								}

								//Preferred Username
								if (!empty ($identity->preferredUsername))
								{
									$user_login = $identity->preferredUsername;
								}
								elseif (!empty ($identity->displayName))
								{
									$user_login = $identity->displayName;
								}
								else
								{
									$user_login = $user_full_name;
								}

								// Get user by token
								$user_id = $this->get_user_id_by_token ($user_token);

								//We already have a user for this token
								if (is_numeric ($user_id))
								{
									//Load user data
									$user_data = $this->get_user_data_by_user_id ($user_id);

									//The user account needs to be activated
									if (!empty ($user_data ['user_inactive_reason']))
									{
										if ($config ['require_activation'] == USER_ACTIVATION_ADMIN)
										{
											$error_message = $user->lang ['ACP_OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_ADMIN'];
										}
										else
										{
											$error_message = $user->lang ['ACP_OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE'];
										}
									}
								}
								//We do not have a user for this token
								else
								{
									//Account linking enabled?
									if (empty ($config ['oa_social_login_disable_linking']))
									{
										//Only if email is verified
										if (!empty ($user_email) AND $user_email_is_verified === true)
										{
											//Read existing user
											$user_id_tmp = $this->get_user_id_by_email ($user_email);

											//Existing user found
											if (is_numeric ($user_id_tmp))
											{
												$user_id = $user_id_tmp;
												$this->update_usermeta ($user_id, 'oa_social_login_user_token', $user_token);
												$this->update_usermeta ($user_id, 'oa_social_login_identity_id', $user_identity_id);
												$this->update_usermeta ($user_id, 'oa_social_login_identity_provider', $user_identity_provider);
											}
										}
									}

									//If the user_id is empty, we have no user yet
									if (empty ($user_id))
									{
										include_once($phpbb_root_path . 'includes/functions_profile_fields.' . $phpEx);
										include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);

										//Forge Username
										$user_login = str_replace (' ', '', trim ($user_login));

										//Username is mandatory
										if (!isset ($user_login) || strlen (trim ($user_login)) == 0)
										{
											$user_login = $user_identity_provider . 'User';
										}

										//Username must be unique
										if ($this->get_user_id_by_username ($user_login) !== false)
										{
											$i = 1;
											$user_login_tmp = $user_login;
											do
											{
												$user_login_tmp = $user_login . ($i++);
											}
											while ($this->get_user_id_by_username ($user_login_tmp) !== false);
											$user_login = $user_login_tmp;
										}

										//Email must be unique
										if (!isset ($user_email) || $this->get_user_id_by_email ($user_email) !== false)
										{
											//Create a random email
											$user_email = $this->generate_unique_email ();

											//Used below
											$user_random_email = true;
										}

										//Default group_id is required
										$group_id = $this->get_default_group_id ();
										if (!is_numeric ($group_id))
										{
											trigger_error ('NO_GROUP');
										}

										//Activation Required
										if (!$user_random_email AND ($config ['require_activation'] == USER_ACTIVATION_SELF || $config ['require_activation'] == USER_ACTIVATION_ADMIN) AND $config ['email_enable'])
										{
											$user_type = USER_INACTIVE;
											$user_actkey = gen_rand_string (mt_rand (6, 10));
											$user_inactive_reason = INACTIVE_REGISTER;
											$user_inactive_time = time ();
										}
										//No Activation Required
										else
										{
											$user_type = USER_NORMAL;
											$user_actkey = '';
											$user_inactive_reason = 0;
											$user_inactive_time = 0;
										}

										//User Details
										$user_row = array (
											'username' => $user_login,
											'user_password' => phpbb_hash (self::generate_hash ($config ['min_pass_chars'] + rand (3, 5))),
											'user_email' => $user_email,
											'group_id' => (int) $group_id,
											'user_type' => $user_type,
											'user_actkey' => $user_actkey,
											'user_ip' => $user->ip,
											'user_from' => $user_from,
											'user_interests' => $user_interests,
											'user_website' => $user_website,
											'user_inactive_reason' => $user_inactive_reason,
											'user_inactive_time' => $user_inactive_time,
										);

										// Register user
										$user_id_tmp = user_add ($user_row, false);

										// This should not happen, because the required variables are listed above...
										if ($user_id_tmp === false)
										{
											trigger_error ('NO_USER', E_USER_ERROR);
										}
										//User Added
										else
										{
											$user_id = $user_id_tmp;
											$this->update_usermeta ($user_id, 'oa_social_login_user_token', $user_token);
											$this->update_usermeta ($user_id, 'oa_social_login_identity_id', $user_identity_id);
											$this->update_usermeta ($user_id, 'oa_social_login_identity_provider', $user_identity_provider);

											//Send Email
											if ($config ['email_enable'] AND !$user_random_email)
											{
												//Include Messenger
												include_once($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);

												//Activation Type
												if ($config ['require_activation'] == USER_ACTIVATION_SELF)
												{

													$error_message = $user->lang ['ACP_OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE'];
													$email_template = 'user_welcome_inactive';
												}
												else if ($config ['require_activation'] == USER_ACTIVATION_ADMIN)
												{
													$error_message = $user->lang ['ACP_OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_ADMIN'];
													$email_template = 'admin_welcome_inactive';
												}
												else
												{
													$email_template = 'user_welcome';
												}

												//Current url
												$server_url = generate_board_url ();

												//Send email to new user
												$messenger = new messenger (false);
												$messenger->template ($email_template, 'en');
												$messenger->to ($user_email, $user_login);
												$messenger->anti_abuse_headers ($config, $user);
												$messenger->assign_vars (array (
													'WELCOME_MSG' => htmlspecialchars_decode (sprintf ($user->lang ['WELCOME_SUBJECT'], $config ['sitename'])),
													'USERNAME' => htmlspecialchars_decode ($user_row ['username']),
													'PASSWORD' => htmlspecialchars_decode ($user_row ['new_password']),
													'U_ACTIVATE' => $server_url . '/ucp.' . $phpEx . '?mode=activate&u=' . $user_id . '&k=' . $user_actkey
												));
												$messenger->send (NOTIFY_EMAIL);

												//Send email to administrators
												if ($config ['require_activation'] == USER_ACTIVATION_ADMIN)
												{
													// Grab an array of user_id's with a_user permissions ... these users can activate a user
													$acl_admins = $auth->acl_get_list (false, 'a_user', false);
													$acl_admins = (!empty ($acl_admins [0] ['a_user'])) ? $acl_admins [0] ['a_user'] : array ();

													// Read administrators
													$sql = 'SELECT user_id, username, user_email, user_lang, user_jabber, user_notify_type FROM ' . USERS_TABLE . ' WHERE user_type = ' . USER_FOUNDER;

													if (is_array ($acl_admins) AND count ($acl_admins) > 0)
													{
														$sql .= ' OR ' . $db->sql_in_set ('user_id', $acl_admins);
													}

													$result = $db->sql_query ($sql);
													while ($row = $db->sql_fetchrow ($result))
													{
														$messenger->template ('admin_activate', $row ['user_lang']);
														$messenger->to ($row ['user_email'], $row ['username']);
														$messenger->im ($row ['user_jabber'], $row ['username']);

														$messenger->assign_vars (array (
															'USERNAME' => htmlspecialchars_decode ($user_row ['username']),
															'U_USER_DETAILS' => $server_url . '/memberlist.' . $phpEx . '?mode=viewprofile&u=' . $user_id,
															'U_ACTIVATE' => $server_url . '/ucp.' . $phpEx . '?mode=activate&u=' . $user_id . '&k=' . $user_actkey
														));

														$messenger->send ($row ['user_notify_type']);
													}
													$db->sql_freeresult ($result);
												}
											}
										}
									}
								}

								//Display an error message
								if (isset ($error_message))
								{
									$error_message = $error_message . '<br /><br />' . sprintf ($user->lang ['RETURN_INDEX'], '<a href="' . append_sid ("{$phpbb_root_path}index.$phpEx") . '">', '</a>');
									trigger_error ($error_message);
								}
								//Process
								else
								{
									if (isset ($user_id) AND is_numeric ($user_id))
									{
										//Log the user in
										$result = $user->session_create ($user_id);

										//Redirect to a custom page
										if (!empty ($config ['oa_social_login_redirect']))
										{
											redirect ($config ['oa_social_login_redirect'], false, true);
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}


	/**
	 * Update meta-data for a given user
	 */
	private function update_usermeta ($user_id, $meta_key, $meta_value)
	{
		global $db, $table_prefix;

		//Remove existing values
		$sql = "DELETE FROM " . $table_prefix . "oa_social_login_usermeta WHERE user_id = '" . $user_id . "' AND meta_key = '" . $meta_key . "' LIMIT 1";
		$db->sql_query ($sql);

		//Add new values
		$sql = "INSERT INTO " . $table_prefix . "oa_social_login_usermeta (user_id, meta_key, meta_value)" . " VALUES ( '" . (int) $user_id . "', '" . $meta_key . "', '" . $meta_value . "' )";
		$db->sql_query ($sql);
	}


	/**
	 * Remove meta-data for a given user
	 */
	private function delete_usermeta ($user_id, $meta_key)
	{
		global $db, $table_prefix;

		//Remove values
		if (!empty ($meta_key) AND !empty ($user_id))
		{
			$sql = "DELETE FROM " . $table_prefix . "oa_social_login_usermeta WHERE user_id='" . $user_id . " AND meta_key = '" . $meta_key . "'";
			$db->sql_query ($sql);
		}

		//Done
		return true;
	}


	/**
	 * Generate a random email address
	 */
	private function generate_unique_email ()
	{
		do
		{
			$email = self::generate_hash (10) . "@example.com";
		}
		while ($this->get_user_id_by_email ($email) !== false);

		//Done
		return $email;
	}


	/**
	 * Generate a random character
	 */
	public static function generate_hash ($length)
	{
		$password = '';

		for ($i = 0; $i < $length; $i++)
		{
			do
			{
				$char = chr (mt_rand (48, 122));
			}
			while (!preg_match ('/[a-zA-Z0-9]/', $char));
			$password .= $char;
		}

		//Done
		return $password;
	}


	/**
	 * Get the user_id from an email
	 */
	private function get_user_id_by_email ($email)
	{
		global $db;
		$sql = "SELECT user_id FROM " . USERS_TABLE . " WHERE user_email  = '" . $email . "' LIMIT 1";
		$result = $db->sql_query ($sql);
		$result = $db->sql_fetchrow ($result);
		return ((is_array ($result) AND !empty ($result ['user_id'])) ? $result ['user_id'] : false);
	}


	/**
	 * Get the user_id from a username
	 */
	private function get_user_id_by_username ($user_login)
	{
		global $db;
		$sql = "SELECT user_id FROM " . USERS_TABLE . " WHERE username = '" . $user_login . "' LIMIT 1";
		$result = $db->sql_query ($sql);
		$result = $db->sql_fetchrow ($result);
		return ((is_array ($result) AND !empty ($result ['user_id'])) ? $result ['user_id'] : false);
	}


	/**
	 * Get the user_id from a user_token
	 */
	private function get_user_id_by_token ($user_token)
	{
		global $db, $table_prefix;
		$sql = "SELECT u.user_id AS user_id FROM " . $table_prefix . "oa_social_login_usermeta AS um " . "INNER JOIN " . USERS_TABLE . " AS u ON (um.user_id=u.user_id) " . "WHERE um.meta_key = 'oa_social_login_user_token' AND um.meta_value = '" . $user_token . "'";
		$result = $db->sql_query ($sql);
		$result = $db->sql_fetchrow ($result);
		return (!empty ($result ['user_id']) ? $result ['user_id'] : false);
	}


	/**
	 * Get the token from a user_id
	 */
	private function get_token_by_user_id ($user_id)
	{
		global $db, $table_prefix;
		$sql = "SELECT um.meta_value FROM " . $table_prefix . "oa_social_login_usermeta AS um WHERE um.meta_key = 'oa_social_login_user_token' AND um.user_id = '" . intval ($user_id) . "' LIMIT 1";
		$result = $db->sql_query ($sql);
		$result = $db->sql_fetchrow ($result);
		return (!empty ($result ['meta_value']) ? $result ['meta_value'] : false);
	}


	/**
	 * Get the default group_id for new users
	 */
	private function get_default_group_id ()
	{
		global $db;
		$sql = "SELECT group_id FROM " . GROUPS_TABLE . " WHERE group_name = 'REGISTERED' AND group_type = " . GROUP_SPECIAL;
		$result = $db->sql_query ($sql);
		$result = $db->sql_fetchrow ($result);
		return (!empty ($result ['group_id']) ? $result ['group_id'] : false);
	}


	/**
	 * Get the user data for a user_id
	 */
	private function get_user_data_by_user_id ($user_id)
	{
		global $db;
		$sql = "SELECT * FROM " . USERS_TABLE . " WHERE user_id = '" . $user_id . "' LIMIT 1";
		$result = $db->sql_query ($sql);
		$result = $db->sql_fetchrow ($result);
		return (is_array ($result) ? $result : array ());
	}


	/**
	 * Return the list of available providers
	 */
	public static function get_providers ()
	{
		return array (
			'facebook' => array (
				'name' => 'Facebook'
			),
			'twitter' => array (
				'name' => 'Twitter'
			),
			'google' => array (
				'name' => 'Google'
			),
			'linkedin' => array (
				'name' => 'LinkedIn'
			),
			'yahoo' => array (
				'name' => 'Yahoo'
			),
			'github' => array (
				'name' => 'Github.com'
			),
			'foursquare' => array (
				'name' => 'Foursquare'
			),
			'youtube' => array (
				'name' => 'YouTube'
			),
			'skyrock' => array (
				'name' => 'Skyrock.com'
			),
			'openid' => array (
				'name' => 'OpenID'
			),
			'wordpress' => array (
				'name' => 'Wordpress.com'
			),
			'hyves' => array (
				'name' => 'Hyves'
			),
			'paypal' => array (
				'name' => 'PayPal'
			),
			'livejournal' => array (
				'name' => 'LiveJournal'
			),
			'steam' => array (
				'name' => 'Steam Community'
			),
			'windowslive' => array (
				'name' => 'Windows Live'
			),
			'blogger' => array (
				'name' => 'Blogger'
			),
			'disqus' => array (
				'name' => 'Disqus'
			),
			'stackexchange' => array (
				'name' => 'StackExchange'
			),
			'vkontakte' => array (
				'name' => 'VKontakte (Вконтакте)'
			),
			'odnoklassniki' => array (
				'name' => 'Odnoklassniki.ru'
			),
			'mailru' => array (
				'name' => 'Mail.ru'
			)
		);
	}


	/**
	 * Send an API request by using the given handler
	 */
	public static function do_api_request ($handler, $url, $options = array (), $timeout = 15)
	{
		//FSOCKOPEN
		if ($handler == 'fsockopen')
		{
			return self::fsockopen_request ($url, $options, $timeout);
		}
		//CURL
		else
		{
			return self::curl_request ($url, $options, $timeout);
		}
	}


	/**
	 * Check if CURL can be used
	 */
	public static function check_curl ($secure = true)
	{
		if (in_array ('curl', get_loaded_extensions ()) AND function_exists ('curl_exec'))
		{
			$result = self::curl_request (($secure ? 'https' : 'http') . '://www.oneall.com/ping.html');
			if (is_object ($result) AND property_exists ($result, 'http_code') AND $result->http_code == 200)
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
	 * Sends a CURL request
	 */
	public static function curl_request ($url, $options = array (), $timeout = 10)
	{
		//Store the result
		$result = new stdClass ();

		//Send request
		$curl = curl_init ();
		curl_setopt ($curl, CURLOPT_URL, $url);
		curl_setopt ($curl, CURLOPT_HEADER, 0);
		curl_setopt ($curl, CURLOPT_TIMEOUT, $timeout);
		curl_setopt ($curl, CURLOPT_VERBOSE, 0);
		curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ($curl, CURLOPT_USERAGENT, 'SocialLogin ' . self::OA_SOCIAL_LOGIN_VERSION . ' phpBB3 (+http://www.oneall.com/)');

		// BASIC AUTH?
		if (isset ($options ['api_key']) AND isset ($options ['api_secret']))
		{
			curl_setopt ($curl, CURLOPT_USERPWD, $options ['api_key'] . ":" . $options ['api_secret']);
		}

		//Make request
		if (($http_data = curl_exec ($curl)) !== false)
		{
			$result->http_code = curl_getinfo ($curl, CURLINFO_HTTP_CODE);
			$result->http_data = $http_data;
			$result->http_error = null;
		}
		else
		{
			$result->http_code = -1;
			$result->http_data = null;
			$result->http_error = curl_error ($curl);
		}

		//Done
		return $result;
	}


	/**
	 * Check if fsockopen can be used
	 */
	public static function check_fsockopen ($secure = true)
	{
		$result = self::fsockopen_request (($secure ? 'https' : 'http') . '://www.oneall.com/ping.html');
		if (is_object ($result) AND property_exists ($result, 'http_code') AND $result->http_code == 200)
		{
			if (property_exists ($result, 'http_data'))
			{
				if (strtolower ($result->http_data) == 'ok')
				{
					return true;
				}
			}
		}
		return false;
	}


	/**
	 * Send an fsockopen request
	 */
	public static function fsockopen_request ($url, $options = array (), $timeout = 15)
	{
		//Store the result
		$result = new stdClass ();

		//Make that this is a valid URL
		if (($uri = parse_url ($url)) == false)
		{
			$result->http_code = -1;
			$result->http_data = null;
			$result->http_error = 'invalid_uri';
			return $result;
		}

		//Make sure we can handle the schema
		switch ($uri ['scheme'])
		{
			case 'http':
				$port = (isset ($uri ['port']) ? $uri ['port'] : 80);
				$host = ($uri ['host'] . ($port != 80 ? ':' . $port : ''));
				$fp = @fsockopen ($uri ['host'], $port, $errno, $errstr, $timeout);
				break;

			case 'https':
				$port = (isset ($uri ['port']) ? $uri ['port'] : 443);
				$host = ($uri ['host'] . ($port != 443 ? ':' . $port : ''));
				$fp = @fsockopen ('ssl://' . $uri ['host'], $port, $errno, $errstr, $timeout);
				break;

			default:
				$result->http_code = -1;
				$result->http_data = null;
				$result->http_error = 'invalid_schema';
				return $result;
				break;
		}

		//Make sure the socket opened properly
		if (!$fp)
		{
			$result->http_code = -$errno;
			$result->http_data = null;
			$result->http_error = trim ($errstr);
			return $result;
		}

		//Construct the path to act on
		$path = (isset ($uri ['path']) ? $uri ['path'] : '/');
		if (isset ($uri ['query']))
		{
			$path .= '?' . $uri ['query'];
		}

		//Create HTTP request
		$defaults = array ();
		$defaults ['Host'] = 'Host: ' . $host;
		$defaults ['User-Agent'] = 'User-Agent: SocialLogin ' . self::OA_SOCIAL_LOGIN_VERSION . ' phpBB3 (+http://www.oneall.com/)';

		// BASIC AUTH?
		if (isset ($options ['api_key']) AND isset ($options ['api_secret']))
		{
			$defaults ['Authorization'] = 'Authorization: Basic ' . base64_encode ($options ['api_key'] . ":" . $options ['api_secret']);
		}

		//Build and send request
		$request = 'GET ' . $path . " HTTP/1.0\r\n";
		$request .= implode ("\r\n", $defaults);
		$request .= "\r\n\r\n";
		fwrite ($fp, $request);

		//Fetch response
		$response = '';
		while (!feof ($fp))
		{
			$response .= fread ($fp, 1024);
		}

		//Close connection
		fclose ($fp);

		//Parse response
		list($response_header, $response_body) = explode ("\r\n\r\n", $response, 2);

		//Parse header
		$response_header = preg_split ("/\r\n|\n|\r/", $response_header);
		list($header_protocol, $header_code, $header_status_message) = explode (' ', trim (array_shift ($response_header)), 3);

		//Build result
		$result->http_code = $header_code;
		$result->http_data = $response_body;

		//Done
		return $result;
	}
}