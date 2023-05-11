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

// Social Login Frontend.
$lang = array_merge ($lang, array(
	'OA_SOCIAL_LOGIN_LINK_UCP' => 'Привязать аккаунт соц. сети',
	'OA_SOCIAL_LOGIN_LINK' => 'Привязать аккаунт соц. сети',
	'OA_SOCIAL_LOGIN_LINK_NETWORKS' => 'Соц. сети',
	'OA_SOCIAL_LOGIN_LINK_DESC1' => 'В этом разделе вы можете подключить аккаунт соц. сети к форумному аккаунту.',
	'OA_SOCIAL_LOGIN_LINK_DESC2' => 'После этого, вы сможете входить в этот аккаунт с помощью соц. сетей.',
	'OA_SOCIAL_LOGIN_LINK_ACTION' => 'Нажмите на иконку соц. сети, чтобы привязать/отвязать.',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Необходимо привязать хотя бы одну соц. сеть',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Необходимо указать данные API',
	'OA_SOCIAL_LOGIN_ACCOUNT_ALREADY_LINKED' => 'Этот аккаунт уже привязан к другому форумному аккаунту.',
	'OA_SOCIAL_LOGIN_ACCOUNT_LINKED' => 'Аккаунт соц. сети успешно привязан к этому форумному аккаунту.',
	'OA_SOCIAL_LOGIN_ACCOUNT_UNLINKED' => 'Аккаунт соц. сети успешно отвязан от этого форумного аккаунта.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_OTHER' => 'Аккаунт был создан.<br />Чтобы его активировать, пожалуйста, перейдите по ссылке, которая будет в письме почтового ящика, который вы указали.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_ADMIN' => 'Аккаунт был создан. Несмотря на это, политика форума требует предварительной активации вашего аккаунта администрацией форума.<br />Администрация уже была уведомлена и вы получите письмо в указанный почтовый ящик, когда ваш аккаунт будет активирован.'
));
