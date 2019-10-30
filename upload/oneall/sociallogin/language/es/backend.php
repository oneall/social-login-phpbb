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

// Social Login Backend.
$lang = array_merge ($lang, array(
	// The G_ prefix is not a typo but required
	'G_OA_SOCIAL_LOGIN_REGISTER' => 'Usuarios registrados de OneAll',

	'OA_SOCIAL_LOGIN_CREATE_ACCOUNT_FIRST' => 'Para poder utilizar el inicio de sesión social, primero debe crear una cuenta gratuita en <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a> y configurar un sitio.',
	'OA_SOCIAL_LOGIN_DEFAULT' => 'Por defecto',
	'OA_SOCIAL_LOGIN_DISCOVER_PLUGINS' => '<a href="http://docs.oneall.com/plugins/" class="external">Descubra</a> nuestros plugins para Drupal, Joomla, WordPress.',
	'OA_SOCIAL_LOGIN_FOLLOW_US_TWITTER' => '<a href="http://www.twitter.com/oneall" class="external">Síganos</a> en Twitter para mantenerse informado sobre las actualizaciones.',
	'OA_SOCIAL_LOGIN_GET_HELP' => '¡<a href="http://www.oneall.com/company/contact-us/" class="external">Contáctenos</a> si necesita ayuda!',
	'OA_SOCIAL_LOGIN_READ_DOCS' => '<a href="http://docs.oneall.com/plugins/guide/social-login-phpbb/3.1/" class="external">Lea</a> la documentación en línea para obtener más información sobre este complemento.',
	'OA_SOCIAL_LOGIN_INTRO' => 'Permita que sus visitantes iniciar sesión y que se registren con redes sociales como Twitter, Facebook, LinkedIn, Hyves, VKontakte, Google y Yahoo entre otros. El Acceso Social <strong>aumenta la tasa de registro de usuarios</strong> simplificando el proceso de registro y proporcionando <strong>datos sociales recuperados de los perfiles de redes sociales</strong>. El Acceso Social se integra con su sistema de registro existente para que usted y sus usuarios no tengan que empezar desde cero.',
	'OA_SOCIAL_LOGIN_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Crear y ver mis credenciales de API</a>',
	'OA_SOCIAL_LOGIN_WIDGET_TITLE' => 'Iniciar sesión con una red social',

	'OA_SOCIAL_LOGIN_ACP' => 'Acceso Social OneAll',
	'OA_SOCIAL_LOGIN_ACP_SETTINGS' => 'Ajustes',

	'OA_SOCIAL_LOGIN_API_AUTODETECT' => 'Autodetección de la conexión de la API',
	'OA_SOCIAL_LOGIN_API_VERIFY' => 'Verificar ajustes de la API',

	'OA_SOCIAL_LOGIN_API_CONNECTION' => 'Conexión de la API',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER' => 'Controlador de conexión de la API',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER_DESC' => 'OneAll es un gestor de conexión de la API de las Medios Sociales.',

	'OA_SOCIAL_LOGIN_API_CREDENTIALS_CHECK_COM' => 'No se pudo contactar con la API. ¿La configuración de la API está correctamente configurada?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_FILL_OUT' => 'Por favor, rellene cada uno de los campos anteriores.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_KEYS_WRONG' => 'Las credenciales de la API están incorrectas, compruebe su clave pública/privada.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_OK' => 'Los ajustes son correctos - ¡No olvide guardar sus cambios!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'El subdominio no existe. ¿Lo ha rellenado correctamente?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_TITLE' => 'Credenciales de la API - <a href="https://app.oneall.com/applications/" class="external">Haga clic aquí para crear o ver sus credenciales de la API</a>',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_UNKNOW_ERROR' => 'Respuesta desconocida: asegúrese de haber iniciado sesión.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_USE_AUTO' => 'El controlador de conexión no parece funcionar. Utilice la Autodetección.',

	'OA_SOCIAL_LOGIN_API_DETECT_CURL' => 'CURL detectado en el puerto %s - ¡No olvide guardar sus cambios!',
	'OA_SOCIAL_LOGIN_API_DETECT_FSOCKOPEN' => 'FSOCKOPEN detectado en el puerto %s - ¡No olvide guardar sus cambios!',
	'OA_SOCIAL_LOGIN_API_DETECT_NONE' => '¡La conexión falló! Su cortafuegos debe permitir la solicitud de salida en el puerto 80 o 443.',

	'OA_SOCIAL_LOGIN_API_PORT' => 'Puerto de conexión de la API',
	'OA_SOCIAL_LOGIN_API_PORT_DESC' => 'El cortafuegos debe permitir las peticiones salientes en el puerto 80 o 443.',

	'OA_SOCIAL_LOGIN_API_PRIVATE_KEY' => 'Clave privada de la API',
	'OA_SOCIAL_LOGIN_API_PUBLIC_KEY' => 'Clave pública de la API',
	'OA_SOCIAL_LOGIN_API_SUBDOMAIN' => 'Subdominio de la API',

	'OA_SOCIAL_LOGIN_CURL' => 'PHP CURL',
	'OA_SOCIAL_LOGIN_CURL_DESC' => 'Se recomienda usar CURL, pero podría estar deshabilitado en algunos servidores.',
	'OA_SOCIAL_LOGIN_CURL_DOCS' => '<a href="http://www.php.net/manual/en/book.curl.php" class="external">Manual CURL</a>',

	'OA_SOCIAL_LOGIN_DISPLAY_LOC' => '¿Dónde desea mostrar el Acceso Social?',

	'OA_SOCIAL_LOGIN_DO_AVATARS' => '¿Habilitar la carga de avatares desde la red social?',
	'OA_SOCIAL_LOGIN_DO_AVATARS_DESC' => 'Permite recuperar el avatar del usuario desde su perfil de red social y almacenarlo en su carpeta de avatar de phpBB.',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_NO' => 'No, no utilizar avatares de redes sociales',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_YES' => 'Si, usar avatares de redes sociales',

	'OA_SOCIAL_LOGIN_DO_ENABLE' => '¿Habilitar Acceso Social?',
	'OA_SOCIAL_LOGIN_DO_ENABLE_DESC' => 'Le permite deshabilitar temporalmente el Acceso Social sin tener que eliminarlo.',
	'OA_SOCIAL_LOGIN_DO_ENABLE_NO' => 'Deshabilitar',
	'OA_SOCIAL_LOGIN_DO_ENABLE_YES' => 'Habilitar',

	'OA_SOCIAL_LOGIN_DO_LINKING' => '¿Habilitar la vinculación de cuentas de redes sociales?',
	'OA_SOCIAL_LOGIN_DO_LINKING_ASK' => '¿Conectar automáticamente las cuentas de redes sociales a cuentas de usuario existentes?',
	'OA_SOCIAL_LOGIN_DO_LINKING_DESC' => 'Si se habilita, las cuentas de redes sociales con una dirección de correo electrónico verificada, estarán vinculadas a las cuentas de usuario de phpBB existentes que tengan la misma dirección de correo electrónico.',
	'OA_SOCIAL_LOGIN_DO_LINKING_NO' => 'Deshabilitar la vinculación de cuentas',
	'OA_SOCIAL_LOGIN_DO_LINKING_YES' => 'Habilitar la vinculación de cuentas',

	'OA_SOCIAL_LOGIN_DO_REDIRECT' => 'Redirección',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_ASK' => 'Redireccionar a los usuarios a esta página después de haber conectado con su cuenta de red social',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_DESC' => 'Introduzca una URL completa a una página de su foro phpBB. Si se deja vacío, el usuario permanecerá en la misma página.',

	'OA_SOCIAL_LOGIN_DO_VALIDATION' => '¿Validación rápida del perfil del nuevo usuario?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ALWAYS' => 'Habilitar validación de perfil',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ASK' => '¿Solicitar a los nuevos usuarios validar el nombre de usuario y el correo electrónico?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DEPENDS' => 'Validación del perfil si es necesario',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DESC' => 'Si se habilita, se pedirá a los nuevos usuarios que completen o revisen su nombre de usuario y dirección de correo electrónico.<br /> La validación necesaria sólo se produce en caso de que el nombre de usuario se acepta, la dirección de correo electrónico falta, o la dirección de correo electrónico se acepta y Acceso Social está deshabilitado.',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_NEVER' => 'Deshabilitar validación de perfil',

	'OA_SOCIAL_LOGIN_ENABLE_NETWORKS' => 'Elija las redes sociales para habilitarlas en su foro',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Tiene que habilitar al menos una red social',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Tiene que configurar sus credenciales de la API',

	'OA_SOCIAL_LOGIN_FSOCKOPEN' => 'PHP FSOCKOPEN',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DESC' => 'Sólo use FSOCKOPEN si encuentra problemas con CURL.',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DOCS' => '<a href="http://www.php.net/manual/en/function.fsockopen.php" class="external">Manual FSOCKOPEN</a>',

	'OA_SOCIAL_LOGIN_INDEX_PAGE' => 'Página de inicio del foro',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION' => 'Título en la página principal',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION_DESC' => 'Este título se muestra encima de los iconos de Acceso Social en la página principal.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE' => '¿Mostrar en la página principal?',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE_DESC' => 'Si se habilita, el Acceso Social se mostrará en la página principal.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_YES' => 'Si, mostrar en la página principal',

	'OA_SOCIAL_LOGIN_LOGIN_PAGE' => 'Página de inicio de sesión del foro',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION' => 'Título de la página de inicio de sesión',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION_DESC' => 'Este título se muestra encima de los iconos de Acceso Social en la página de inicio de sesión.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE' => '¿Mostrar en la página de inicio de sesión?',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE_DESC' => 'Si se habilita, el Acceso Social se mostrará en la página de inicio de sesión.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_YES' => 'Si, mostrar en la página de inicio de sesión',

	'OA_SOCIAL_LOGIN_INLINE_PAGE' => 'Página de inicio de sesión del foro (en línea con el formulario de inicio de sesión)',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION' => 'En línea con el formulario',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION_DESC' => 'Este título se muestra encima de los iconos de Acceso Social incrustados en línea en la página de inicio de sesión.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE' => '¿Mostrar como un formulario en línea en la página de inicio de sesión?',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE_DESC' => 'Si se habilita, el Acceso Social se mostrará se incorporará como forma en línea en la página de inicio de sesión. Para habilitar la visualización en línea, debe seleccionar OneAll como método de autenticación en la configuración en GENERAL \ COMUNICACIÓN CLIENTE \ AUTENTIFICACIÓN.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_YES' => 'Si, mostrar en línea en la página de inicio de sesión',

	'OA_SOCIAL_LOGIN_OTHER_PAGE' => 'Otras páginas',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION' => 'Título en otras páginas',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION_DESC' => 'Este título se muestra encima de los iconos de Acceso Social en otras páginas.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE' => '¿Mostrar en otras páginas?',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE_DESC' => 'Si se habilita, el Acceso Social se mostrará también en cualquier otra página del foro.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_YES' => 'Si, mostrar en cualquier otra página',

	'OA_SOCIAL_LOGIN_PORT_443' => 'Comunicación vía HTTPS en el puerto 443',
	'OA_SOCIAL_LOGIN_PORT_443_DESC' => 'Se recomienda usar el puerto 443, pero es posible que tenga que instalar OpenSSL en su servidor.',
	'OA_SOCIAL_LOGIN_PORT_80' => 'Comunicación vía HTTP en el puerto 80',
	'OA_SOCIAL_LOGIN_PORT_80_DESC' => 'Usar el puerto 80 es un poco más rápido y no necesita OpenSSL, pero es menos seguro.',

	'OA_SOCIAL_LOGIN_PROFILE_DESC' => 'Vincular su cuenta a una red social',
	'OA_SOCIAL_LOGIN_PROFILE_TITLE' => 'Acceso Social',

	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE' => 'Forum Registration Page',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION' => 'Título en la página de registro',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION_DESC' => 'Este título se muestra encima de los iconos de Acceso Social en la página de registro.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE' => '¿Mostrar en la página de registro?',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE_DESC' => 'Si se habilita, el Acceso Social se mostrará en la página de registro.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_YES' => 'Si, mostrar en la página de registro',

	'OA_SOCIAL_LOGIN_SETTINGS' => 'Ajustes',
	'OA_SOCIAL_LOGIN_SETTINGS_UPDATED' => 'Settings updated successfully.',
	'OA_SOCIAL_LOGIN_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Configurar mi cuenta gratuita</a>',

	'OA_SOCIAL_LOGIN_TITLE' => 'Acceso Social OneAll',
	'OA_SOCIAL_LOGIN_TITLE_HELP' => 'Ayuda, actualizaciones y documentación',

	'OA_SOCIAL_LOGIN_VALIDATION_FORM_DESC' => 'El Administrador requiere que revise o complete su nombre de usuario y dirección de correo electrónico.',
	'OA_SOCIAL_LOGIN_VALIDATION_FORM_HEADER' => 'Validar su nombre de usuario y dirección de correo electrónico',
	'OA_SOCIAL_LOGIN_VALIDATION_SESSION_ERROR' => 'Falta información de la sesión.'
));