<?php
/**
 * @package   	OneAll Social Login
 * @copyright 	Copyright 2011-2017 http://www.oneall.com
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

// Social Login Backend.
$lang = array_merge ($lang, array (
	'OA_SOCIAL_LOGIN_ACP' => 'OneAll Social Login',
	'OA_SOCIAL_LOGIN_ACP_SETTINGS' => 'Einstellungen',
	'OA_SOCIAL_LOGIN_API_AUTODETECT' => 'API-Verbindung automatisch erkennen',
	'OA_SOCIAL_LOGIN_API_CONNECTION' => 'API-Verbindung',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER' => 'API-Verbindungs-Handler',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER_DESC' => 'OneAll ist ein Verbindungs-Handler zur API von sozialen Netzwerken',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_CHECK_COM' => 'Die API konnte nicht benachrichtigt werden. Wurde sie richtig eingerichtet?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_FILL_OUT' => 'Bitte fülle jedes der oben angeführten Felder aus.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_KEYS_WRONG' => 'Die API Anmeldedaten sind falsch, bitte überprüfe deinen public/private Key.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_OK' => 'Die Einstellungen sind korrekt - vergiss nicht sie zu speichern!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'Die Subdomain existiert nicht - hast du sie richtig ausgefüllt?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_TITLE' => 'API Credentials - <a href="https://app.oneall.com/applications/" class="external">Hier klicken um deine API-Anmeldedaten zu erstellen oder anzuzeigen</a>',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_UNKNOW_ERROR' => 'Unbekannte Antwort - bitte vergewissere dich, dass du angemeldet bist!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_USE_AUTO' => 'Der Verbindungs-Manager scheint nicht zu funktionieren. Bitte schalte die automatische Erkennung ein.',
	'OA_SOCIAL_LOGIN_API_DETECT_CURL' => 'Erkannte CURL auf Port %s - vergiss nicht deine Änderungen zu speichern!',
	'OA_SOCIAL_LOGIN_API_DETECT_FSOCKOPEN' => 'Erkannte FSOCKOPEN auf Port %s - vergiss nicht deine Änderungen zu speichern!',
	'OA_SOCIAL_LOGIN_API_DETECT_NONE' => 'Verbindung fehlgeschlagen! Deine Firewall muss ausgehende Anforderungen auf Port 80 oder 443 zulassen.',
	'OA_SOCIAL_LOGIN_API_PORT' => 'API-Verbindungs Port',
	'OA_SOCIAL_LOGIN_API_PORT_DESC' => 'Deine Firewall muss ausgehende Anforderungen auf Port 80 oder 443 zulassen.',
	'OA_SOCIAL_LOGIN_API_PRIVATE_KEY' => 'API Private Key',
	'OA_SOCIAL_LOGIN_API_PUBLIC_KEY' => 'API Public Key',
	'OA_SOCIAL_LOGIN_API_SUBDOMAIN' => 'API Subdomain',
	'OA_SOCIAL_LOGIN_API_VERIFY' => 'API-Einstellungen bestätigen',
	'OA_SOCIAL_LOGIN_CREATE_ACCOUNT_FIRST' => 'Um social login nutzen zu können musst du zuerst einen Account anlegen: <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a>',
	'OA_SOCIAL_LOGIN_CURL' => 'PHP CURL',
	'OA_SOCIAL_LOGIN_CURL_DESC' => 'CURL zu verwenden ist empfohlen, aber es könnte auf manchen Servern deaktiviert sein.',
	'OA_SOCIAL_LOGIN_CURL_DOCS' => '<a href="http://www.php.net/manual/en/book.curl.php" class="external">CURL Anleitung</a>',
	'OA_SOCIAL_LOGIN_DEFAULT' => 'Standard',
	'OA_SOCIAL_LOGIN_DISCOVER_PLUGINS' => '<a href="http://docs.oneall.com/plugins/" class="external">Entdecke</a> unsere turnkey Plugins für Drupal, Joomla, WordPress;',
	'OA_SOCIAL_LOGIN_DISPLAY_LOC' => 'Wo willst du das social login überall anzeigen?',
	'OA_SOCIAL_LOGIN_DO_AVATARS' => 'Upload von Avatars von sozialen Netzwerken erlauben?',
	'OA_SOCIAL_LOGIN_DO_AVATARS_DESC' => 'Erlauben den Benutzer-Avatar aus dem sozialen Netzwerk zu empfangen und in dem Avatar-Ordner zu speichern.',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_NO' => 'Nein, Avatars von sozialen Netzwerken nicht verwenden',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_YES' => 'Ja, Avatars von sozialen Netzwerken verwenden',
	'OA_SOCIAL_LOGIN_DO_ENABLE' => 'Social-Login aktivieren?',
	'OA_SOCIAL_LOGIN_DO_ENABLE_DESC' => 'Erlaubt es dir den Social-Login temporär zu deaktivieren ohne ihn zu entfernen.',
	'OA_SOCIAL_LOGIN_DO_ENABLE_NO' => 'Deaktivieren',
	'OA_SOCIAL_LOGIN_DO_ENABLE_YES' => 'Aktivieren',
	'OA_SOCIAL_LOGIN_DO_LINKING' => 'Social-Network Account Linking aktivieren?',
	'OA_SOCIAL_LOGIN_DO_LINKING_ASK' => 'Automatisch Accounts von sozialen Netzwerken mit existierenden Benutzeraccounts verknüpfen?',
	'OA_SOCIAL_LOGIN_DO_LINKING_DESC' => 'Wenn diese Funktion aktiviert ist werden soziale Netzwerke mit einer verifizierten E-Mail-Adresse automatisch mit dem Benutzeraccount mit derselben E-Mail-Adresse verbunden.',
	'OA_SOCIAL_LOGIN_DO_LINKING_NO' => 'Account-Linking deaktivieren',
	'OA_SOCIAL_LOGIN_DO_LINKING_YES' => 'Account-Linking aktivieren',
	'OA_SOCIAL_LOGIN_DO_REDIRECT' => 'Weiterleitung',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_ASK' => 'Leite den Benutzer zu dieser Seite weiter nachdem er sich mit seinem Social-Network Account angemeldet hat',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_DESC' => 'Gib die genaue Adresse zu der phpBB-Seite ein. Wenn dieses Feld leer gelassen wird bleibt der Benutzer auf der Seite.',
	'OA_SOCIAL_LOGIN_DO_VALIDATION' => 'Bestätigung eines neuen Benutzeraccounts anfordern?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ALWAYS' => 'Profil-Validierung aktivieren',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ASK' => 'Neue Benutzer auffordern Benutzername und E-Mail-Adresse zu validieren?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DEPENDS' => 'Ausgenommene Profil-Validierung',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DESC' => 'Wenn aktiviert werden Benutzer aufgefordert ihren Benutzernamen und ihr Passwort zu überprüfen.<br/>Wenn diese Option ausgewählt ist wird eine Ausnahme verursacht wenn der Name bereits vergeben ist, die E-Mail-Adresse fehlt, die E-Mail-Adresse zwar verwendet wird, das automatische Verbinden jedoch deaktiviert ist.',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_NEVER' => 'Profilüberprüfung deaktivieren',
	'OA_SOCIAL_LOGIN_ENABLE_NETWORKS' => 'Wähle die sozialen Netzwerke die für dein Forum verwendet werden sollen',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Du musst mindestens ein soziales Netzwerk aktivieren',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Du musst deine API Daten angeben',
	'OA_SOCIAL_LOGIN_FOLLOW_US_TWITTER' => '<a href="http://www.twitter.com/oneall" class="external">Folge uns</a> auf Twitter um über Updates informiert zu werden;',
	'OA_SOCIAL_LOGIN_FSOCKOPEN' => 'PHP FSOCKOPEN',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DESC' => 'Nutze FSOCKOPEN nur wenn du Probleme mit CURL feststellst.',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DOCS' => '<a href="http://www.php.net/manual/en/function.fsockopen.php" class="external">FSOCKOPEN Anleitung</a>',
	'OA_SOCIAL_LOGIN_GET_HELP' => '<a href="http://www.oneall.com/company/contact-us/" class="external">Kontaktiere uns</a> wenn du Feedback hast oder unsere Hilfe benötigst!',
	'OA_SOCIAL_LOGIN_INDEX_PAGE' => 'Forum Homepage',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION' => 'Hauptseitenbeschriftung',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION_DESC' => 'Dieser Titel wird über den Login-Buttons auf der Hauptseite dargestellt.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE' => 'Auf der Hauptseite anzeigen?',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE_DESC' => 'Wenn diese Funktion aktiviert ist wird das Social-Login auf der Hauptseite angezeigt.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_NO' => 'Nein',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_YES' => 'Ja, auf der Hauptseite anzeigen',
	'OA_SOCIAL_LOGIN_INTRO' => 'Erlaube Besuchern sich mittels Twitter, Facebook, LinkedIn, Hyves, VKontakte, Google und Yahoo sowie anderen zu registrieren und anzumelden. Social Login <strong>erhöht die Benutzer-Registrierungsrate</strong> indem es den Registrierungsprozess verweinfacht und Berechtigungsbasiert <strong>Daten von Profilen sozialer Netzwerke bekommt</strong>. Social Login integriert sich in das aktuelle Registrierungssystem sodass du und die Nutzer nicht neu beginnen müssen.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE' => 'Forum Anmeldeseite',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION' => 'Titel der Anmeldeseite',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION_DESC' => 'Dieser Titel wird über den Social-Login-Buttons auf der Anmeldeseite angezeigt.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE' => 'Auf der Login-Seite anzeigen?',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE_DESC' => 'Wenn diese Funktion aktiviert ist werden die Login-Buttons auf der Anmeldeseite angezeigt.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_NO' => 'Nein',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_YES' => 'Ja, auf der Anmeldeseite anzeigen',
	'OA_SOCIAL_LOGIN_INLINE_PAGE' => 'Forum Anmeldeseite (in Anmelde Formular)',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION' => 'Titel in der Anmeldeseite',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION_DESC' => 'Dieser Titel wird über den Social-Login-Buttons in der Anmeldeseite angezeigt.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE' => 'In der Anmeldeseite Anzeigen?',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE_DESC' => 'Wenn diese Funktion aktiviert ist werden die Login-Buttons in der Anmeldeseite angezeigt. Um die Einbettung zu aktivieren musst du OneAll als Authentifizierungsmethode in ALLGEMEIN \ CLIENT-KOMMUNIKATION \ Authentifizierung auswählen.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_NO' => 'Nein',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_YES' => 'Ja, in der Anmeldeseite anzeigen',
	'OA_SOCIAL_LOGIN_OTHER_PAGE' => 'Alle anderen Seiten',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION' => 'Beschreibung auf den anderen Seiten',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION_DESC' => 'Dieser Titel wird über den Social-Login Buttons auf allen anderen Seiten angezeigt.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE' => 'Auf allen anderen Seiten anzeigen?',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE_DESC' => 'Wenn diese Funktion aktiviert ist werden die Login-Buttons auf allen anderen Seiten angezeigt.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_NO' => 'Nein',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_YES' => 'Ja, auf allen anderen Seiten anzeigen',
	'OA_SOCIAL_LOGIN_PORT_443' => 'Kommunikation per HTTPS auf Port 443',
	'OA_SOCIAL_LOGIN_PORT_443_DESC' => 'Port 443 zu verwenden wird empfohlen, möglicherweise muss jedoch zuvor OpenSSL auf dem Server installiert werden.',
	'OA_SOCIAL_LOGIN_PORT_80' => 'Kommunikation per HTTP auf Port 80',
	'OA_SOCIAL_LOGIN_PORT_80_DESC' => 'Port 80 ist etwas schneller, benötigt kein OpenSSL, ist jedoch weniger sicher.',
	'OA_SOCIAL_LOGIN_PROFILE_DESC' => 'Verbinden deinen Account mit einem sozialen Netzwerk',
	'OA_SOCIAL_LOGIN_PROFILE_TITLE' => 'Social Login',
	'OA_SOCIAL_LOGIN_READ_DOCS' => '<a href="http://docs.oneall.com/plugins/" class="external">Lies</a> die Online Information für mehr Information zu diesem Plugin;',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE' => 'Forum Registrierungsseite',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION' => 'Beschriftung der Registrierungsseite',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION_DESC' => 'Dieser Titel wird über den Social-Login Buttons auf der Registrierungsseite angezeigt.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE' => 'Auf der Registrierungsseite anzeigen?',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE_DESC' => 'Wenn diese Funktion aktiviert ist werden die Social-Login Buttons auf der Registrierungsseite angezeigt.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_NO' => 'Nein',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_YES' => 'Ja, auf der Registrierungsseite anzeigen',
	'OA_SOCIAL_LOGIN_SETTINGS' => 'Einstellungen',
	'OA_SOCIAL_LOGIN_SETTNGS_UPDATED' => 'Die Einstellungen wurden erfolgreich geändert.',
	'OA_SOCIAL_LOGIN_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Mein Gratis-Konto einrichten</a>',
	'OA_SOCIAL_LOGIN_SOCIAL_LINK' => 'Social Link Service',
	'OA_SOCIAL_LOGIN_TITLE' => 'OneAll Social Login',
	'OA_SOCIAL_LOGIN_TITLE_HELP' => 'Hilfe, Updates &amp; Dokumentation',
	'OA_SOCIAL_LOGIN_VALIDATION_FORM_DESC' => 'Der Administrator verlangt von dir, dass du deinen Benutzernamen und deine E-Mail-Adresse überprüfst oder vervollständigst.',
	'OA_SOCIAL_LOGIN_VALIDATION_FORM_EMAIL_EXPLAIN' => 'Akzeptiere oder verändere deine E-Mail-Adresse.',
	'OA_SOCIAL_LOGIN_VALIDATION_FORM_EMAIL_NONE_EXPLAIN' => 'Deine E-Mail-Adresse fehlt in dem Profil - bitte gib sie hier an.',
	'OA_SOCIAL_LOGIN_VALIDATION_FORM_HEADER' => 'Überprüfe deinen Benutzernamen und deine E-Mail-Adresse',
	'OA_SOCIAL_LOGIN_VALIDATION_SESSION_ERROR' => 'Fehlende Session-Information.',
	'OA_SOCIAL_LOGIN_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Erstelle und zeige meine API Daten</a>',
	'OA_SOCIAL_LOGIN_WIDGET_TITLE' => 'Mit einem sozialen Netzwerk anmelden',
	'G_OA_SOCIAL_LOGIN_REGISTER' => 'Registrierte OneAll Mitglieder',
));
