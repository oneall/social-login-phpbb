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
 * German translations by GeorgH93
 * http://pcgamingfreaks.at
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
	'G_OA_SOCIAL_LOGIN_REGISTER' => 'Registrierungen über OneAll',

	'OA_SOCIAL_LOGIN_CREATE_ACCOUNT_FIRST' => 'Um dieses Plugin nutzen zu können, musst du zunächst ein kostenloses Benutzerkonto bei <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a> anmelden.',
	'OA_SOCIAL_LOGIN_DEFAULT' => 'Standard',
	'OA_SOCIAL_LOGIN_DISCOVER_PLUGINS' => 'Entdecke unsere <a href="http://docs.oneall.com/plugins/" class="external">anderen Plugins</a> für Drupal, Joomla, WordPress ...',
	'OA_SOCIAL_LOGIN_FOLLOW_US_TWITTER' => 'Folge uns auf <a href="http://www.twitter.com/oneall" class="external">Twitter</a>, um über Updates informiert zu werden.',
	'OA_SOCIAL_LOGIN_GET_HELP' => '<a href="https://support.oneall.com/forums/" class="external">Kontaktiere uns</a> wenn du Feedback hast oder unsere Hilfe benötigst!',
	'OA_SOCIAL_LOGIN_READ_DOCS' => 'Lies unsere <a href="http://docs.oneall.com/plugins/guide/social-login-phpbb/3.1/" class="external">online Dokumentation</a> für mehr Informationen zu diesem Plugin.',
	'OA_SOCIAL_LOGIN_INTRO' => 'Erlaube es deinen Besuchern sich mittels Twitter, Facebook, LinkedIn, VKontakte, Google und Yahoo und anderen zu registrieren und anzumelden. Social Login <strong>erhöht die Benutzer-Registrierungsrate</strong> indem es den Registrierungsprozess vereinfacht, und <strong>liefert die Profil-Daten der Nutzer</strong> die sich mit sozialen Netzwerken einloggen. Social Login integriert sich in das bestehende Registrierungssystem sodass du und die Nutzer deines Forums sich nicht umstellen müssen.',
	'OA_SOCIAL_LOGIN_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Mein API Daten erstellen und/oder anzeigen</a>',
	'OA_SOCIAL_LOGIN_WIDGET_TITLE' => 'Mit einem sozialen Netzwerk anmelden',

	'OA_SOCIAL_LOGIN_ACP' => 'OneAll Social Login',
	'OA_SOCIAL_LOGIN_ACP_SETTINGS' => 'Einstellungen',

	'OA_SOCIAL_LOGIN_API_AUTODETECT' => 'API Verbindung automatisch ermitteln',
	'OA_SOCIAL_LOGIN_API_VERIFY' => 'API Daten überprüfen',

	'OA_SOCIAL_LOGIN_API_CONNECTION' => 'API Verbindung',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER' => 'API Bibliothek',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER_DESC' => 'Hier legst du fest, wie dein Forum mit der OneAll Schnittstelle kommuniziert.',

	'OA_SOCIAL_LOGIN_API_CREDENTIALS_CHECK_COM' => 'Die OneAll API konnte nicht kontaktiert werden. Sind die API Einstellungen richtig?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_FILL_OUT' => 'Bitte fülle jedes der oben angeführten Felder aus.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_KEYS_WRONG' => 'Die API Anmeldedaten sind falsch, bitte überprüfe deinen Public/Private Key.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_OK' => 'Die Einstellungen sind korrekt - vergiss nicht sie zu speichern!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'Die Subdomain existiert nicht. Hast du sie richtig ausgefüllt?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_TITLE' => 'API Daten - <a href="https://app.oneall.com/applications/" class="external">Klicke hier, um deine API Daten zu erstellen und/oder anzuzeigen</a>',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_UNKNOW_ERROR' => 'Unbekannte Antwort - bitte vergewissere dich, dass du eingeloggt bist!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_USE_AUTO' => 'Der API Verbindungs scheint nicht zu funktionieren. Bitte benutzte die automatische Erkennung.',

	'OA_SOCIAL_LOGIN_API_DETECT_CURL' => 'CURL auf Port %s erkannt - vergiss nicht deine Änderungen zu speichern!',
	'OA_SOCIAL_LOGIN_API_DETECT_FSOCKOPEN' => 'FSOCKOPEN auf Port %s erkannt - vergiss nicht deine Änderungen zu speichern!',
	'OA_SOCIAL_LOGIN_API_DETECT_NONE' => 'Verbindung fehlgeschlagen! Deine Firewall muss ausgehende Anfragen auf Port 80 oder 443 zulassen.',

	'OA_SOCIAL_LOGIN_API_PORT' => 'API Port',
	'OA_SOCIAL_LOGIN_API_PORT_DESC' => 'Deine Firewall muss ausgehende Anfragen auf Port 80 und/oder 443 zulassen.',

	'OA_SOCIAL_LOGIN_API_PRIVATE_KEY' => 'API Private Key',
	'OA_SOCIAL_LOGIN_API_PUBLIC_KEY' => 'API Public Key',
	'OA_SOCIAL_LOGIN_API_SUBDOMAIN' => 'API Subdomain',

	'OA_SOCIAL_LOGIN_CURL' => 'PHP CURL',
	'OA_SOCIAL_LOGIN_CURL_DESC' => 'Es wird empfohlen CURL zu verwenden. CURL ist aber nicht auf allen Servern installiert und aktiviert.',
	'OA_SOCIAL_LOGIN_CURL_DOCS' => '<a href="http://www.php.net/manual/en/book.curl.php" class="external">CURL Anleitung</a>',

	'OA_SOCIAL_LOGIN_DISPLAY_LOC' => 'Wo willst du Social Login anzeigen?',

	'OA_SOCIAL_LOGIN_DO_AVATARS' => 'Upload der Avatare der sozialen Netzwerke aktivieren?',
	'OA_SOCIAL_LOGIN_DO_AVATARS_DESC' => 'Falls aktiviert, werden die Avatare aus den Benutzerkonten der sozialen Netzwerks ausgelesen, im phpBB Avatare Order gespeichert, und als Avatare der Benutzer die sich anmelden verwendet.',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_NO' => 'Deaktiveren',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_YES' => 'Avatare von sozialen Netzwerken aktivieren',

	'OA_SOCIAL_LOGIN_DO_ENABLE' => 'Social Login aktivieren?',
	'OA_SOCIAL_LOGIN_DO_ENABLE_DESC' => 'Erlaubt es dir, das Social Login Plugin temporär zu deaktivieren, ohne es löschen zu müssen.',
	'OA_SOCIAL_LOGIN_DO_ENABLE_NO' => 'Deaktivieren',
	'OA_SOCIAL_LOGIN_DO_ENABLE_YES' => 'Aktivieren',

	'OA_SOCIAL_LOGIN_DO_LINKING' => 'Verknüpfung von Sozialen-Netzwerk-Benutzerkonten aktivieren?',
	'OA_SOCIAL_LOGIN_DO_LINKING_ASK' => 'Benutzerkonten von Sozialen Netzwerken automatisch mit bestehenden Konten verknüpfen?',
	'OA_SOCIAL_LOGIN_DO_LINKING_DESC' => 'Wenn diese Funktion aktiviert ist, werden soziale Netzwerke mit einer verifizierten Email-Adresse automatisch mit dem Benutzerkonto mit derselben Email-Adresse verknüpft.',
	'OA_SOCIAL_LOGIN_DO_LINKING_NO' => 'Automatische Verknüpfung deaktiveren',
	'OA_SOCIAL_LOGIN_DO_LINKING_YES' => 'Automatische Verknüpfung aktiveren',

	'OA_SOCIAL_LOGIN_DO_REDIRECT' => 'Weiterleitung',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_ASK' => 'Leitet den Benutzer zu dieser Seite weiter, nachdem er sich mit Social Login angemeldet hat',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_DESC' => 'Gib die URL zu einer Seite deines Forums an. Falls dieses Feld leer gelassen wird, bleibt der Benutzer auf der aktuellen Seite.',

	'OA_SOCIAL_LOGIN_DO_VALIDATION' => 'Manuelle Überprüfung der Benutzerdaten aktivieren?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ALWAYS' => 'Überprüfung immer aktivieren',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ASK' => 'Neue Benutzer aufforden, ihren Benutzernamen sowie ihre Email-Adresse zu überprüfen?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DEPENDS' => 'Überprüfung nur aktivieren bei fehlenden Daten',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DESC' => 'Falls aktiviert, müssen Benutzer bei der Anmeldung mit Social Login den vom Plugin zugeteilten Benutzernamen sowie ihre Email-Adresse bestätigen. Alternativ kann die manuelle Überprüfung nur dann erfolgen, wenn der Benutzername vergeben ist, das Soziale-Netzwerk-Benutzerkonto keine Email-Adresse beinhaltet, oder die Email-Adress bereits vergeben ist.',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_NEVER' => 'Überprüfung deaktivieren',

	'OA_SOCIAL_LOGIN_ENABLE_NETWORKS' => 'Wähle die sozialen Netzwerke mit denen Benutzer sich anmelden können',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Bitte aktivere mindestens ein soziales Netzwerk',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Bitte gebe deine API Einstellungen ein',

	'OA_SOCIAL_LOGIN_FSOCKOPEN' => 'PHP FSOCKOPEN',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DESC' => 'Nutze FSOCKOPEN nur, wenn du Probleme mit CURL feststellst.',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DOCS' => '<a href="http://www.php.net/manual/en/function.fsockopen.php" class="external">FSOCKOPEN Anleitung</a>',

	'OA_SOCIAL_LOGIN_INDEX_PAGE' => 'Forum Homepage',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION' => 'Titel auf der Hauptseite',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION_DESC' => 'Dieser Text wird über den Social Login Icons der Hauptseite angezeigt.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE' => 'Auf der Hauptseite aktivieren?',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE_DESC' => 'Falls aktiviert, wird Social Login auf der Hauptseite des Forums angezeigt.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_NO' => 'Deaktivieren',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_YES' => 'Die Anzeige auf der Hauptseite aktiveren',

	'OA_SOCIAL_LOGIN_LOGIN_PAGE' => 'Forum Login Seite',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION' => 'Titel auf der Login Seite',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION_DESC' => 'Dieser Text wird über den Social Login Icons der Login Seite angezeigt.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE' => 'Auf der Login Seite aktivieren?',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE_DESC' => 'Falls aktiviert, wird Social Login auf der Login Seite des Forums angezeigt.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_NO' => 'Deaktivieren',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_YES' => 'Die Anzeige auf der Login Seite aktiveren',

	'OA_SOCIAL_LOGIN_INLINE_PAGE' => 'Forum Login Seite (Eingebettet)',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION' => 'Titel im Login Formular',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION_DESC' => 'Dieser Text wird über den eingebetteten Social Login Icons im Login Formular angezeigt.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE' => 'Eingebettete Anzeige im Login Formular aktivieren?',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE_DESC' => 'Falls aktiviert, wird Social Login ins Formular der Login Seite eingebettet.  Um Social Login einzubetten musst du OneAll als Authentifizierungsmethode im Menü ALLGEMEIN \ CLIENT-KOMMUNIKATION \ AUTHENTIFIZIERUNG auswählen.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_NO' => 'Deaktivieren',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_YES' => 'Die eingebettete Angzeige auf der Login Seite aktivieren',

	'OA_SOCIAL_LOGIN_OTHER_PAGE' => 'All anderen Seiten',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION' => 'Titel auf anderen Seiten',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION_DESC' => 'Dieser Text wird über Social Login auf allen anderen Seiten angezeigt.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE' => 'Auf allen anderen Seiten anzeigen?',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE_DESC' => 'Falls aktiviert, wird Social Login auf allen anderen Seiten des Forums angezeigt.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_NO' => 'Deaktivieren',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_YES' => 'Die Anzeige auf allen anderen Seiten aktivieren',

	'OA_SOCIAL_LOGIN_PORT_443' => 'Kommunikation über Port 443/HTTPS',
	'OA_SOCIAL_LOGIN_PORT_443_DESC' => 'Port 443 zu verwenden wird empfohlen, möglicherweise muss jedoch zuvor OpenSSL auf dem Server installiert werden.',
	'OA_SOCIAL_LOGIN_PORT_80' => 'Kommunikation über Port 80/HTTP',
	'OA_SOCIAL_LOGIN_PORT_80_DESC' => 'Port 80 ist etwas schneller, benötigt kein OpenSSL, ist jedoch nicht so sicher.',

	'OA_SOCIAL_LOGIN_PROFILE_DESC' => 'Verbinden dein Benutzerkonto mit einem sozialen Netzwerk',
	'OA_SOCIAL_LOGIN_PROFILE_TITLE' => 'Social Login',

	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE' => 'Forum Registrierungsseite',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION' => 'Titel auf der Registrierungsseite',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION_DESC' => 'Dieser Text wird über den Social Login Icons der Registrierungsseite angezeigt.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE' => 'Auf der Registrierungsseite anzeigen?',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE_DESC' => 'Falls aktiviert, wird Social Login auf der Registrierungsseite des Forums angezeigt.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_NO' => 'Deaktivieren',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_YES' => 'Die Anzeige auf der Registrierungsseite aktivieren',

	'OA_SOCIAL_LOGIN_SETTINGS' => 'Einstellungen',
	'OA_SOCIAL_LOGIN_SETTINGS_UPDATED' => 'Die Einstellungen wurden erfolgreich gespeichert.',
	'OA_SOCIAL_LOGIN_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Mein kostenloses Konto einrichten</a>',

	'OA_SOCIAL_LOGIN_TITLE' => 'OneAll Social Login',
	'OA_SOCIAL_LOGIN_TITLE_HELP' => 'Hilfe, Updates &amp; Dokumentation',

	'OA_SOCIAL_LOGIN_VALIDATION_FORM_DESC' => 'Der Administrator verlangt von dir, dass du deinen Benutzernamen und deine Email-Adresse überprüfst und gegebenenfalls vervollständigst.',
	'OA_SOCIAL_LOGIN_VALIDATION_FORM_HEADER' => 'Bitte überprüfen deinen Benutzernamen und deine Email-Adresse.',
	'OA_SOCIAL_LOGIN_VALIDATION_SESSION_ERROR' => 'Fehlende Session-Information.'
));
