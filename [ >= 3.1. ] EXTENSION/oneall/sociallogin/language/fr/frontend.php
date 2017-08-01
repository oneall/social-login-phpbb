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
 * French translations by Galixte
 * http://www.galixte.com
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
	'OA_SOCIAL_LOGIN_LINK_UCP' => 'Lier son compte avec les réseaux sociaux',
	'OA_SOCIAL_LOGIN_LINK' => 'Lier son compte avec réseaux sociaux',
	'OA_SOCIAL_LOGIN_LINK_NETWORKS' => 'Réseaux sociaux ',
	'OA_SOCIAL_LOGIN_LINK_DESC1' => 'Sur cette page il est possible de lier ses comptes des réseaux sociaux avec son compte existant sur le forum.',
	'OA_SOCIAL_LOGIN_LINK_DESC2' => 'Après avoir lié un compte de réseau social il est possible d’utiliser ce compte pour se connecter au forum.',
	'OA_SOCIAL_LOGIN_LINK_ACTION' => 'Cliquer sur l’icône du réseau social à lier / délier.',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Au moins un compte de réseau social doit être lié.',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Configurer ses certificats d’API.',
	'OA_SOCIAL_LOGIN_SOCIAL_LINK' => 'Service de liens sociaux (Social Link)',
	'OA_SOCIAL_LOGIN_ACCOUNT_ALREADY_LINKED' => 'Ce compte de réseau social est déjà lié avec un compte utilisateur du forum.',
	'OA_SOCIAL_LOGIN_ACCOUNT_LINKED' => 'Le compte de réseau social a été lié.',
	'OA_SOCIAL_LOGIN_ACCOUNT_UNLINKED' => 'Le compte de réseau social a été délié.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_OTHER' => 'Le compte a été crée. Cependant, les paramètres du forum nécessitent l’activation du compte.<br />Une clé d’activation a été envoyée à votre adresse e-mail.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_ADMIN' => 'Le compte a été crée. Cependant, les paramètres du forum nécessitent l’activation du compte par un administrateur.<br />Un e-mail a été envoyé aux administrateurs et vous serez informé par e-mail une fois que votre compte aura été activé.'
));
