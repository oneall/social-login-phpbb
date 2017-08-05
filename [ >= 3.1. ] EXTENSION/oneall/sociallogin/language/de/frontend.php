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
if (! defined ('IN_PHPBB'))
{
	exit ();
}

if (empty ($lang) || ! is_array ($lang))
{
	$lang = array ();
}

// Social Login Frontend.
$lang = array_merge ($lang, array (
	'OA_SOCIAL_LOGIN_LINK_UCP' => 'Mit Social-Network Accounts verbinden',
	'OA_SOCIAL_LOGIN_LINK' => 'Mit Social-Network Accounts verbinden',
	'OA_SOCIAL_LOGIN_LINK_NETWORKS' => 'Soziale Netzwerke',
	'OA_SOCIAL_LOGIN_LINK_DESC1' => 'Auf dieser Seite kannst du deinen Forum-Account mit sozialen Netzwerken verbinden.',
	'OA_SOCIAL_LOGIN_LINK_DESC2' => 'Nachdem du deinen Account mit einem sozialen Netzwerk verbunden hast kannst du dieses auch zum Anmelden verwenden.',
	'OA_SOCIAL_LOGIN_LINK_ACTION' => 'Drücke auf das Icon des sozialen Netzwerks um es zu verbinden/trennen.',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Du musst mindestens ein soziales Netzwerk aktivieren',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Du musst deine API Daten einrichten',
	'OA_SOCIAL_LOGIN_SOCIAL_LINK' => 'Social Link Service',
	'OA_SOCIAL_LOGIN_ACCOUNT_ALREADY_LINKED' => 'Dieser Social-Network Account ist bereits mit einem anderen Benutzer verbunden.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_OTHER' => 'Der Account wurde angelegt. Wie auch immer, das Forum benötigt eine Account-Aktivierung per E-Mail.<br/>Ein Aktivierungsschlüssel wurde an deine E-Mail-Adresse gesendet.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_ADMIN' => 'Der Account wurde angelegt. Wie auch immer, das Forum benötigt eine Account-Aktivierung durch einen Admin.<br/>Ein E-Mail wurde an einen Admin gesendet und du wirst sobald der Account aktiviert wurde per E-Mail benachrichtigt.',
));
