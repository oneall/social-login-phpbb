<?php
/**
 * @package   	OneAll Social Login
 * @copyright 	Copyright 2011-Present https://www.oneall.com
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
 * https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 */

/**
 * Nederlandse vertaling door SpIdErPiGgY
 * https://www.amusementspaleis.online
 */
if (!defined ('IN_PHPBB'))
{
	exit ();
}

if (empty ($lang) || !is_array ($lang))
{
	$lang = array();
}

$lang = array_merge ($lang, array(
	'OA_SOCIAL_LOGIN_ACP_AUTH_SETTTING_INFO' => 'biedt de authenticatie met een gebruikersnaam/wachtwoord (Db Authenticatie) aan, evenals de login met een sociaal netwerk account. De verificatie van sociale netwerken kan worden ingesteld in EXTENSIES \ ONEALL SOCIALE LOGIN.',
));