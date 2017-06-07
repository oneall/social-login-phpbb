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
namespace oneall\sociallogin\ucp;

if (! defined ('IN_PHPBB'))
{
	exit ();
}

// Social Link Service
class sociallogin_ucp_module
{
	// Add Social Link to UCP \ Profile \ Social link.
	public function main ($id, $mode)
	{
		global $user, $template, $phpbb_container;

		// User must be logged in and not a bot
		if (is_object ($user) && empty ($user->data ['isbot']) && (! empty ($user->data ['user_id']) && $user->data ['user_id'] != ANONYMOUS))
		{
			// Only display this in the UCP.
			if (! empty ($user->page ['page_name']) && strpos ($user->page ['page_name'], 'ucp') !== false)
			{
			    // Helper.
			    $helper = $phpbb_container->get('oneall.sociallogin.helper');

				// Retrieve user_token.
				if (($user_token = $helper->get_user_token_for_user_id ($user->data ['user_id'])) !== false)
				{
					$template->assign_var ('OA_SOCIAL_LINK_USER_TOKEN', addslashes ($user_token));
				}

				// Create callback uri.
				$callback_uri = $helper->get_current_url ();
				$callback_uri .= ((strpos ($callback_uri, '?') === false) ? '?' : '&');
				$callback_uri .= ('oa_social_login_login_token=' . $helper->create_login_token_for_user_id ($user->data ['user_id']));

				// Assign callback uri.
				$template->assign_var ('OA_SOCIAL_LINK_CALLBACK_URI', addslashes ($callback_uri));
			}
		}

		// Set desired template
		$this->tpl_name = 'sociallogin_ucp_social_link';
		$this->page_title = 'OA_SOCIAL_LOGIN_LINK_UCP';
	}
}
