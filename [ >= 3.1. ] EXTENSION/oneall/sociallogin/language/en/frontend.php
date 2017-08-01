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
if (!defined ('IN_PHPBB'))
{
	exit ();
}

if (empty ($lang) || !is_array ($lang))
{
	$lang = array();
}

// Social Login Frontend.
$lang = array_merge ($lang, array(
	'OA_SOCIAL_LOGIN_LINK_UCP' => 'Link social network accounts',
	'OA_SOCIAL_LOGIN_LINK' => 'Link social network accounts',
	'OA_SOCIAL_LOGIN_LINK_NETWORKS' => 'Social Networks',
	'OA_SOCIAL_LOGIN_LINK_DESC1' => 'On this page you can connect your social network accounts to your forum account.',
	'OA_SOCIAL_LOGIN_LINK_DESC2' => 'After having connected a social network account you can also use it to login to the forum.',
	'OA_SOCIAL_LOGIN_LINK_ACTION' => 'Click on the icon of social network to link/unlink.',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'You have to enable at least one social network',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'You have to setup your API credentials',
	'OA_SOCIAL_LOGIN_SOCIAL_LINK' => 'Social Link Service',
	'OA_SOCIAL_LOGIN_ACCOUNT_ALREADY_LINKED' => 'This social network account is already linked to another forum user.',
	'OA_SOCIAL_LOGIN_ACCOUNT_LINKED' => 'The social network account has been linked to your account.',
	'OA_SOCIAL_LOGIN_ACCOUNT_UNLINKED' => 'This social network account has been unlinked from your account.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_OTHER' => 'The account has been created. However, the forum settings require account activation.<br />An activation key has been sent to your email address.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_ADMIN' => 'The account has been created. However, the forum settings require account activation by an administrator.<br />An email has been sent to the administrators and you will be informed by email once your account has been activated.'
));
