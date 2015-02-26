<?php

/**
 * @package   	OneAll Social Login
 * @copyright 	Copyright 2013-2015 http://www.oneall.com - All rights reserved.
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

	/**
	 * Constructor
	 */
	public function __construct (\phpbb\config\config $config,\phpbb\config\db_text $config_text,\phpbb\controller\helper $controller_helper,\phpbb\request\request $request,\phpbb\template\template $template,\phpbb\user $user)
	{
		$this->config = $config;
		$this->config_text = $config_text;
		$this->controller_helper = $controller_helper;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
	}


	/**
	 * Assign functions defined in this class to event listeners in the core
	 */
	static public function getSubscribedEvents ()
	{
		return array (
			'core.page_header_after' => 'setup',
			'core.user_setup' => 'add_language'
		);
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
				// Embed on the main page
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


				// Embed on the login page
				if (request_var ('mode', '') == 'login')
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
				}

				// Embed on the registration page
				if (request_var ('mode', '') == 'register')
				{
					// Only if the user has agreed to the terms
					if (request_var ('agreed', '') != '')
					{
						// Trigger icons.
						$this->template->assign_var ('OA_SOCIAL_LOGIN_EMBED_SOCIAL_LOGIN', 1);

						// Set caption
						if (! empty ($this->config ['oa_social_login_registration_page_caption']))
						{
							$this->template->assign_var ('OA_SOCIAL_LOGIN_PAGE_CAPTION', $this->config ['oa_social_login_registration_page_caption']);
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
		// These values are returned by OneAll
		if (strlen ((request_var ('oa_action', ''))) > 0 && strlen (request_var ('connection_token', '')) > 0)
		{
			$sociallogin = new \oneall\sociallogin\acp\sociallogin_acp_module ();
			$sociallogin->handle_callback ();
		}
	}
}
