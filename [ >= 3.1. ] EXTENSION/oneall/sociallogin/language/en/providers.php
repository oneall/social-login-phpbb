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

// Social Login Providers.
$lang = array_merge ($lang, array(
	'OA_SOCIAL_LOGIN_P_AMAZON' => 'Amazon',
	'OA_SOCIAL_LOGIN_P_BATTLENET' => 'Battle.net',
	'OA_SOCIAL_LOGIN_P_BLOGGER' => 'Blogger',
	'OA_SOCIAL_LOGIN_P_STORAGE' => 'Cloud Storage',
	'OA_SOCIAL_LOGIN_P_DISQUS' => 'Disqus',
	'OA_SOCIAL_LOGIN_P_DRAUGIEM' => 'Draugiem',
	'OA_SOCIAL_LOGIN_P_DRIBBBLE' => 'Dribbble',
	'OA_SOCIAL_LOGIN_P_FACEBOOK' => 'Facebook',
	'OA_SOCIAL_LOGIN_P_FOURSQUARE' => 'Foursquare',
	'OA_SOCIAL_LOGIN_P_GITHUBCOM' => 'Github.com',
	'OA_SOCIAL_LOGIN_P_GOOGLE' => 'Google',
	'OA_SOCIAL_LOGIN_P_INSTAGRAM' => 'Instagram',
	'OA_SOCIAL_LOGIN_P_LINE' => 'Line',
	'OA_SOCIAL_LOGIN_P_LINKEDIN' => 'LinkedIn',
	'OA_SOCIAL_LOGIN_P_LIVEJOURNAL' => 'LiveJournal',
	'OA_SOCIAL_LOGIN_P_MAILRU' => 'Mail.ru',
	'OA_SOCIAL_LOGIN_P_MEETUP' => 'Meetup',
	'OA_SOCIAL_LOGIN_P_ODNOKLASSNIKI' => 'Odnoklassniki',
	'OA_SOCIAL_LOGIN_P_OPENID' => 'OpenID',
	'OA_SOCIAL_LOGIN_P_PAYPAL' => 'PayPal',
	'OA_SOCIAL_LOGIN_P_PINTEREST' => 'Pinterest',
	'OA_SOCIAL_LOGIN_P_PIXELPIN' => 'PixelPin',
	'OA_SOCIAL_LOGIN_P_REDDIT' => 'Reddit',
	'OA_SOCIAL_LOGIN_P_SKYROCKCOM' => 'Skyrock.com',
	'OA_SOCIAL_LOGIN_P_SOUNDCLOUD' => 'SoundCloud',
	'OA_SOCIAL_LOGIN_P_STACKEXCHANGE' => 'StackExchange',
	'OA_SOCIAL_LOGIN_P_STEAM' => 'Steam',
	'OA_SOCIAL_LOGIN_P_TWITCHTV' => 'Twitch.tv',
	'OA_SOCIAL_LOGIN_P_TWITTER' => 'Twitter',
	'OA_SOCIAL_LOGIN_P_VIMEO' => 'Vimeo',
	'OA_SOCIAL_LOGIN_P_VKONTAKTE' => 'VKontakte',
	'OA_SOCIAL_LOGIN_P_WINDOWSLIVE' => 'Windows Live',
	'OA_SOCIAL_LOGIN_P_WORDPRESSCOM' => 'WordPress.com',
	'OA_SOCIAL_LOGIN_P_XING' => 'XING',
	'OA_SOCIAL_LOGIN_P_YAHOO' => 'Yahoo',
	'OA_SOCIAL_LOGIN_P_YOUTUBE' => 'YouTube'
));
