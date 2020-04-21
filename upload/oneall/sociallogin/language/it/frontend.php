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
 * Italian translations by EugyRdT
 * https://forumanicomio.eugy.it
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
	'OA_SOCIAL_LOGIN_LINK_UCP' => 'Collega account dei social networks',
	'OA_SOCIAL_LOGIN_LINK' => 'Collega account dei social networks',
	'OA_SOCIAL_LOGIN_LINK_NETWORKS' => 'Social Networks',
	'OA_SOCIAL_LOGIN_LINK_DESC1' => 'In questa pagina puoi connettere il tuo account social al tuo account del forum.',
	'OA_SOCIAL_LOGIN_LINK_DESC2' => 'Dopo aver collegato il tuo account social puoi anche usarlo per accedere al forum.',
	'OA_SOCIAL_LOGIN_LINK_ACTION' => 'Clicca sulla icona del social network per collegarlo/scollegarlo.',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Devi abilitare almeno un social network',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Devi impostare le tue credenziali API',
	'OA_SOCIAL_LOGIN_ACCOUNT_ALREADY_LINKED' => 'Questo account social è già collegato ad un altro utente del forum.',
	'OA_SOCIAL_LOGIN_ACCOUNT_LINKED' => 'Questo account social è stato collegato al tuo account del forum.',
	'OA_SOCIAL_LOGIN_ACCOUNT_UNLINKED' => 'Questo account social è stato scollegato dal tuo account del forum.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_OTHER' => 'Account creato! Comunque le impostazioni del forum richiedono una attivazione.<br />Una chiave di attivazione viene mandata alla tua email.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_ADMIN' => 'Account creato! Comunque le impostazioni del forum richiedono una attivazione da parte di un amministratore.<br />Una email viene mandata agli amministratori e tu sarai informato via email ad attivazione avvenuta.'
));
