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
namespace phpbb\oa_social_login\migrations\v10x;

/**
 * Migration stage 3: Initial module
 */
class m3_initial_module extends \phpbb\db\migration\migration
{
	public function update_data ()
	{
		return array (

			// Add Social Login group to ACP \ Extensions
			array (
				'module.add',
				array (
					'acp',
					'ACP_CAT_DOT_MODS',
					'ACP_OA_SOCIAL_LOGIN'
				)
			),

			// Add Settings link to Social Login group
			array (
				'module.add',
				array (
					'acp',
					'ACP_OA_SOCIAL_LOGIN',
					array (
						'module_basename' => '\phpbb\oa_social_login\acp\oa_social_login_acp_module',
						'modes' => array (
							'settings'
						)
					)
				)
			),

			// Add Social Link group to UCP \ Profile
			array (
				'module.add',
				array (
					'ucp',
					'UCP_PROFILE',
					'UCP_OA_SOCIAL_LINK'
				)
			),

			// Add Settings link to Social Link group
			array (
				'module.add',
				array (
					'ucp',
					'UCP_OA_SOCIAL_LINK',
					array (
						'module_basename' => '\phpbb\oa_social_login\ucp\oa_social_login_ucp_module',
						'modes' => array (
							'settings'
						)
					)
				)
			)
		);
	}
}
