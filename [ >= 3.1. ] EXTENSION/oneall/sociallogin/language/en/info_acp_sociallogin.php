<?php
/**
 *
 * Active User Birthdays. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, RTS Software
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
    'OA_SOCIAL_LOGIN_ACP_AUTH_SETTTING_INFO' => 'Provides the authentication with a username/password (Db Authentication) as well as the login with a social network account. The social network authentication can be setup in EXTENSIONS \ ONEALL SOCIAL LOGIN.',
));

