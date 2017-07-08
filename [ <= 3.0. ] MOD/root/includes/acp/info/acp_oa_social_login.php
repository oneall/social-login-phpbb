<?php
/**
 * @package   	OneAll Social Login Mod
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
if (!defined('IN_PHPBB'))
{
	exit;
}

class acp_oa_social_login_info
{
	function module()
	{
		return array(
			'filename' => 'acp_oa_social_login',
			'title' => 'ACP_OA_SOCIAL_LOGIN',
			'version' => '3.6.2',
			'modes' => array(
				'index' => array(
					'title' => 'ACP_OA_SOCIAL_LOGIN_SETTINGS',
					'auth' => 'acl_a_server',
					'cat' => array(
						'ACP_CLIENT_COMMUNICATION'
					),
				),
			),
		);
	}

	/**
	 * Install
	 */
	function install()
	{
	}

	/**
	 * UnInstall
	 */
	function uninstall()
	{
	}
}
