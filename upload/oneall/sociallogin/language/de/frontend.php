<?php
/**
 * @package   	OneAll Social Login
 * @copyright 	Copyright 2011-Present http://www.oneall.com
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

/**
 * German translations by GeorgH93
 * http://pcgamingfreaks.at
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
	'OA_SOCIAL_LOGIN_LINK_UCP' => 'Soziales Netzwerk Konto verknüpfen',
	'OA_SOCIAL_LOGIN_LINK' => 'Soziales Netzwerk Konto verknüpfen',
	'OA_SOCIAL_LOGIN_LINK_NETWORKS' => 'Soziale Netzwerke',
	'OA_SOCIAL_LOGIN_LINK_DESC1' => 'Auf dieser Seite kannst du dein Forum Benutzerkonto mit deinen Benutzerkonten bei sozialen Netzwerken verbinden.',
	'OA_SOCIAL_LOGIN_LINK_DESC2' => 'Nachdem du ein Benutzerkonto eines sozialen Netzwerks verknüpft hast, kannst du dieses auch benutzen um dich einzuloggen.',
	'OA_SOCIAL_LOGIN_LINK_ACTION' => 'Klicke auf das Icon des sozialen Netzwerks das du verbinden/trennen möchtest.',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Du musst mindestens ein soziales Netzwerk aktivieren',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Du musst deine API Daten einrichten',
	'OA_SOCIAL_LOGIN_ACCOUNT_ALREADY_LINKED' => 'Dieses Soziale-Netzwerk-Benutzerkonto ist bereits mit einem anderen Benutzer verknüpfen.',
	'OA_SOCIAL_LOGIN_ACCOUNT_LINKED' => 'Das Soziale-Netzwerk-Benutzerkonto wurde mit deinem Benutzerkonto verknüpft.',
	'OA_SOCIAL_LOGIN_ACCOUNT_UNLINKED' => 'Das Soziale-Netzwerk-Benutzerkonto wurde von deinem Benutzerkonto getrennt.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_OTHER' => 'Das Benutzerkonto wurde angelegt, du musst jedoch zunächst deine Email-Adresse bestätigen.<br />Ein Aktivierungsschlüssel wurde an deine EMail-Adresse gesendet.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_ADMIN' => 'Das Benutzerkonto wurde angelegt, es muss jedoch zunächst vom Forum Inhaber aktiviert werden.<br />Eine Email wurde an die Administratoren geschickt und du wirst ausserdem eine Email erhalten sobald dein Konto aktiviert wurde.'
));
