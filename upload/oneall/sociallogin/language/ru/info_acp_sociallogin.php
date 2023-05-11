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
 * Russian translations by livingflore
 * https://livingflore.me
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
	'OA_SOCIAL_LOGIN_ACP_AUTH_SETTTING_INFO' => 'Обеспечивает аутентификацию с помощью имени пользователя/пароля (Аутентификация Db) вместе с входом через соц. сеть. Вход через соц. сети может быть настроен в НАСТРОЙКА РАСШИРЕНИЙ > ВХОД ЧЕРЕЗ СОЦ. СЕТИ ONEALL > НАСТРОЙКИ.'
));