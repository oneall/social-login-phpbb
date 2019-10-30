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
 * Spanisch translations ThE KuKa (Raúl Arroyo)
 * http://www.phpbb-es.com
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
	'OA_SOCIAL_LOGIN_LINK_UCP' => 'Enlazar cuentas de redes sociales',
	'OA_SOCIAL_LOGIN_LINK' => 'Enlazar cuentas de redes sociales',
	'OA_SOCIAL_LOGIN_LINK_NETWORKS' => 'Redes Sociales',
	'OA_SOCIAL_LOGIN_LINK_DESC1' => 'En esta página puede conectar sus cuentas de redes sociales a su cuenta del foro.',
	'OA_SOCIAL_LOGIN_LINK_DESC2' => 'Después de haber conectado una cuenta de red social, también puede usarla para iniciar sesión en el foro.',
	'OA_SOCIAL_LOGIN_LINK_ACTION' => 'Haga clic en el icono de la red social para vincular/desvincular.',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Tiene que habilitar al menos una red social',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Tiene que configurar sus credenciales de API',
	'OA_SOCIAL_LOGIN_ACCOUNT_ALREADY_LINKED' => 'Esta cuenta de red social ya está vinculada a otro usuario del foro.',
	'OA_SOCIAL_LOGIN_ACCOUNT_LINKED' => 'La cuenta de la red social se ha vinculado a su cuenta.',
	'OA_SOCIAL_LOGIN_ACCOUNT_UNLINKED' => 'Esta cuenta de red social se ha desvinculado de su cuenta.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_OTHER' => 'La cuenta ha sido creada. Sin embargo, la configuración del foro requiere la activación de la cuenta.<br />Se ha enviado una clave de activación a su dirección de correo electrónico.',
	'OA_SOCIAL_LOGIN_ACCOUNT_INACTIVE_ADMIN' => 'La cuenta ha sido creada. Sin embargo, la configuración del foro requiere la activación de la cuenta por un Administrador.<br />Se ha enviado un correo electrónico a los Administradores y se le informará por correo electrónico una vez que se haya activado su cuenta.'
));
