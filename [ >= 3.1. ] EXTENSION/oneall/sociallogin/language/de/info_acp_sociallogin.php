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
    'OA_SOCIAL_LOGIN_ACP_AUTH_SETTTING_INFO' => 'Erlaubt die Authentifizierung mit einem Benutzernamen und einem Passwort (Datenbank-Authentifizierung) sowie die Anmeldung über Accounts von sozialen Netzwerken. Die Authentifizierung über soziale Netzwerke kann unter EXTENSIONS \ ONEALL SOCIAL LOGIN eingerichtet werden.',
));

