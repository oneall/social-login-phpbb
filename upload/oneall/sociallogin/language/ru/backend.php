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

// Social Login Backend.
$lang = array_merge ($lang, array(
	// The G_ prefix is not a typo but required
	'G_OA_SOCIAL_LOGIN_REGISTER' => 'Зарегистрированные пользователи OneAll',
	
	'OA_SOCIAL_LOGIN_CREATE_ACCOUNT_FIRST' => 'Чтобы использовать вход через соц. сети, необходимо сначала создать бесплатный аккаунт на <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a>.',
	'OA_SOCIAL_LOGIN_DEFAULT' => 'По умолчанию',
	'OA_SOCIAL_LOGIN_DISCOVER_PLUGINS' => '<a href="http://docs.oneall.com/plugins/" class="external">Узнайте</a> о наших плагинах под ключ для Drupal, Joomla, WordPress ...',
	'OA_SOCIAL_LOGIN_FOLLOW_US_TWITTER' => '<a href="http://www.twitter.com/oneall" class="external">Подписывайтесь</a> на наш Twitter чтобы быть в курсе обновлений;',
	'OA_SOCIAL_LOGIN_GET_HELP' => '<a href="https://support.oneall.com/forums/" class="external">Свяжитесь с нами</a> если у вас есть отзыв или вам нужна помощь!',
	'OA_SOCIAL_LOGIN_READ_DOCS' => '<a href="http://docs.oneall.com/plugins/guide/social-login-phpbb/3.1/" class="external">Прочитайте</a> онлайн документацию для большей информации об этом плагине;',
	'OA_SOCIAL_LOGIN_INTRO' => 'Позвольте вашим участникам входить и регистрироваться с помощью соц. сетей, таких как Twitter, Facebook, LinkedIn, ВКонтакте, Google и Yahoo среди их множества. Вход с помощью соц. сетей <strong>повышает кол-во регистрируемых пользователей</strong> с помощью упрощения процесса регистрации и обеспечивает <strong>информацией, получаемой из профилей соц. сетей</strong> (на основе предоставленных разрешений). Вход с помощью соц. сетей интегрируется с уже существующей формой регистрации, так что у вас и ваших пользователей нет необходимости создавать всё заново.',
	'OA_SOCIAL_LOGIN_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Создать и/или просмотреть данные API</a>',
	'OA_SOCIAL_LOGIN_WIDGET_TITLE' => 'Вход с помощью соц. сетей',

	'OA_SOCIAL_LOGIN_ACP' => 'Вход. с помощью соц. сетей OneAll',
	'OA_SOCIAL_LOGIN_ACP_SETTINGS' => 'Настройки',

	'OA_SOCIAL_LOGIN_API_AUTODETECT' => 'Автоматически обнаружить API соединение',
	'OA_SOCIAL_LOGIN_API_VERIFY' => 'Верифицировать (проверить) настройки API',

	'OA_SOCIAL_LOGIN_API_CONNECTION' => 'API Соединение',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER' => 'Хендлер API соединения',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER_DESC' => 'Здесь необходимо выбрать, как ваш сервер будет связываться с сервисом интеграции соц. сетей OneAll.',

	'OA_SOCIAL_LOGIN_API_CREDENTIALS_CHECK_COM' => 'Не могу связаться с API. Пожалуйста, уточните - настроено ли API соединение правильно?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_FILL_OUT' => 'Пожалуйста, заполните все поля выше.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_KEYS_WRONG' => 'API данные для входа неверны, пожалуйста, перепроверьте ваш публичный/приватный ключ.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_OK' => 'Все настройки верны - не забудьте сохранить ваши изменения!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'Субдомен не существует. Пожалуйста, уточните - правильно ли вы его ввели?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_TITLE' => 'API данные для входа - <a href="https://app.oneall.com/applications/" class="external">Нажмите здесь, чтобы создать или посмотреть ваши API данные для входа</a>',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_UNKNOW_ERROR' => 'Неизвестная ошибка - пожалуйста, убедитесь что вы авторизованы!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_USE_AUTO' => 'Похоже, хендлер соединения не работает. Пожалуйста, используйте автоматическое обнаружение API соединения.',

	'OA_SOCIAL_LOGIN_API_DETECT_CURL' => 'Обнаружен CURL на порту %s - не забудьте сохранить ваши изменения!',
	'OA_SOCIAL_LOGIN_API_DETECT_FSOCKOPEN' => 'Обнаружен FSOCKOPEN на порту %s - не забудьте сохранить ваши изменения!',
	'OA_SOCIAL_LOGIN_API_DETECT_NONE' => 'Соединение не удалось! Ваш firewall должен быть настроен на разрешение исходящих запросов на порту 80 или 443.',

	'OA_SOCIAL_LOGIN_API_PORT' => 'Порт API соединения',
	'OA_SOCIAL_LOGIN_API_PORT_DESC' => 'Ваш firewall должен быть настроен на разрешение исходящих запросов на порту 80 и/или 443.',

	'OA_SOCIAL_LOGIN_API_PRIVATE_KEY' => 'API Приватный ключ (Private Key)',
	'OA_SOCIAL_LOGIN_API_PUBLIC_KEY' => 'API Публичный ключ (Public Key)',
	'OA_SOCIAL_LOGIN_API_SUBDOMAIN' => 'API Субдомен (Subdomen)',

	'OA_SOCIAL_LOGIN_CURL' => 'PHP CURL',
	'OA_SOCIAL_LOGIN_CURL_DESC' => 'Использование CURL рекомендовано, но оно может быть отключено на некоторых серверах.',
	'OA_SOCIAL_LOGIN_CURL_DOCS' => '<a href="http://www.php.net/manual/ru/book.curl.php" class="external">Инструкция по CURL</a>',

	'OA_SOCIAL_LOGIN_DISPLAY_LOC' => 'Где вы хотите, чтобы отображалось поле входа через соц.сеть?',

	'OA_SOCIAL_LOGIN_DO_AVATARS' => 'Включить загрузку аватаров из соц. сетей?',
	'OA_SOCIAL_LOGIN_DO_AVATARS_DESC' => 'Разрешить получение аватарки пользователя из его профиля соц. сети и хранить ее в вашей папке phpBB.',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_NO' => 'Нет, не использовать аватарку из соц. сети',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_YES' => 'Да, использовать аватарку из соц. сети',

	'OA_SOCIAL_LOGIN_DO_ENABLE' => 'Включить вход через соц. сети?',
	'OA_SOCIAL_LOGIN_DO_ENABLE_DESC' => 'Позволяет вам временно выключить вход через соц. сети без полного удаления плагина.',
	'OA_SOCIAL_LOGIN_DO_ENABLE_NO' => 'Выключить',
	'OA_SOCIAL_LOGIN_DO_ENABLE_YES' => 'Включить',

	'OA_SOCIAL_LOGIN_DO_LINKING' => 'Включить привязку аккаунта соц. сети?',
	'OA_SOCIAL_LOGIN_DO_LINKING_ASK' => 'Автоматически привязывать аккаунт соц. сети к существующим пользователям?',
	'OA_SOCIAL_LOGIN_DO_LINKING_DESC' => 'Если включено, аккаунт соц. сети с подтвержденным почтовым ящиком будет привязан к существующему аккаунту phpBB, если тот будет иметь идентичный адрес.',
	'OA_SOCIAL_LOGIN_DO_LINKING_NO' => 'Выключить привязку аккаунта',
	'OA_SOCIAL_LOGIN_DO_LINKING_YES' => 'Включить привязку аккаунта',

	'OA_SOCIAL_LOGIN_DO_REDIRECT' => 'Переадресация',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_ASK' => 'Переадресовывать пользователей на эту страницу, после того как они зарегистрировались/вошли с помощью аккаунта соц. сети',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_DESC' => 'Укажите полную ссылку на страницу вашего phpBB. Если ссылку не указать, то пользователь будет оставаться на той же странице.',

	'OA_SOCIAL_LOGIN_DO_VALIDATION' => 'Вызывать окно валидации профиля нового пользователя?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ALWAYS' => 'Включить валидацию профиля',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ASK' => 'Вызывать окно валидации имени пользователя и почтового ящика?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DEPENDS' => 'Вызывать валидацию по необходимости',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DESC' => 'Если включено, новые пользователи перед регистрацией аккаунта на форуме смогут перепроверить имя пользователя и почтовый ящик.<br /> Валдиация по необходимости вызывается только тогда, когда имя пользователя уже занято, отсутствует почтовый ящик или почтовый ящик занят и он не привязан ни к какому аккаунту.',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_NEVER' => 'Выключить валидацию профиля',

	'OA_SOCIAL_LOGIN_ENABLE_NETWORKS' => 'Выберите соц. сети, через которые будет осуществляться вход на вашем форуме',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Необходимо выбрать хотя бы одну соц. сеть',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Вам необходимо настроить API данные для входа',

	'OA_SOCIAL_LOGIN_FSOCKOPEN' => 'PHP FSOCKOPEN',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DESC' => 'Используйте FSOCKOPEN только если у вас возникли какие-то проблемы с CURL.',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DOCS' => '<a href="https://www.php.net/manual/ru/function.fsockopen.php" class="external">Инструкция по FSOCKOPEN</a>',

	'OA_SOCIAL_LOGIN_INDEX_PAGE' => 'Главная страница форума',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION' => 'Заголовок на главной странице',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION_DESC' => 'Этот текст будет отображаться над полем входа через соц. сети на главной странице.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE' => 'Отображать на главной странице ?',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE_DESC' => 'Если включено, вход через соц. сети будет отображаться на главной странице.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_NO' => 'Нет',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_YES' => 'Да, показывать на главной странице',

	'OA_SOCIAL_LOGIN_LOGIN_PAGE' => 'Страница входа',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION' => 'Заголовок страницы входа',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION_DESC' => 'Этот текст будет отображаться над полем входа через соц. сети на странице входа.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE' => 'Отображать на странице входа ?',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE_DESC' => 'Если включено, вход через соц. сети будет отображаться на странице входа.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_NO' => 'Нет',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_YES' => 'Да, показывать на странице входа',

	'OA_SOCIAL_LOGIN_INLINE_PAGE' => 'Страница входа (отображение под окном входа - inline)',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION' => 'Заголовок поля для входа',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION_DESC' => 'Этот текст будет отображаться над полем для входа через соц. сети, которое будет встроено под окно входа (inline).',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE' => 'Отображать поле для входа через соц. сети под окном входа (inline) ?',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE_DESC' => 'Если включено, вход через соц. сети будет отображаться как встроенное поле под основным окном входа (inline). Чтобы включить, необходимо выбрать OneAll в качестве метода аутентификации в ОБЩИЕ > СРЕДСТВА СВЯЗИ > АУТЕНТИФИКАЦИЯ.',

	'OA_SOCIAL_LOGIN_INLINE_PAGE_NO' => 'Нет',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_YES' => 'Да, показывать поле для входа (inline)',

	'OA_SOCIAL_LOGIN_OTHER_PAGE' => 'Любые другие страницы',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION' => 'Заголовок на других страницах',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION_DESC' => 'Этот текст будет отображаться над полем входа через соц. сети на любых других страницах форума.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE' => 'Отображать на любых других страницах ?',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE_DESC' => 'Если включено, вход через соц. сети будет так же отображаться на любых других страницах форума.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_NO' => 'Нет',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_YES' => 'Да, показывать на любых других страницах',

	'OA_SOCIAL_LOGIN_PORT_443' => 'Коммуникация чере порт 443/HTTPS',
	'OA_SOCIAL_LOGIN_PORT_443_DESC' => 'Использование порта 443 рекомендовано, но возможно вам будет необходимо установить OpenSSL на ваш сервер (предустановлен на большинстве актуальных дистрибутивов).',
	'OA_SOCIAL_LOGIN_PORT_80' => 'Коммуниация через порт 80/HTTP',
	'OA_SOCIAL_LOGIN_PORT_80_DESC' => 'Использование порта 80 чуть быстрее, но оно не поддерживает сертификат SSL и крайне небезопасно.',

	'OA_SOCIAL_LOGIN_PROFILE_DESC' => 'Привязать ваш аккаунт к соц. сети',
	'OA_SOCIAL_LOGIN_PROFILE_TITLE' => 'Вход через соц. сеть',

	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE' => 'Страница регистрации форума',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION' => 'Заголовок страницы регистрации',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION_DESC' => 'This title is displayed above the Social Login icons on the registration page.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE' => 'Display on the registration page ?',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE_DESC' => 'Этот текст будет отображаться над полем входа через соц. сети на странице регистрации форума.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_NO' => 'Нет',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_YES' => 'Да, показывать на странице регистрации',

	'OA_SOCIAL_LOGIN_SETTINGS' => 'Настройки',
	'OA_SOCIAL_LOGIN_SETTINGS_UPDATED' => 'Настройки успешно обновлены..',
	'OA_SOCIAL_LOGIN_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Зарегистрировать бесплатный аккаунт</a>',

	'OA_SOCIAL_LOGIN_TITLE' => 'Вход через соц. сети OneAll',
	'OA_SOCIAL_LOGIN_TITLE_HELP' => 'Помощь, обновления &amp; документация',

	'OA_SOCIAL_LOGIN_VALIDATION_FORM_DESC' => 'Администрация форума обязывает вас перепроверить ваше имя и почту перед регистрацией.',
	'OA_SOCIAL_LOGIN_VALIDATION_FORM_HEADER' => 'Подтвердить ваше имя и адрес почты',
	'OA_SOCIAL_LOGIN_VALIDATION_SESSION_ERROR' => 'Отсутствует информация сессии.'
));
