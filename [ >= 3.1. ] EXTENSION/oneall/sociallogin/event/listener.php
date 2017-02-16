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
namespace oneall\sociallogin\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{
	// @var \phpbb\config\config
	protected $config;

	// @var \phpbb\config\db_text
	protected $config_text;

	// @var \phpbb\controller\helper
	protected $controller_helper;

	// @var \phpbb\request\request
	protected $request;

	// @var \phpbb\template\template
	protected $template;

	// @var \phpbb\user
	protected $user;
	
	// @var string php_root_path
	protected $phpbb_root_path;

	// @var string phpEx
	protected $php_ext;


	/**
	 * Constructor
	 */
	public function __construct (\phpbb\config\config $config,\phpbb\config\db_text $config_text,\phpbb\controller\helper $controller_helper,\phpbb\request\request $request,\phpbb\template\template $template,\phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->config = $config;
		$this->config_text = $config_text;
		$this->controller_helper = $controller_helper;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->oa_user = null;  // is the user logged in with oneall.
	}


	/**
	 * Assign functions defined in this class to event listeners in the core
	 */
	static public function getSubscribedEvents ()
	{
		return array (
			'core.page_header_after' => 'setup',
			'core.user_setup' => 'add_language',
			'core.ucp_profile_reg_details_data' => 'set_oa_user',
			'core.ucp_profile_reg_details_validate' => 'skip_cur_password_check',
			'oneall_sociallogin.user_add_modify_data' => 'modify_data',
		);
	}

	/**
	 * Helper function to check if a user is logged in with Social Login.
	 * Memorizes the result in attribute to avoid rechecks.
	 */
	private function is_user_oa ()
	{
		if (! isset ($this->oa_user)) {
			$sociallogin = new \oneall\sociallogin\acp\sociallogin_acp_module ();
			$user_token = $sociallogin->get_user_token_for_user_id ($this->user->data['user_id']);
			$this->oa_user = $user_token !== false;
		}
		return $this->oa_user;
	}

	/**
	 * Notifies if a user is logged in with Social Login, to the UCP template.
	 * The UCP template event will disable the cur_password form input.
	 */
	public function set_oa_user ($event)
	{
		$this->template->assign_var ('OA_SOCIAL_LOGIN_USER', $this->is_user_oa ());
	}

	/**
	 * Allow changes to account settings without password for Social Login users.
	 * Because the template disabled the input field cur_password.
	 */
	public function skip_cur_password_check ($event)
	{
		if ($this->is_user_oa ())
		{
			$filtered = array_filter ($event['error'], function ($v) { 
				return $v != 'CUR_PASSWORD_EMPTY';  // from phpbb source code.
			});
			$event['error'] = $filtered;
		}
	}

	/**
	 * Add Social Login language file.
	 */
	public function add_language ($event)
	{
		// Read language settings.
		$lang_set_ext = $event['lang_set_ext'];

		// Add frontend language strings.
		$lang_set_ext[] = array(
			'ext_name' => 'oneall/sociallogin',
			'lang_set' => 'frontend'
		);

		// Add backend language strings.
		$lang_set_ext[] = array(
			'ext_name' => 'oneall/sociallogin',
			'lang_set' => 'backend'
		);

		// Set language settings.
		$event['lang_set_ext'] = $lang_set_ext;
	}


	/**
	 * Setup Social Login.
	 */
	public function setup ($event)
	{
		// The plugin must be enabled and the API settings must be filled out
		if (empty ($this->config ['oa_social_login_disable']) && ! empty ($this->config ['oa_social_login_api_subdomain']))
		{
			// First check for a callback
			$this->check_callback ();

			// Initialize module.
			$sociallogin = new \oneall\sociallogin\acp\sociallogin_acp_module ();

			// Setup template placeholders
			$this->template->assign_var ('OA_SOCIAL_LOGIN_EMBED_LIBRARY', 1);
			$this->template->assign_var ('OA_SOCIAL_LOGIN_API_SUBDOMAIN', $this->config ['oa_social_login_api_subdomain']);
			$this->template->assign_var ('OA_SOCIAL_LOGIN_CALLBACK_URI', $sociallogin->get_current_url ());
			$this->template->assign_var ('OA_SOCIAL_LOGIN_PROVIDERS', implode ("','", explode (",", $this->config ['oa_social_login_providers'])));

			// User must not be logged in
			if ( empty ($this->user->data['user_id']) || $this->user->data['user_id'] == ANONYMOUS)
			{
				// Embed on the main page ?
				if (! empty ($this->user->page['page_name']) && $this->user->page['page_name'] == 'index.php')
				{
					// Can be changed in the social login settings.
					if (empty ($this->config ['oa_social_login_index_page_disable']))
					{
						// Trigger icons.
						$this->template->assign_var ('OA_SOCIAL_LOGIN_EMBED_SOCIAL_LOGIN', 1);

						// Set caption
						if (! empty ($this->config ['oa_social_login_index_page_caption']))
						{
							$this->template->assign_var ('OA_SOCIAL_LOGIN_PAGE_CAPTION', $this->config ['oa_social_login_index_page_caption']);
						}
					}
				}
				// Embed on the login page ?
				elseif ($this->request->variable ('mode', '') == 'login')
				{
					// Can be changed in the social login settings.
					if (empty ($this->config ['oa_social_login_login_page_disable']))
					{
						// Trigger icons.
						$this->template->assign_var ('OA_SOCIAL_LOGIN_EMBED_SOCIAL_LOGIN', 1);

						// Set caption
						if (! empty ($this->config ['oa_social_login_login_page_caption']))
						{
							$this->template->assign_var ('OA_SOCIAL_LOGIN_PAGE_CAPTION', $this->config ['oa_social_login_login_page_caption']);
						}
					}
					if (empty ($this->config ['oa_social_login_inline_page_disable']))
					{
						// Trigger icons.
						$this->template->assign_var ('OA_SOCIAL_LOGIN_EMBED_SOCIAL_LOGIN_INLINE', 1);

						// Set caption
						if (! empty ($this->config ['oa_social_login_inline_page_caption']))
						{
							$this->template->assign_var ('OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION', $this->config ['oa_social_login_inline_page_caption']);
						}
					}
				}
				// Embed on the registration page ?
				elseif ($this->request->variable ('mode', '') == 'register')
				{
					// Can be changed in the social login settings.
					if (empty ($this->config ['oa_social_login_registration_page_disable']))
					{
						// Only if the user has agreed to the terms
						if ($this->request->variable ('agreed', '') != '')
						{
							// Trigger icons.
							$this->template->assign_var ('OA_SOCIAL_LOGIN_EMBED_SOCIAL_LOGIN', 1);

							// Set Social Loin caption.
							if (! empty ($this->config ['oa_social_login_registration_page_caption']))
							{
								$this->template->assign_var ('OA_SOCIAL_LOGIN_PAGE_CAPTION', $this->config ['oa_social_login_registration_page_caption']);
							}
						}
					}
				}
				// Embed on any other page, except the validation page ?
				elseif (! strpos ($this->user->page['page_name'], 
							substr ($this->controller_helper->route ("oneall_sociallogin_validate"), strlen ('/app.php'))))
				{
					// Can be changed in the social login settings.
					if (empty ($this->config ['oa_social_login_other_page_disable']))
					{
						// Trigger icons.
						$this->template->assign_var ('OA_SOCIAL_LOGIN_EMBED_SOCIAL_LOGIN', 1);

						// Set caption
						if (! empty ($this->config ['oa_social_login_other_page_caption']))
						{
							$this->template->assign_var ('OA_SOCIAL_LOGIN_PAGE_CAPTION', $this->config ['oa_social_login_other_page_caption']);
						}
					}
				}
			}
		}
	}

	/**
	 * Hook used for the callback handler.
	 */
	public function check_callback ()
	{
		if (strlen ($this->request->variable ('oa_action', '')) > 0 && strlen ($this->request->variable ('connection_token', '')) > 0)
		{
			$sociallogin = new \oneall\sociallogin\acp\sociallogin_acp_module ();
			$user_data = $sociallogin->handle_callback ();
			if (is_array ($user_data))  // validation required
			{
				$user_data ['redirect'] = $sociallogin->get_current_url ();
				$json_user_data = @json_encode ($user_data);
				$sociallogin->put_session_validation_data ($this->user->data['session_id'], $json_user_data);
				\oneall\sociallogin\acp\sociallogin_acp_module::http_redirect ($this->controller_helper->route ("oneall_sociallogin_validate"));
			}
		}
	}

	/**
	 * Validation form
	 * See config/routing.yml
	 */
	public function handle ()
	{
		$this->user->add_lang ('ucp');
		$sociallogin = new \oneall\sociallogin\acp\sociallogin_acp_module ();
		if (strlen (($this->request->variable ('submit', ''))) > 0)
		{
			$login = $this->request->variable ('username', '');
			$email = $this->request->variable ('email', '');
			$validation_error = array ();
			if (! function_exists ('validate_data'))
			{
				include ($this->phpbb_root_path . 'includes/functions_user.' . $this->php_ext);
			}
			$user_input = array (
				'username' => $login,
				'email' => $email,
			);
			$user_input_checks = array (
				'username' => array (
					array ('username'),
					array ('string', false, $this->config['min_name_chars'], $this->config['max_name_chars']),
				),
				'email' => array (
					array ('user_email'),
					array ('string', false, 6, 60),
				),
			);
			$validation_error = validate_data ($user_input, $user_input_checks);
			if ($validation_error)
			{
				foreach ($validation_error as $msgs) 
				{
					$this->template->assign_block_vars ('errors', array ('msg' => $this->user->lang ($msgs)));
				}
				$this->template->assign_vars (array (
					'ERROR' => true,
					'OA_SOCIAL_LOGIN_VALIDATION_USER_LOGIN' => $login,
					'OA_SOCIAL_LOGIN_USERNAME_EXPLAIN' => $this->user->lang (
						$this->config['allow_name_chars'] . '_EXPLAIN', 
						$this->user->lang ('CHARACTERS', (int) $this->config['min_name_chars']), 
						$this->user->lang ('CHARACTERS', (int) $this->config['max_name_chars'])),
					'OA_SOCIAL_LOGIN_VALIDATION_USER_EMAIL' => $email,
					'OA_SOCIAL_LOGIN_VALIDATION_NO_EMAIL' => empty ($email),
					'OA_SOCIAL_LOGIN_VALIDATE' => $this->controller_helper->route ("oneall_sociallogin_validate") 
				));
				return $this->controller_helper->render ('sociallogin_validation_body.html', 'validation');
			}
			$val = $sociallogin->get_session_validation_data ($this->user->data['session_id']);
			$user_data = $val ? json_decode ($val['user_data'], true) : null;
			if ($user_data === null)
			{
				trigger_error ($this->user->lang ('OA_SOCIAL_LOGIN_VALIDATION_SESSION_ERROR'));
			}
			$user_data ['user_login'] = $login;
			$user_data ['user_email'] = $email;
			$sociallogin->delete_session_validation_data ($this->user->data['session_id']);
			$sociallogin->social_login_resume_handle_callback ($user_data);
		}
		else
		{
			$val = $sociallogin->get_session_validation_data ($this->user->data['session_id']);
			$user_data = $val ? json_decode ($val['user_data'], true) : null;
			if ($user_data === null)
			{
				trigger_error ($this->user->lang ('OA_SOCIAL_LOGIN_VALIDATION_SESSION_ERROR'));
			}
			$this->template->assign_vars (
					array (
							'OA_SOCIAL_LOGIN_VALIDATION_USER_LOGIN' => $user_data['user_login'],
							'OA_SOCIAL_LOGIN_USERNAME_EXPLAIN' => $this->user->lang (
									$this->config['allow_name_chars'] . '_EXPLAIN',
									$this->user->lang ('CHARACTERS', (int) $this->config['min_name_chars']),
									$this->user->lang ('CHARACTERS', (int) $this->config['max_name_chars'])),
							'OA_SOCIAL_LOGIN_VALIDATION_USER_EMAIL' => $user_data['user_email'],
							'OA_SOCIAL_LOGIN_VALIDATION_NO_EMAIL' => empty ($user_data['user_email']),
							'OA_SOCIAL_LOGIN_VALIDATE' => $this->controller_helper->route ("oneall_sociallogin_validate"),
					)
			);
			return $this->controller_helper->render ('sociallogin_validation_body.html', 'validation');
		}
	}

	
	/**
	 * Event handler for custom fields and user row modifications.
	 */
	public function modify_data ($event)
	{
		global $phpbb_log, $user;
		
		// The data retrieved from the social network profile.
		$social = $event['social_profile'];

		// The following code serves as example for custom changes.
		
		/*
		
		$event['cp_data'] = array (
				// For example: a custom field named 'tastes':
				'pf_tastes' => $social['user_languages_simple'][0],  // Risk of E_NOTICE and NULL.
			);
			
		*/
		
		// Uncomment following line if you need logs.
		$phpbb_log->add ('admin', $user->data['user_id'], $user->ip, 'LOG_PROFILE_FIELD_EDIT', time(), $event['cp_data']);
	}
}
