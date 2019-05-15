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

/**
 * Polish translations by Rozwad
 * https://gwc.pl/forum
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
	'OA_SOCIAL_LOGIN_LINK_UCP' => 'Konta społecznościowe',
	'OA_SOCIAL_LOGIN_LINK' => 'Konta społecznościowe',
	'OA_SOCIAL_LOGIN_LINK_NETWORKS' => 'Media społecznościowe',
	'OA_SOCIAL_LOGIN_LINK_DESC1' => 'Na tej stronie możesz podłączyć lub odłączyć swoje konta społecznościowe do konta na forum.',
	'OA_SOCIAL_LOGIN_LINK_DESC2' => 'Po podłączeniu konta społecznościowego możesz także używać go do logowania się na forum.',
	'OA_SOCIAL_LOGIN_LINK_ACTION' => 'Kliknij na ikonę sieci społecznościowej aby podłączyć/odłączyć.',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Musisz włączyć przynajmniej jedno konto społecznościowe',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Musisz skonfigurować swoje dane uwierzytelniające do API',
	'OA_SOCIAL_LOGIN_ACCOUNT_ALREADY_LINKED' => 'To konto społecznościowe jest już podłączone do innego użytkownika tego forum.',
	'OA_SOCIAL_LOGIN_ACCOUNT_LINKED' => 'Konto społecznościowe zostało podłączone do twojego konta na forum.',
	'OA_SOCIAL_LOGIN_ACCOUNT_UNLINKED' => 'To konto społecznościowe zostało odłączone od twojego konta na forum.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_OTHER' => 'Konto zostało utworzone, jednak ustawienia forum wymagają aktywacji konta.<br />Klucz aktywacyjny został wysłany na twój adres email.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_ADMIN' => 'Konto zostało utworzone, jednak ustawienia forum wymagają aktywacji konta przez administratora.<br />Do administratora został wysłany email i zostaniesz poinformowany przez email, gdy twoje konto zostanie aktywowane.'
));
