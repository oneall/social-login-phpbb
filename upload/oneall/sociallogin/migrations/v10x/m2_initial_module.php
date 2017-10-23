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
namespace oneall\sociallogin\migrations\v10x;

/**
 * Migration stage 2: Initial module
 */
class m2_initial_module extends \phpbb\db\migration\migration
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
					'OA_SOCIAL_LOGIN_ACP'
				)
			),

			// Add Settings link to Social Login group
			array (
				'module.add',
				array (
					'acp',
					'OA_SOCIAL_LOGIN_ACP',
					array (
						'module_basename' => '\oneall\sociallogin\acp\sociallogin_acp_module',
					    'module_auth'=> 'ext_oneall/sociallogin',
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
					'',
					'OA_SOCIAL_LOGIN_LINK_UCP'
				)
			),

			// Add Settings link to Social Link group
			array (
				'module.add',
				array (
					'ucp',
					'OA_SOCIAL_LOGIN_LINK_UCP',
					array (
						'module_basename' => '\oneall\sociallogin\ucp\sociallogin_ucp_module',
						'modes' => array (
							'settings'
						)
					)
				)
			)
		);
	}
}
