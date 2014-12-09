<?php

/**
 * @package   	OneAll Social Login
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
namespace phpbb\oneallsociallogin\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{

	/**
	 *
	 * @var \phpbb\config\config
	 */
	protected $config;

	/**
	 *
	 * @var \phpbb\config\db_text
	 */
	protected $config_text;

	/**
	 *
	 * @var \phpbb\controller\helper
	 */
	protected $controller_helper;

	/**
	 *
	 * @var \phpbb\request\request
	 */
	protected $request;

	/**
	 *
	 * @var \phpbb\template\template
	 */
	protected $template;

	/**
	 *
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config $config
	 *        	Config object
	 * @param \phpbb\config\db_text $config_text
	 *        	DB text object
	 * @param \phpbb\controller\helper $controller_helper
	 *        	Controller helper object
	 * @param \phpbb\request\request $request
	 *        	Request object
	 * @param \phpbb\template\template $template
	 *        	Template object
	 * @param \phpbb\user $user
	 *        	User object
	 * @return \phpbb\boardrules\event\listener
	 * @access public
	 */
	public function __construct (\phpbb\config\config $config, \phpbb\config\db_text $config_text, \phpbb\controller\helper $controller_helper, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->config = $config;
		$this->config_text = $config_text;
		$this->controller_helper = $controller_helper;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->user->add_lang_ext ('phpbb/oneallsociallogin', 'oneallsociallogin');
	}

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 * @static
	 *
	 *
	 * @access public
	 */
	static public function getSubscribedEvents ()
	{
		return array (
			// testing for register page
			'ucp_register_credentials_before' => 'oneallscriptiframe',
			'navbar_header_logged_out_content' => 'oneallscriptiframe',
			'core.page_header' => 'oa_social_login_callback_hook'
		);
	}
	public function oneallscriptiframe ($event)
	{
		// Handle callback.
		$oa_social_login = new \phpbb\oneallsociallogin\acp\oneallsociallogin_module ();

		// User token
		if (($user_token = $oa_social_login->get_user_token_for_user_id ($this->user->data ['user_id'])) !== false)
		{
			$this->template->assign_var ('OA_SOCIAL_LOGIN_USER_TOKEN', $user_token);
		}

		$oa_social_login_providers = explode (",", $this->config ['oa_social_login_providers']);
		// HTTP / HTTPS
		$server_protocol = (! empty ($this->config ['server_protocol'])) ? (str_replace ('://', '', $this->config ['server_protocol'])) : ($this->config ['cookie_secure'] ? 'https' : 'http');
		$this->template->assign_var ('OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER', $this->config ['oa_social_login_api_connection_handler']);
		$this->template->assign_var ('OA_SOCIAL_LOGIN_RAND', mt_rand (99999, 9999999));
		$this->template->assign_var ('OA_SOCIAL_LOGIN_CALLBACK_URI', $this->config ['oa_social_login_redirect']);
		$this->template->assign_var ('OA_SOCIAL_LOGIN_PROTOCOL', $server_protocol);
		$this->template->assign_var ('OA_SOCIAL_LOGIN_LIBRARY', ($server_protocol . '://' . trim ($this->config ['oa_social_login_api_subdomain']) . '.api.oneall.com/socialize/library.js'));
		$this->template->assign_var ('OA_SOCIAL_LOGIN_PROVIDERS', implode ("','", $oa_social_login_providers));
	}

	// Hook used for the callback handler.
	public function oa_social_login_callback_hook ()
	{

		// Handle callback.
		$oa_social_login = new \phpbb\oneallsociallogin\acp\oneallsociallogin_module ();
		$oa_social_login->handle_callback ();

		// User token
		if (($user_token = $oa_social_login->get_user_token_for_user_id ($this->user->data ['user_id'])) !== false)
		{
			$this->template->assign_var ('OA_SOCIAL_LOGIN_USER_TOKEN', $user_token);
		}

		$oa_social_login_providers = explode (",", $this->config ['oa_social_login_providers']);
		// HTTP / HTTPS
		$server_protocol = (! empty ($this->config ['server_protocol'])) ? (str_replace ('://', '', $this->config ['server_protocol'])) : ($this->config ['cookie_secure'] ? 'https' : 'http');
		$this->template->assign_var ('OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER', $this->config ['oa_social_login_api_connection_handler']);
		$this->template->assign_var ('OA_SOCIAL_LOGIN_RAND', mt_rand (99999, 9999999));
		$this->template->assign_var ('OA_SOCIAL_LOGIN_CALLBACK_URI', $this->config ['oa_social_login_redirect']);
		$this->template->assign_var ('OA_SOCIAL_LOGIN_PROTOCOL', $server_protocol);
		$this->template->assign_var ('OA_SOCIAL_LOGIN_LIBRARY', ($server_protocol . '://' . trim ($this->config ['oa_social_login_api_subdomain']) . '.api.oneall.com/socialize/library.js'));
		$this->template->assign_var ('OA_SOCIAL_LOGIN_PROVIDERS', implode ("','", $oa_social_login_providers));
	}
}
