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
namespace oneall\oa_social_login\ucp;

if (!defined('IN_PHPBB'))
{
	exit;
}

//Social Link Service
class oa_social_login_ucp_module
{
	// Add Social Link to UCP \ Profile \ Social link.
	public function main ($id, $mode)
	{
		global $config, $db, $user, $auth, $template, $phpbb_root_path, $phpEx, $request, $phpbb_dispatcher;

		//Initialize module.
		$oa_social_login = new \oneall\oa_social_login\acp\oa_social_login_acp_module ();

		// User must be logged in and not a bot
		if (is_object ($user) && empty ($user->data ['isbot']) && (! empty ($user->data ['user_id']) && $user->data ['user_id'] != ANONYMOUS))
		{
			// Only display this in the UCP.
			if (! empty ($user->page ['page_name']) && strpos ($user->page ['page_name'], 'ucp') !== false)
			{
				// Retrieve user_token.
				if (($user_token = $oa_social_login->get_user_token_for_user_id ($user->data ['user_id'])) !== false)
				{
					$template->assign_var ('OA_SOCIAL_LINK_USER_TOKEN', $user_token);
				}

				// We have a login token.
				if (request_var ('oa_social_login_login_token', '') == '')
				{
					// Forge callback uri.
					$callback_uri = $oa_social_login->get_current_url ();
					$callback_uri .= ((strpos ($callback_uri, '?') === false) ? '?' : '&');
					$callback_uri .= ('oa_social_login_login_token='.$oa_social_login->create_login_token_for_user_id ($user->data ['user_id']));
				}

				// Assign callback uri.
				$template->assign_var ('OA_SOCIAL_LINK_CALLBACK_URI', $callback_uri);
			}
		}

		// Set desired template
		$this->tpl_name = 'oa_social_login_ucp_social_link';
		$this->page_title = 'UCP_OA_SOCIAL_LINK';

	}
}
