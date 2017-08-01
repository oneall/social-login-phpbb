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

	// @var \oneall\sociallogin\core\helper
	protected $helper;

	// Has the current user logged in with Social Login
	protected $is_oa_user = null;

	/**
	 * Constructor
	 */
	public function __construct (\phpbb\config\config $config,\phpbb\config\db_text $config_text,\phpbb\controller\helper $controller_helper,\phpbb\request\request $request,\phpbb\template\template $template,\phpbb\user $user, $phpbb_root_path, $php_ext, \oneall\sociallogin\core\helper $helper)
	{
		$this->config = $config;
		$this->config_text = $config_text;
		$this->controller_helper = $controller_helper;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->helper = $helper;
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
			'core.ucp_profile_reg_details_validate' => 'skip_cur_password_check'
		);
	}

	/**
	 * Helper function to check if a user is logged in with Social Login.
	 * Memorizes the result in attribute to avoid rechecks.
	 */
	private function is_oa_user ()
	{
		if (is_null ($this->is_oa_user))
		{
			$this->is_oa_user = (($this->helper->get_user_token_for_user_id ($this->user->data['user_id']) === false) ? false : true);
		}
		return $this->is_oa_user;
	}

	/**
	 * Notifies if a user is logged in with Social Login, to the UCP template.
	 * The UCP template event will disable the cur_password form input.
	 */
	public function set_oa_user ($event)
	{
		$this->template->assign_var ('OA_SOCIAL_LOGIN_USER', $this->is_oa_user ());
	}

	/**
	 * Allow changes to account settings without password for Social Login users.
	 * This is required because the cur_password field is disabled for Social Login users.
	 */
	public function skip_cur_password_check ($event)
	{
		if ($this->is_oa_user ())
		{
			$filtered = array_filter ($event['error'], function ($v) {
				return $v != 'CUR_PASSWORD_EMPTY';
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

			// Setup template placeholders
			$this->template->assign_vars (array (
				'OA_SOCIAL_LOGIN_EMBED_LIBRARY' => 1,
				'OA_SOCIAL_LOGIN_API_SUBDOMAIN' => addslashes ($this->config ['oa_social_login_api_subdomain']),
				'OA_SOCIAL_LOGIN_CALLBACK_URI' => addslashes ($this->helper->get_current_url ()),
				'OA_SOCIAL_LOGIN_PROVIDERS' => implode ("','", explode (",", $this->config ['oa_social_login_providers']))
			));

			// User must not be logged in
			if ( empty ($this->user->data['user_id']) || $this->user->data['user_id'] == ANONYMOUS)
			{
				// Embed on the main page ?
				if (! empty ($this->user->page['page_name']) && $this->user->page['page_name'] == 'index' . $this->php_ext)
				{
					// Can be changed in the social login settings.
					if (empty ($this->config ['oa_social_login_index_page_disable']))
					{
						$this->template->assign_vars (array (
							'OA_SOCIAL_LOGIN_EMBED_SOCIAL_LOGIN' => 1,
							'OA_SOCIAL_LOGIN_PAGE_CAPTION' => $this->config ['oa_social_login_index_page_caption']
						));
					}
				}
				// Embed on the login page ?
				elseif ($this->request->variable ('mode', '') == 'login')
				{
					// Can be changed in the social login settings.
					if (empty ($this->config ['oa_social_login_login_page_disable']))
					{
						$this->template->assign_vars (array (
							'OA_SOCIAL_LOGIN_EMBED_SOCIAL_LOGIN' => 1,
							'OA_SOCIAL_LOGIN_PAGE_CAPTION' => $this->config ['oa_social_login_login_page_caption']
						));
					}
					if (empty ($this->config ['oa_social_login_inline_page_disable']))
					{
						$this->template->assign_vars (array (
							'OA_SOCIAL_LOGIN_EMBED_SOCIAL_LOGIN_INLINE' => 1,
							'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION' => $this->config ['oa_social_login_inline_page_caption']
						));
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
							$this->template->assign_vars (array (
								'OA_SOCIAL_LOGIN_EMBED_SOCIAL_LOGIN' => 1,
								'OA_SOCIAL_LOGIN_PAGE_CAPTION' => $this->config ['oa_social_login_registration_page_caption']
							));
						}
					}
				}
				// Embed on any other page, except the validation page ?
				elseif (! strpos ($this->user->page['page_name'],
							substr ($this->controller_helper->route ("oneall_sociallogin_validate"), strlen ('/app' . $this->php_ext))))
				{
					// Can be changed in the social login settings.
					if (empty ($this->config ['oa_social_login_other_page_disable']))
					{
						$this->template->assign_vars (array (
								'OA_SOCIAL_LOGIN_EMBED_SOCIAL_LOGIN' => 1,
								'OA_SOCIAL_LOGIN_PAGE_CAPTION' => $this->config ['oa_social_login_other_page_caption']
						));
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
			$user_data = $this->helper->handle_callback ();

			if (is_array ($user_data))
			{
				$user_data ['redirect'] = $this->helper->get_current_url ();
				$json_user_data = @json_encode ($user_data);

				$this->helper->put_session_validation_data ($this->user->data['session_id'], $json_user_data);
				$this->helper->http_redirect ($this->controller_helper->route ("oneall_sociallogin_validate"), false);
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

		// Form Values.
		$this->template->assign_vars (array (
		    'OA_SOCIAL_LOGIN_USERNAME_EXPLAIN' => $this->user->lang (
		        $this->config['allow_name_chars'] . '_EXPLAIN',
		        $this->user->lang ('CHARACTERS', (int) $this->config['min_name_chars']),
		        $this->user->lang ('CHARACTERS', (int) $this->config['max_name_chars'])),
		    'OA_SOCIAL_LOGIN_VALIDATE' => $this->controller_helper->route ('oneall_sociallogin_validate')
		));

		// Form Submitted.
		if (strlen (($this->request->variable ('submit', ''))) > 0)
		{
			$login = $this->request->variable ('username', '');
			$email = $this->request->variable ('email', '');

			// User Functions
			if (! function_exists ('validate_data'))
			{
				include ($this->phpbb_root_path . 'includes/functions_user.' . $this->php_ext);
			}

			// Fields to validate.
			$user_input = array (
				'username' => $login,
				'email' => $email,
			);

			// Checks to do.
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

			// Validate fields.
			$validation_errors = validate_data ($user_input, $user_input_checks);

			// Errors found.
			if (is_array ($validation_errors) && count ($validation_errors) > 0)
			{
				foreach ($validation_errors as $validation_error)
				{
					$this->template->assign_block_vars ('errors', array (
					    'msg' => $this->user->lang ($validation_error)
					));
				}

				// Fill out form.
				$this->template->assign_vars (array (
					'OA_SOCIAL_LOGIN_VALIDATION_ERROR' => true,
					'OA_SOCIAL_LOGIN_VALIDATION_USER_LOGIN' => $login,
					'OA_SOCIAL_LOGIN_VALIDATION_USER_EMAIL' => $email
				));

				return $this->controller_helper->render ('sociallogin_validation_body.html', 'validation');
			}

			// Retrieve the temporarily stored social network profile data
			$social_network_profile_data = $this->helper->get_session_validation_data ($this->user->data['session_id'], true);
			if ($social_network_profile_data === null)
			{
				trigger_error ($this->user->lang ('OA_SOCIAL_LOGIN_VALIDATION_SESSION_ERROR'));
			}

			// Add the custom values.
			$social_network_profile_data ['user_login'] = $login;
			$social_network_profile_data ['user_email'] = $email;

			// Removes data which is no longer required.
			$this->helper->delete_session_validation_data ($this->user->data['session_id']);

			// Create new user.
			list ($error_message, $user_id) = $this->helper->social_login_user_add (false, $social_network_profile_data);

			// Redirect.
			$this->helper->social_login_redirect($error_message, $user_id, $social_network_profile_data);
		}
		// Display Initial Form.
		else
		{
		    // Retrieve the temporarily stored social network profile data
		    $social_network_profile_data = $this->helper->get_session_validation_data ($this->user->data['session_id'], true);
		    if ($social_network_profile_data === null)
		    {
		        trigger_error ($this->user->lang ('OA_SOCIAL_LOGIN_VALIDATION_SESSION_ERROR'));
		    }

		    // Fill out form.
			$this->template->assign_vars (array (
			    'OA_SOCIAL_LOGIN_VALIDATION_USER_LOGIN' => $social_network_profile_data['user_login'],
			    'OA_SOCIAL_LOGIN_VALIDATION_USER_EMAIL' => $social_network_profile_data['user_email'],
			));

			// Display.
			return $this->controller_helper->render ('sociallogin_validation_body.html', 'validation');
		}
	}
}
