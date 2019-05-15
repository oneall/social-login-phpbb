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
 * English translations by OneAll
 * http://www.oneall.com
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
$lang = array_merge ($lang, array (
	'OA_SOCIAL_LOGIN_LINK_UCP' => 'Link sociale netwerk accounts',
	'OA_SOCIAL_LOGIN_LINK' => 'Link sociale netwerk accounts',
	'OA_SOCIAL_LOGIN_LINK_NETWORKS' => 'Sociale Netwerken',
	'OA_SOCIAL_LOGIN_LINK_DESC1' => 'Op deze pagina kan je sociale netwerken verbinden met je forum account.',
	'OA_SOCIAL_LOGIN_LINK_DESC2' => 'Nadat je verbonden met met een sociaal netwerk kan je het ook gebruiken om in te loggen op deze website.',
	'OA_SOCIAL_LOGIN_LINK_ACTION' => 'Klik op het icoon van het sociale netwerk om te verbinden/verbreken.',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Je moet minstens 1 sociaal netwerk activeren',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Je moet een API sleutel aanmaken',
	'OA_SOCIAL_LOGIN_ACCOUNT_ALREADY_LINKED' => 'Dit sociaal netwerk is reeds gekoppeld aan een andere forum gebruiker.',
    'OA_SOCIAL_LOGIN_ACCOUNT_LINKED' => 'Het sociale netwerk account werd gekoppeld aan uw account.',
    'OA_SOCIAL_LOGIN_ACCOUNT_UNLINKED' => 'Dit sociale netwerk account werd losgekoppeld van uw account.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_OTHER' => 'Het account is aangemaakt, maar de forum instellingen vereisen nog een account activatie.<br>Een activeringscode is verzonden naar uw e-mailadres',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_ADMIN' => 'Het account is aangemaakt, maar de forum instellingen vereisen een account activatie door een beheerder.<br>Een e-mail is verzonden naar de beheerders en u wordt op de hoogte gebracht via e-mail zodra uw account is geactiveerd.',
));
