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

/**
 * English translations by OneAll
 * http://www.oneall.com
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
	'G_OA_SOCIAL_LOGIN_REGISTER' => 'Geregistreerde OneAll gebruikers',

	'OA_SOCIAL_LOGIN_CREATE_ACCOUNT_FIRST' => 'Om Sociale Login te kunnen gebruiken, moet u eerst een gratis account aanmaken bij <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a>.',
	'OA_SOCIAL_LOGIN_DEFAULT' => 'Standaard',
	'OA_SOCIAL_LOGIN_DISCOVER_PLUGINS' => '<a href="http://docs.oneall.com/plugins/" class="external">Ontdek</a> onze turnkey plugins voor Drupal, Joomla, WordPress ...',
	'OA_SOCIAL_LOGIN_FOLLOW_US_TWITTER' => '<a href="http://www.twitter.com/oneall" class="external">Volg ons</a> op Twitter om op de hoogte blijven van updates.',
	'OA_SOCIAL_LOGIN_GET_HELP' => '<a href="https://support.oneall.com/forums/" class="external">Contacteer ons</a> Als u feedback heeft of hulp nodig hebt!',
	'OA_SOCIAL_LOGIN_READ_DOCS' => '<a href="http://docs.oneall.com/plugins/guide/social-login-phpbb/3.1/" class="external">Lees</a> de online documentatie voor meer informatie over deze plugin.',
	'OA_SOCIAL_LOGIN_INTRO' => 'Sta uw bezoekers toe om in te loggen en zich te registreren met sociale netwerken zoals Twitter, Facebook, LinkedIn, VKontakte, Google, Yahoo en vele andere. Sociale Login <strong>verhoogt uw gebruikers registratie percentage</strong> door het registratieproces te vereenvoudigen en zorgt voor permissie gebaseerde <strong>informatie van de sociale netwerk profielen</strong>. Sociale Login integreert met uw bestaand registratiesysteem, zodat u en uw gebruikers niet van nul af moeten beginnen.',
	'OA_SOCIAL_LOGIN_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Maak en/of bekijk mijn API-referenties</a>',
	'OA_SOCIAL_LOGIN_WIDGET_TITLE' => 'Login met een sociaal netwerk',

	'OA_SOCIAL_LOGIN_ACP' => 'OneAll Sociale Login',
	'OA_SOCIAL_LOGIN_ACP_SETTINGS' => 'Instellingen',

	'OA_SOCIAL_LOGIN_API_AUTODETECT' => 'Automatische detectie API verbinding',
	'OA_SOCIAL_LOGIN_API_VERIFY' => 'Verifieer API Instellingen',

	'OA_SOCIAL_LOGIN_API_CONNECTION' => 'API Verbinding',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER' => 'API Verbinding Regelaar',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER_DESC' => 'OneAll is een verbinding beheerder bij de API van Sociale Media',

	'OA_SOCIAL_LOGIN_API_CREDENTIALS_CHECK_COM' => 'Kan de API niet contacteren. Is de installatie van de API-verbinding goed ingesteld?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_FILL_OUT' => 'Vul alstublieft alle bovenstaande velden in.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_KEYS_WRONG' => 'De API-referenties zijn fout, controleer alstublieft uw publieke/private sleutel.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_OK' => 'De instellingen zijn correct - vergeet niet om uw wijzigingen op te slaan!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'Het subdomein bestaat niet. Heb je het goed ingevuld?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_TITLE' => 'API Referenties - <a href="https://app.oneall.com/applications/" class="external">Klik hier om uw API-referenties te maken of te bekijken</a>',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_UNKNOW_ERROR' => 'Onbekend antwoord - zorg ervoor dat u bent ingelogd!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_USE_AUTO' => 'De verbinding regelaar lijkt niet te werken. Gebruik de Autodetectie alstublieft.',

	'OA_SOCIAL_LOGIN_API_DETECT_CURL' => 'Detecteerde CURL op poort %s - Vergeet niet om uw wijzigingen op te slaan!',
	'OA_SOCIAL_LOGIN_API_DETECT_FSOCKOPEN' => 'Detecteerde FSOCKOPEN op Poort %s - Vergeet niet om uw wijzigingen op te slaan!',
	'OA_SOCIAL_LOGIN_API_DETECT_NONE' => 'Verbinding mislukt! Uw firewall moet uitgaande aanvragen op een van beide poorten toestaan: 80 of 443.',

	'OA_SOCIAL_LOGIN_API_PORT' => 'API Verbinding Poort',
	'OA_SOCIAL_LOGIN_API_PORT_DESC' => 'Uw firewall moet uitgaande verzoeken in beide poorten 80 of 443 toestaan.',

	'OA_SOCIAL_LOGIN_API_PRIVATE_KEY' => 'API Private Sleutel',
	'OA_SOCIAL_LOGIN_API_PUBLIC_KEY' => 'API Publieke Sleutel',
	'OA_SOCIAL_LOGIN_API_SUBDOMAIN' => 'API Subdomein',

	'OA_SOCIAL_LOGIN_CURL' => 'PHP CURL',
	'OA_SOCIAL_LOGIN_CURL_DESC' => 'Het gebruik van CURL wordt aanbevolen, maar het kan uitgeschakeld zijn op sommige servers.',
	'OA_SOCIAL_LOGIN_CURL_DOCS' => '<a href="http://www.php.net/manual/en/book.curl.php" class="external">CURL Handleiding</a>',

	'OA_SOCIAL_LOGIN_DISPLAY_LOC' => 'Waar wil je Sociale Inloggen weergeven?',

	'OA_SOCIAL_LOGIN_DO_AVATARS' => 'Activeer uploaden van avatars van sociale netwerken?',
	'OA_SOCIAL_LOGIN_DO_AVATARS_DESC' => 'Sta toe om de avatar van de gebruiker op te halen van zijn/haar sociale netwerk en sla het op in je phpBB avatar map.',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_NO' => 'Nee, gebruik geen sociale netwerk avatars',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_YES' => 'Ja, gebruik sociale netwerk avatars',

	'OA_SOCIAL_LOGIN_DO_ENABLE' => 'Sociale Login inschakelen?',
	'OA_SOCIAL_LOGIN_DO_ENABLE_DESC' => 'Hiermee kunt u de Sociale Login tijdelijk uitschakelen zonder het te verwijderen.',
	'OA_SOCIAL_LOGIN_DO_ENABLE_NO' => 'Uitschakelen',
	'OA_SOCIAL_LOGIN_DO_ENABLE_YES' => 'Inschakelen',

	'OA_SOCIAL_LOGIN_DO_LINKING' => 'Schakel Sociale Netwerk account verbinding aan',
	'OA_SOCIAL_LOGIN_DO_LINKING_ASK' => 'Koppel Sociale Netwerk accounts automatisch aan bestaande gebruiker accounts?',
	'OA_SOCIAL_LOGIN_DO_LINKING_DESC' => 'Indien ingeschakeld, worden sociale netwerk accounts met een geverifieerd email adres gekoppeld aan bestaande phpBB gebruikers accounts met hetzelfde e-mailadres.',
	'OA_SOCIAL_LOGIN_DO_LINKING_NO' => 'Account koppelen uitschakelen',
	'OA_SOCIAL_LOGIN_DO_LINKING_YES' => 'Account koppelen inschakelen',

	'OA_SOCIAL_LOGIN_DO_REDIRECT' => 'Omleiding',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_ASK' => 'Stuur gebruikers naar deze pagina nadat ze verbonden zijn met hun sociale netwerk account',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_DESC' => 'Vul een volledige URL in naar een pagina van uw website. Als u dit leeg laat blijft de gebruiker op dezelfde pagina.',

	'OA_SOCIAL_LOGIN_DO_VALIDATION' => 'Vraag validatie van het profiel van een nieuwe gebruiker?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ALWAYS' => 'Activeer profiel validatie',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ASK' => 'Vraag nieuwe gebruikers om gebruikersnaam en e-mail te valideren?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DEPENDS' => 'Profiel validatie indien nodig',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DESC' => 'Indien ingeschakeld, worden nieuwe gebruikers gevraagd hun gebruikersnaam en e-mailadres te voltooien of te controleren.<br>De vereiste validatie gebeurt alleen als de gebruikersnaam reeds in gebruik is, het e-mailadres ontbreekt of het e-mailadres reeds in gebruik is en Sociale Link is uitgeschakeld. ',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_NEVER' => 'Schakel profiel validatie uit',

	'OA_SOCIAL_LOGIN_ENABLE_NETWORKS' => 'Kies de sociale netwerken om op je forum in te schakelen',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'U moet minimaal 1 sociaal netwerk inschakelen',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Je moet je API-referenties instellen',

	'OA_SOCIAL_LOGIN_FSOCKOPEN' => 'PHP FSOCKOPEN',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DESC' => 'Gebruik alleen FSOCKOPEN als u problemen ondervindt met CURL.',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DOCS' => '<a href="http://www.php.net/manual/en/function.fsockopen.php" class="external">FSOCKOPEN Handleiding</a>',

	'OA_SOCIAL_LOGIN_INDEX_PAGE' => 'Forum Thuispagina',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION' => 'Hoofd pagina titel',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION_DESC' => 'Deze titel wordt weergegeven boven de Sociale Login iconen op de hoofd pagina.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE' => 'Weergeven op de hoofd pagina?',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE_DESC' => 'Indien ingeschakeld, wordt Sociale Login op de hoofd pagina weergegeven.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_NO' => 'Nee',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_YES' => 'Ja, toon op de hoofd pagina',

	'OA_SOCIAL_LOGIN_LOGIN_PAGE' => 'Forum Login Pagina',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION' => 'Login pagina titel',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION_DESC' => 'Deze titel wordt weergegeven boven de Sociale Login iconen op de login pagina.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE' => 'Toon op de login pagina?',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE_DESC' => 'Indien ingeschakeld, wordt Sociale Login weergegeven op de login pagina.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_NO' => 'Nee',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_YES' => 'Ja, toon op de login pagina',

	'OA_SOCIAL_LOGIN_INLINE_PAGE' => 'Forum Login Pagina (inline met login formulier)',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION' => 'Inline login formulier titel',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION_DESC' => 'Deze titel wordt weergegeven boven de Sociale Login iconen embedded inline op de login pagina.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE' => 'Weergeven als inline formulier op de login pagina?',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE_DESC' => 'Indien ingeschakeld, wordt Sociale Login geïntegreerd als inline formulier op de login pagina. Om de inline-weergave in te schakelen, moet u OneAll selecteren als verificatie methode in de ALGEMENE \ CLIENT COMMUNICATIONS \ AUTHENTICATION instelling.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_NO' => 'Nee',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_YES' => 'Ja, toon inline op de login pagina',

	'OA_SOCIAL_LOGIN_OTHER_PAGE' => 'Alle andere pagina’s',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION' => 'Titel op andere pagina’s',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION_DESC' => 'Deze titel wordt boven de Sociale Login-iconen op de andere pagina’s weergegeven.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE' => 'Toon op andere pagina’s?',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE_DESC' => 'Indien ingeschakeld zal Sociale Login ook worden weergegeven op elke andere pagina van het forum.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_NO' => 'Nee',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_YES' => 'Ja, toon op andere pagina’s',

	'OA_SOCIAL_LOGIN_PORT_443' => 'Communicatie via HTTPS op poort 443',
	'OA_SOCIAL_LOGIN_PORT_443_DESC' => 'Poort 443 gebruiken wordt aanbevolen, maar u moet waarschijnlijk OpenSSL op uw server installeren.',
	'OA_SOCIAL_LOGIN_PORT_80' => 'Communicatie via HTTP op poort 80',
	'OA_SOCIAL_LOGIN_PORT_80_DESC' => 'Het gebruik van poort 80 is een beetje sneller, heeft geen OpenSSL nodig, maar is minder veilig.',

	'OA_SOCIAL_LOGIN_PROFILE_DESC' => 'Link uw account aan een sociaal netwerk',
	'OA_SOCIAL_LOGIN_PROFILE_TITLE' => 'Sociale Login',

	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE' => 'Forum Registratie Pagina',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION' => 'Registratie pagina titel',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION_DESC' => 'Deze titel wordt boven de Sociale Login iconen op de registratie pagina weergegeven.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE' => 'Toon op de registratie pagina?',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE_DESC' => 'Indien ingeschakeld wordt Sociale Login op de registratie pagina weergegeven.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_NO' => 'Nee',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_YES' => 'Ja, toon op de registratie pagina',

	'OA_SOCIAL_LOGIN_SETTINGS' => 'Instellingen',
	'OA_SOCIAL_LOGIN_SETTINGS_UPDATED' => 'Instellingen succesvol bijgewerkt.',
	'OA_SOCIAL_LOGIN_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Stel mijn gratis account in</a>',

	'OA_SOCIAL_LOGIN_TITLE' => 'OneAll Sociale Login',
	'OA_SOCIAL_LOGIN_TITLE_HELP' => 'Help, Updates & Documentatie',

	'OA_SOCIAL_LOGIN_VALIDATION_FORM_DESC' => 'De beheerder vereist dat u uw gebruikersnaam en e-mailadres controleert of voltooit.',
	'OA_SOCIAL_LOGIN_VALIDATION_FORM_HEADER' => 'Valideer uw gebruikersnaam en e-mailadres',
	'OA_SOCIAL_LOGIN_VALIDATION_SESSION_ERROR' => 'Ontbrekende sessie informatie.'
));
