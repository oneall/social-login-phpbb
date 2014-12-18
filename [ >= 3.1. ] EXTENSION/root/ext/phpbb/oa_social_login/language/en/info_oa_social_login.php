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
if (! defined ('IN_PHPBB'))
{
	exit ();
}

if (empty ($lang) || ! is_array ($lang))
{
	$lang = array ();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge ($lang, array (
	'UCP_OA_SOCIAL_LINK' => 'Social Link',
	'OA_SOCIAL_LINK_DESC' => 'Connect one or more social networks to your forum account and then use the social networks to login to this forum.',
	'OA_SOCIAL_LINK_ACTION' => 'Click on the social network to link/unlink',

	'OASL_ENABLE_SOCIAL_NETWORK' => 'You have to enable at least one social network',
	'OASL_ENTER_CREDENTIALS' => 'You have to setup your API credentials',
	'OASL_SOCIAL_LINK' => 'Social Link Service',
	'OASL_ACCOUNT_ALREADY_LINKED' => 'This social network account is already linked to another forum user.',
	'OASL_ACCOUNT_INACTIVE_OTHER' => 'The account has been created. However, the forum settings require account activation.<br />An activation key has been sent to your email address.',
	'OASL_ACCOUNT_INACTIVE_ADMIN' => 'The account has been created. However, the forum settings require account activation by an administrator.<br />An email has been sent to the administrators and you will be informed by email once your account has been activated.'
));
