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
	'OA_SOCIAL_LOGIN_ACP' => 'OneAll Social Login',
	'OA_SOCIAL_LOGIN_ACP_SETTINGS' => 'Settings',
	'OA_SOCIAL_LOGIN_API_AUTODETECT' => 'Autodetect API Connection',
	'OA_SOCIAL_LOGIN_API_CONNECTION' => 'API Connection',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER' => 'API Connection Handler',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER_DESC' => 'OneAll is a connexion manager to the API of the Social Medias',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_CHECK_COM' => 'Could not contact API. Is the API connection setup properly ?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_FILL_OUT' => 'Please fill out each of the fields above.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_KEYS_WRONG' => 'The API credentials are wrong, please check your public/private key.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_OK' => 'The settings are correct - do not forget to save your changes!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'The subdomain does not exist. Have you filled it out correctly ?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_TITLE' => 'API Credentials - <a href="https://app.oneall.com/applications/" class="external">Click here to create or view your API Credentials</a>',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_UNKNOW_ERROR' => 'Unknow response - please make sure that you are logged in!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_USE_AUTO' => 'The connection handler does not seem to work. Please use the Autodetection.',
	'OA_SOCIAL_LOGIN_API_DETECT_CURL' => 'Detected CURL on port %s - do not forget to save your changes!',
	'OA_SOCIAL_LOGIN_API_DETECT_FSOCKOPEN' => 'Detected FSOCKOPEN on Port %s - do not forget to save your changes!',
	'OA_SOCIAL_LOGIN_API_DETECT_NONE' => 'Connection failed! Your firewall must allow outbound request on either port 80 or 443.',
	'OA_SOCIAL_LOGIN_API_PORT' => 'API Connection Port',
	'OA_SOCIAL_LOGIN_API_PORT_DESC' => 'Your firewall must allow outgoing requests on either port 80 or 443.',
	'OA_SOCIAL_LOGIN_API_PRIVATE_KEY' => 'API Private Key',
	'OA_SOCIAL_LOGIN_API_PUBLIC_KEY' => 'API Public Key',
	'OA_SOCIAL_LOGIN_API_SUBDOMAIN' => 'API Subdomain',
	'OA_SOCIAL_LOGIN_API_VERIFY' => 'Verify API Settings',
	'OA_SOCIAL_LOGIN_CREATE_ACCOUNT_FIRST' => 'To be able to use Social Login, you first of all have to create a free account at <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a> and setup a Site.',
	'OA_SOCIAL_LOGIN_CURL' => 'PHP CURL',
	'OA_SOCIAL_LOGIN_CURL_DESC' => 'Using CURL is recommended but it might be disabled on some servers.',
	'OA_SOCIAL_LOGIN_CURL_DOCS' => '<a href="http://www.php.net/manual/en/book.curl.php" class="external">CURL Manual</a>',
	'OA_SOCIAL_LOGIN_DEFAULT' => 'Default',
	'OA_SOCIAL_LOGIN_DISCOVER_PLUGINS' => '<a href="http://docs.oneall.com/plugins/" class="external">Discover</a> our turnkey plugins for Drupal, Joomla, WordPress;',
	'OA_SOCIAL_LOGIN_DISPLAY_LOC' => 'Where do you want to display Social Login ?',
	'OA_SOCIAL_LOGIN_DO_AVATARS' => 'Enable uploading avatars from social network ?',
	'OA_SOCIAL_LOGIN_DO_AVATARS_DESC' => 'Allow retrieving the user’s avatar from his social network profile and storing it in your phpBB avatar folder.',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_NO' => 'No, do not use social network avatars',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_YES' => 'Yes, use social network avatars',
	'OA_SOCIAL_LOGIN_DO_ENABLE' => 'Enable Social Login ?',
	'OA_SOCIAL_LOGIN_DO_ENABLE_DESC' => 'Allows you to temporarily disable Social Login without having to remove it.',
	'OA_SOCIAL_LOGIN_DO_ENABLE_NO' => 'Disable',
	'OA_SOCIAL_LOGIN_DO_ENABLE_YES' => 'Enable',
	'OA_SOCIAL_LOGIN_DO_LINKING' => 'Enable social network account linking ?',
	'OA_SOCIAL_LOGIN_DO_LINKING_ASK' => 'Automatically link Social Network accounts to existing user accounts ?',
	'OA_SOCIAL_LOGIN_DO_LINKING_DESC' => 'If enabled, social network accounts with a verified email address will be linked to existing phpBB user accounts having the same email address.',
	'OA_SOCIAL_LOGIN_DO_LINKING_NO' => 'Disable account linking',
	'OA_SOCIAL_LOGIN_DO_LINKING_YES' => 'Enable account linking',
	'OA_SOCIAL_LOGIN_DO_REDIRECT' => 'Redirection',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_ASK' => 'Redirect users to this page after they have connected with their social network account',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_DESC' => 'Enter a full URL to a page of your phpBB. If left empty the user stays on the same page.',
	'OA_SOCIAL_LOGIN_DO_VALIDATION' => 'Prompt validation of new user’s profile ?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ALWAYS' => 'Enable profile validation',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ASK' => 'Prompt new users to validate username and email ?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DEPENDS' => 'Profile validation if necessary',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DESC' => 'If enabled, new users will be asked to complete or review their username and email address.<br /> The necessary validation only occurs in case the username is taken, the email address is missing or the email address is taken and Social Link is disabled.',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_NEVER' => 'Disable profile validation',
	'OA_SOCIAL_LOGIN_ENABLE_NETWORKS' => 'Choose the social networks to enable on your forum',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'You have to enable at least one social network',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'You have to setup your API credentials',
	'OA_SOCIAL_LOGIN_FOLLOW_US_TWITTER' => '<a href="http://www.twitter.com/oneall" class="external">Follow us</a> on Twitter to stay informed about updates;',
	'OA_SOCIAL_LOGIN_FSOCKOPEN' => 'PHP FSOCKOPEN',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DESC' => 'Only use FSOCKOPEN if you encounter any problems with CURL.',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DOCS' => '<a href="http://www.php.net/manual/en/function.fsockopen.php" class="external">FSOCKOPEN Manual</a>',
	'OA_SOCIAL_LOGIN_GET_HELP' => '<a href="http://www.oneall.com/company/contact-us/" class="external">Contact us</a> if you have feedback or need assistance!',
	'OA_SOCIAL_LOGIN_INDEX_PAGE' => 'Forum Homepage',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION' => 'Main page caption',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION_DESC' => 'This title is displayed above the Social Login icons on the main page.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE' => 'Display on the main page ?',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE_DESC' => 'If enabled, Social Login will be displayed on the main page.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_YES' => 'Yes, show on the main page',
	'OA_SOCIAL_LOGIN_INTRO' => 'Allow your visitors to login and register with social networks like Twitter, Facebook, LinkedIn, Hyves, VKontakte, Google and Yahoo amongst others. Social Login <strong>increases your user registration rate</strong> by simplifying the registration process and provides permission-based social <strong>data retrieved from the social network profiles</strong>. Social Login integrates with your existing registration system so you and your users don’t have to start from scratch.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE' => 'Forum Login Page',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION' => 'Login page caption',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION_DESC' => 'This title is displayed above the Social Login icons on the login page.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE' => 'Display on the login page ?',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE_DESC' => 'If enabled, Social Login will be displayed on the login page.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_YES' => 'Yes, show on the login page',
	'OA_SOCIAL_LOGIN_INLINE_PAGE' => 'Forum Login Page (inline with login form)',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION' => 'Inline login form caption',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION_DESC' => 'This title is displayed above the Social Login icons embedded inline on the login page.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE' => 'Display as inline form on the login page ?',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE_DESC' => 'If enabled, Social Login will be embedded as inline form on the login page. To enable the inline display you must select OneAll as authentication method in the GENERAL \ CLIENT COMMUNICATIONS \ AUTHENTICATION setting.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_YES' => 'Yes, show inline on the login page',
	'OA_SOCIAL_LOGIN_OTHER_PAGE' => 'Any Other Pages',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION' => 'Caption on other pages',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION_DESC' => 'This title is displayed above the Social Login icons on the other pages.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE' => 'Display on any other pages ?',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE_DESC' => 'If enabled, Social Login will also be displayed on any other pages of the forum.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_YES' => 'Yes, show on any other pages',
	'OA_SOCIAL_LOGIN_PORT_443' => 'Communication via HTTPS on port 443',
	'OA_SOCIAL_LOGIN_PORT_443_DESC' => 'Using port 443 is recommended but you might have to install OpenSSL on your server.',
	'OA_SOCIAL_LOGIN_PORT_80' => 'Communication via HTTP on port 80',
	'OA_SOCIAL_LOGIN_PORT_80_DESC' => 'Using port 80 is a bit faster, does not need OpenSSL but is less secure.',
	'OA_SOCIAL_LOGIN_PROFILE_DESC' => 'Link your account to a Social Network',
	'OA_SOCIAL_LOGIN_PROFILE_TITLE' => 'Social Login',
	'OA_SOCIAL_LOGIN_READ_DOCS' => '<a href="http://docs.oneall.com/plugins/guide/social-login-phpbb/3.1/" class="external">Read</a> the online documentation for more information about this plugin;',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE' => 'Forum Registration Page',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION' => 'Registration page caption',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION_DESC' => 'This title is displayed above the Social Login icons on the registration page.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE' => 'Display on the registration page ?',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE_DESC' => 'If enabled, Social Login will be displayed on the registration page.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_YES' => 'Yes, show on the registration page',
	'OA_SOCIAL_LOGIN_SETTINGS' => 'Settings',
	'OA_SOCIAL_LOGIN_SETTNGS_UPDATED' => 'Settings updated successfully.',
	'OA_SOCIAL_LOGIN_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Setup my free account</a>',
	'OA_SOCIAL_LOGIN_SOCIAL_LINK' => 'Social Link Service',
	'OA_SOCIAL_LOGIN_TITLE' => 'OneAll Social Login',
	'OA_SOCIAL_LOGIN_TITLE_HELP' => 'Help, Updates &amp; Documentation',
	'OA_SOCIAL_LOGIN_VALIDATION_FORM_DESC' => 'The administrator requires that you review or complete your username and email address.',
	'OA_SOCIAL_LOGIN_VALIDATION_FORM_HEADER' => 'Validate your username and email address',
	'OA_SOCIAL_LOGIN_VALIDATION_SESSION_ERROR' => 'Missing session information.',
	'OA_SOCIAL_LOGIN_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Create and view my API Credentials</a>',
	'OA_SOCIAL_LOGIN_WIDGET_TITLE' => 'Login with a social network',
	'G_OA_SOCIAL_LOGIN_REGISTER' => 'Registered OneAll users'
));
