<?php

/**
 * @package   	OneAll Social Login
 * @copyright 	Copyright 2014 http://www.oneall.com - All rights reserved.
 * @license   	GNU/GPL 2 or later
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
if (! defined ('IN_PHPBB'))
{
	exit ();
}

if (empty ($lang) || ! is_array ($lang))
{
	$lang = array ();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge ($lang, array (
	'OA_SOCIAL_LOGIN_SETTINGS' => 'Settings',
	'ACP_ONEALLSOCIALLOGIN' => 'OneAll Social Login',
	'OASL_DO_AVATARS' => 'Enable uploading avatars from social network?',
	'OASL_DO_AVATARS_DESC' => 'Allow retrieving the user\'s avatar from his social network profile and storing it in your phpBB avatar folder.',
	'OASL_DO_AVATARS_ENABLE_YES' => 'Yes, use social network avatars',
	'OASL_DO_AVATARS_ENABLE_NO' => 'No, do not use social network avatars',
	'OASL_PROFILE_TITLE' => 'Social Login',
	'OASL_PROFILE_DESC' => 'Link your account to a Social Network',
	'OASL_WIDGET_TITLE' => 'Login with a social network:',
	'OASL_SETTNGS_UPDATED' => 'Settings updated successfully.',
	'OASL_INTRO' => 'Allow your visitors to login and register with social networks like Twitter, Facebook, LinkedIn, Hyves, VKontakte, Google and Yahoo amongst others. Social Login <strong>increases your user registration rate</strong> by simplifying the registration process and provides permission-based social <strong>data retrieved from the social network profiles</strong>. Social Login integrates with your existing registration system so you and your users don\'t have to start from scratch.',
	'OASL_TITLE' => 'OneAll Social Login',
	'OASL_TITLE_HELP' => 'Help, Updates &amp; Documentation',
	'OASL_FOLLOW_US_TWITTER' => '<a href="http://www.twitter.com/oneall" class="external">Follow us</a> on Twitter to stay informed about updates;',
	'OASL_READ_DOCS' => '<a href="http://docs.oneall.com/plugins/" class="external">Read</a> the online documentation for more information about this plugin;',
	'OASL_DISCOVER_PLUGINS' => '<a href="http://docs.oneall.com/plugins/" class="external">Discover</a> our turnkey plugins for Drupal, Joomla, WordPress;',
	'OASL_GET_HELP' => '<a href="http://www.oneall.com/company/contact-us/" class="external">Contact us</a> if you have feedback or need assistance!',
	'OASL_CREATE_ACCOUNT_FIRST' => 'To be able to use Social Login, you first of all have to create a free account at <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a> and setup a Site.',
	'OASL_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Setup my free account</a>',
	'OASL_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Create and view my API Credentials</a>',
	'OASL_API_CONNECTION' => 'API connection',
	'OASL_API_CONNECTION_HANDLER' => 'API connection handler:',
	'OASL_CURL' => 'PHP CURL',
	'OASL_CURL_DESC' => 'Using CURL is recommended but it might be disabled on some servers.',
	'OASL_CURL_DOCS' => '<a href="http://www.php.net/manual/en/book.curl.php" class="external">CURL Manual</a>',
	'OASL_FSOCKOPEN' => 'PHP FSOCKOPEN',
	'OASL_FSOCKOPEN_DESC' => 'Only use FSOCKOPEN if you encounter any problems with CURL.',
	'OASL_FSOCKOPEN_DOCS' => '<a href="http://www.php.net/manual/en/function.fsockopen.php" class="external">FSOCKOPEN Manual</a>',
	'OASL_API_PORT' => 'API connection port:',
	'OASL_PORT_443' => 'Communication via HTTPS on port 443',
	'OASL_PORT_443_DESC' => 'Using port 443 is recommended but you might have to install OpenSSL on your server.',
	'OASL_PORT_80' => 'Communication via HTTP on port 80',
	'OASL_PORT_80_DESC' => 'Using port 80 is a bit faster, does not need OpenSSL but is less secure.',
	'OASL_API_AUTODETECT' => 'Autodetect API Connection',
	'OASL_API_CREDENTIALS_TITLE' => 'API credentials - <a href="https://app.oneall.com/applications/" class="external">Click here to create or view your API Credentials</a>',
	'OASL_API_SUBDOMAIN' => 'API subdomain:',
	'OASL_API_PUBLIC_KEY' => 'API public key:',
	'OASL_API_PRIVATE_KEY' => 'API private key:',
	'OASL_API_VERIFY' => 'Verify API Settings',
	'OASL_ENABLE_NETWORKS' => 'Enable the social networks/identity providers of your choice',
	'OASL_DO_ENABLE' => 'Enable Social Login?',
	'OASL_DO_ENABLE_DESC' => 'Allows you to temporarily disable Social Login without having to remove it.',
	'OASL_DO_ENABLE_YES' => 'Enable Social Login',
	'OASL_DO_ENABLE_NO' => 'Disable Social Login',
	'OASL_DEFAULT' => 'Default',
	'OASL_DO_LINKING' => 'Enable social network account linking?',
	'OASL_DO_LINKING_ASK' => 'Automatically link Social Network accounts to existing user accounts?',
	'OASL_DO_LINKING_DESC' => 'If enabled, social network accounts with a verified email address will be linked to existing phpBB user accounts having the same email address.',
	'OASL_DO_LINKING_YES' => 'Enable account linking',
	'OASL_DO_LINKING_NO' => 'Disable account linking',
	'OASL_DO_REDIRECT' => 'Setup redirection',
	'OASL_DO_REDIRECT_ASK' => 'Redirect users to this page after they have connected with their social network account:',
	'OASL_DO_REDIRECT_DESC' => 'Enter a full URL to a page of your phpBB. If left empty the user stays on the same page.',
	'OASL_API_DETECT_CURL' => 'Detected CURL on port %s - do not forget to save your changes!',
	'OASL_API_DETECT_FSOCKOPEN' => 'Detected FSOCKOPEN on Port %s - do not forget to save your changes!',
	'OASL_API_DETECT_NONE' => 'Connection failed! Your firewall must allow outbound request on either port 80 or 443.',
	'OASL_API_CREDENTIALS_FILL_OUT' => 'Please fill out each of the fields above.',
	'OASL_API_CREDENTIALS_USE_AUTO' => 'The connection handler does not seem to work. Please use the Autodetection.',
	'OASL_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'The subdomain does not exist. Have you filled it out correctly?',
	'OASL_API_CREDENTIALS_KEYS_WRONG' => 'The API credentials are wrong, please check your public/private key.',
	'OASL_API_CREDENTIALS_CHECK_COM' => 'Could not contact API. Is the API connection setup properly?',
	'OASL_API_CREDENTIALS_UNKNOW_ERROR' => 'Unknow response - please make sure that you are logged in!',
	'OASL_API_CREDENTIALS_OK' => 'The settings are correct - do not forget to save your changes!',
	'OASL_SETTINGS' => 'OneAll Social Login Settings',
	'OASL_ENABLE_SOCIAL_NETWORK' => 'You have to enable at least one social network',
	'OASL_ENTER_CREDENTIALS' => 'You have to setup your API credentials',
	'OASL_ACCOUNT_ALREADY_LINKED' => 'This social network account is already linked to another forum user.',
	'OASL_ACCOUNT_INACTIVE_OTHER' => 'The account has been created. However, the forum settings require account activation.<br />An activation key has been sent to your email address.',
	'OASL_ACCOUNT_INACTIVE_ADMIN' => 'The account has been created. However, the forum settings require account activation by an administrator.<br />An email has been sent to the administrators and you will be informed by email once your account has been activated.'
));
