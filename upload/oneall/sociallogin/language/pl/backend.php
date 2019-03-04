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
 * https://gwc.pl/forum
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
	'G_OA_SOCIAL_LOGIN_REGISTER' => 'Zarejestrowani użytkownicy OneAll',

	'OA_SOCIAL_LOGIN_CREATE_ACCOUNT_FIRST' => 'W celu używania <i>Social Login</i> najpierw musisz utworzyć darmowe konto na <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a>.',
	'OA_SOCIAL_LOGIN_DEFAULT' => 'Domyślny',
	'OA_SOCIAL_LOGIN_DISCOVER_PLUGINS' => '<a href="http://docs.oneall.com/plugins/" class="external">Odkryj</a> nasze wtyczki dla serwisów Drupal, Joomla, WordPress ...',
	'OA_SOCIAL_LOGIN_FOLLOW_US_TWITTER' => '<a href="http://www.twitter.com/oneall" class="external">Śledź nas</a> na Twitterze, aby mieć bieżące informacje o aktualizacjach;',
	'OA_SOCIAL_LOGIN_GET_HELP' => '<a href="https://support.oneall.com/forums/" class="external">Skontaktuj się z nami</a>, jeżeli masz uwagi lub potrzebujesz wsparcia!',
	'OA_SOCIAL_LOGIN_READ_DOCS' => '<a href="http://docs.oneall.com/plugins/guide/social-login-phpbb/3.1/" class="external">Przeczytaj</a> dokumentację online, aby uzyskać więcej informacji o tej wtyczce;',
	'OA_SOCIAL_LOGIN_INTRO' => 'Pozwól odwiedzającym logować się i rejestrować przez sieci społecznościowe jak Facebook, między innymi, LinkedIn, VKontakte, Google i Yahoo. <i>Social Login</i> <strong>zwiększa poziom rejestracji na forum</strong> przez uproszeczenie procesu rejestracji i  oferuje <strong>dane uzyskane z profili sieci społecznościowych</strong> w oparciu o uprawnienia użytkowników. <i>Social Login</i> integruje się z istniejącym systemem rejestracji, zatem Ty ani Twoi użytkownicy nie musicie zaczyć wszystkiego od początku.',
	'OA_SOCIAL_LOGIN_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Utwórz i/lub zobacz moje dane uwierzytelniające do API</a>',
	'OA_SOCIAL_LOGIN_WIDGET_TITLE' => 'Zaloguj przez sieci społecznościowe',

	'OA_SOCIAL_LOGIN_ACP' => 'OneAll Social Login',
	'OA_SOCIAL_LOGIN_ACP_SETTINGS' => 'Ustawienia',

	'OA_SOCIAL_LOGIN_API_AUTODETECT' => 'Automatycznie wykryj połączenie API',
	'OA_SOCIAL_LOGIN_API_VERIFY' => 'Zweryfikuj ustawienia API',

	'OA_SOCIAL_LOGIN_API_CONNECTION' => 'Połączenie API',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER' => 'Menedżer połączeń API',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER_DESC' => 'W ten sposób Twój serwer będzie komunikował się z usługą integracji OneAll z sieciami społecznościowymi.',

	'OA_SOCIAL_LOGIN_API_CREDENTIALS_CHECK_COM' => 'Nie można połączyć sie z API. Czy połączenia API jest poprawnie skonfigurowane?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_FILL_OUT' => 'Wypełnij, proszę, wszystkie powyższe pola.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_KEYS_WRONG' => 'Dane uwierzytelniające do API są błędne. Sprawdz, proszę, swój klucz publiczny/prywatny.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_OK' => 'Ustawienia są poprawne - nie zapomnij zapisać swoich zmian!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'Poddomena nie istnieje. Czy poprawnie ją wpisałeś?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_TITLE' => 'Dane uwierzytelniające do API - <a href="https://app.oneall.com/applications/" class="external">Kliknij tutaj, aby utworzyć lub zobaczyć swoje dane</a>',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_UNKNOW_ERROR' => 'Nieznana odpowiedź - sprawdź, proszę, czy jesteś zalogowany!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_USE_AUTO' => 'Menedżer połączeń wydaje się nie działać. Użyj, proszę, automatycznego wykrywania.',

	'OA_SOCIAL_LOGIN_API_DETECT_CURL' => 'Wykryto CURL na porcie %s - nie zapomnij zapisać swoich zmian!',
	'OA_SOCIAL_LOGIN_API_DETECT_FSOCKOPEN' => 'Wykryto FSOCKOPEN na porcie %s - nie zapomnij zapisać swoich zmian!',
	'OA_SOCIAL_LOGIN_API_DETECT_NONE' => 'Połączenie nieudane! Twój firewall musi zezwalać na wychodzące połączenia przez port 80 lub 443.',

	'OA_SOCIAL_LOGIN_API_PORT' => 'Port połączenia API',
	'OA_SOCIAL_LOGIN_API_PORT_DESC' => 'Twój firewall musi zezwalać na wychodzące połączenia przez port 80 i/lub 443.',

	'OA_SOCIAL_LOGIN_API_PRIVATE_KEY' => 'Klucz prywatny API',
	'OA_SOCIAL_LOGIN_API_PUBLIC_KEY' => 'Klucz publiczny API',
	'OA_SOCIAL_LOGIN_API_SUBDOMAIN' => 'Poddomena API',

	'OA_SOCIAL_LOGIN_CURL' => 'PHP CURL',
	'OA_SOCIAL_LOGIN_CURL_DESC' => 'Zalecane jest stosowanie CURL, ale na niektórych serwerach może być wyłączone.',
	'OA_SOCIAL_LOGIN_CURL_DOCS' => '<a href="http://www.php.net/manual/en/book.curl.php" class="external">Instrukcja CURL</a>',

	'OA_SOCIAL_LOGIN_DISPLAY_LOC' => 'Wyświetlanie Social Login',

	'OA_SOCIAL_LOGIN_DO_AVATARS' => 'Włącz przesyłanie awatarów z sieci społecznościowych?',
	'OA_SOCIAL_LOGIN_DO_AVATARS_DESC' => 'Pozwól na pobranie awatara użytkownika z jego profilu w sieciach społecznościowych i zapisanie go w folderze awatarów phpBB.',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_NO' => 'Nie, nie używaj awatarów sieci społecznościowych',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_YES' => 'Tak, używaj awatarów sieci społecznościowych',

	'OA_SOCIAL_LOGIN_DO_ENABLE' => 'Włączyć <i>Social Login</i>?',
	'OA_SOCIAL_LOGIN_DO_ENABLE_DESC' => 'Pozwala tymczasowo wyłączyć <i>Social Login</i> bez konieczności jego usuwania.',
	'OA_SOCIAL_LOGIN_DO_ENABLE_NO' => 'Wyłącz',
	'OA_SOCIAL_LOGIN_DO_ENABLE_YES' => 'Włącz',

	'OA_SOCIAL_LOGIN_DO_LINKING' => 'Łączenie kont z sieci społecznościowych',
	'OA_SOCIAL_LOGIN_DO_LINKING_ASK' => 'Czy łączyć automatycznie konta z sieci społecznościowych z istniejącymi kontami użytkowników?',
	'OA_SOCIAL_LOGIN_DO_LINKING_DESC' => 'Jeśli opcja jest włączona, konta sieci społecznościowych ze zweryfikowanym adresem e-mail zostaną połączone z istniejącymi kontami użytkowników phpBB mającymi ten sam adres e-mail.',
	'OA_SOCIAL_LOGIN_DO_LINKING_NO' => 'Wyłącz łączenie kont',
	'OA_SOCIAL_LOGIN_DO_LINKING_YES' => 'Włącz łączenie kont',

	'OA_SOCIAL_LOGIN_DO_REDIRECT' => 'Przekierowanie',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_ASK' => 'Przekierowuj użytkowników do tej strony, gdy podłączą swoje konto sieci społecznościowej',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_DESC' => 'Wprowadź pełny adres URL strony swojego phpBB. Jeśli pozostanie puste, to użytkownik pozostanie na tej samej stronie.',

	'OA_SOCIAL_LOGIN_DO_VALIDATION' => 'Sprawdzenie poprawności profilu nowego użytkownika',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ALWAYS' => 'Włącz sprawdzanie poprawności profilu',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ASK' => 'Czy pytać nowych użytkowników o weryfikację nazwy użytkownika i adresu e-mail?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DEPENDS' => 'Sprawdzanie poprawności profilu tylko w razie potrzeby',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DESC' => 'Jeśli opcja jest włączona, to nowi użytkownicy zostaną poproszeni o uzupełnienie lub sprawdzenie swojej nazwy użytkownika i adresu e-mail.<br /> Niezbędne sprawdzenie poprawności ma miejsce tylko w przypadku, gdy nazwa użytkownika jest zajęta, adres e-mail nie jest podany lub adres e-mail jest zajęty, a <i>Social Login</i> jest wyłączony.',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_NEVER' => 'Wyłącz sprawdzanie poprawności profilu',

	'OA_SOCIAL_LOGIN_ENABLE_NETWORKS' => 'Wybierz sieci społecznościowe, które chcesz włączyć na swoim forum',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Musisz włączyć co najmniej jedną sieć społecznościową',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Musisz skonfigurować swoje dane uwierzytelniające do API',

	'OA_SOCIAL_LOGIN_FSOCKOPEN' => 'PHP FSOCKOPEN',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DESC' => 'Używaj FSOCKOPEN tylko, gdy napotkasz problemy z CURL.',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DOCS' => '<a href="http://www.php.net/manual/en/function.fsockopen.php" class="external">Instrukcja FSOCKOPEN</a>',

	'OA_SOCIAL_LOGIN_INDEX_PAGE' => 'Strona domowa forum',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION' => 'Podpis na stronia głównej',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION_DESC' => 'Ten tytuł jest wyświetlany nad ikonami <i>Social Login</i> na stronie głównej.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE' => 'Czy wyświetlać na stronie głównej?',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE_DESC' => 'Jeżeli opcja jest włączona, to <i>Social Login</i> będzie wyświetlany na stronie głównej.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_NO' => 'Nie',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_YES' => 'Tak, pokazuj na stronie głównej',

	'OA_SOCIAL_LOGIN_LOGIN_PAGE' => 'Strona logowania forum',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION' => 'Podpis na stronie logowania',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION_DESC' => 'Ten tytuł jest wyświetlany nad ikonami <i>Social Login</i> na stronie logowania.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE' => 'Czy wyświetlać na stronie logowania?',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE_DESC' => 'Jeżeli opcja jest włączona, to <i>Social Login</i> będzie wyświetlany na stronie logowania.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_NO' => 'Nie',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_YES' => 'Tak, pokazuj na stronie logowania',

	'OA_SOCIAL_LOGIN_INLINE_PAGE' => 'Strona logowania forum (formularz wbudowany)',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION' => 'Podpis na stronie logowania',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION_DESC' => 'Ten tytuł jest wyświetlany nad śródliniowymi ikonami <i>Social Login</i> na stronie logowania.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE' => 'Czy wyświetlać jako formularz wbudowany na stronie logowania?',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE_DESC' => 'Jeśli opcja jest włączona, to <i>Social Login</i> zostanie osadzone jako formularz wstawiany na stronie logowania. Aby włączyć formularz wbudowany, należy wybrać opcję OneAll jako metodę uwierzytelniania w ustawieniu GENERAL \ CLIENT COMMUNICATIONS \ AUTHENTICATION.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_NO' => 'Nie',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_YES' => 'Tak, pokazuj formularz wbudowany na stronie logowania',

	'OA_SOCIAL_LOGIN_OTHER_PAGE' => 'Inne strony',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION' => 'Podpis na innych stronach',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION_DESC' => 'Ten tytuł jest wyświetlany nad ikonami <i>Social Login</i> na innych stronach.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE' => 'Czy wyświetlać na innych stronach?',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE_DESC' => 'Jeżeli opcja jest włączona, to <i>Social Login</i> będzie wyświetlany na innych stronach forum.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_NO' => 'Nie',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_YES' => 'Tak, pokazuj na innych stronach',

	'OA_SOCIAL_LOGIN_PORT_443' => 'Komunikacja przez port 443/HTTPS',
	'OA_SOCIAL_LOGIN_PORT_443_DESC' => 'Zaleca się stosowanie portu 443, ale może to wymagać zainstalowania OpenSSL na twoim swoim serwerze.',
	'OA_SOCIAL_LOGIN_PORT_80' => 'Komunikacja przez port 80/HTTP',
	'OA_SOCIAL_LOGIN_PORT_80_DESC' => 'Stosowanie portu 80 jest nieco szybsze, nie wymaga OpenSSL, ale jest mniej bezpieczne.',

	'OA_SOCIAL_LOGIN_PROFILE_DESC' => 'Połącz swoje konto z siecią społecznościową',
	'OA_SOCIAL_LOGIN_PROFILE_TITLE' => 'Social Login',

	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE' => 'Strona rejestracji na forum',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION' => 'Podpis na stronie rejestracji',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION_DESC' => 'Ten tytuł jest wyświetlany nad ikonami <i>Social Login</i> na stronie rejestracji.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE' => 'Czy wyświetlać na stronie rejestracji?',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE_DESC' => 'eżeli opcja jest włączona, to <i>Social Login</i> będzie wyświetlany na stronie rejestracji na forum.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_NO' => 'Nie',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_YES' => 'Tak, pokazuj na stronie rejestracji',

	'OA_SOCIAL_LOGIN_SETTINGS' => 'Ustawienia',
	'OA_SOCIAL_LOGIN_SETTINGS_UPDATED' => 'Ustawienia zaktualizowane pomyślnie.',
	'OA_SOCIAL_LOGIN_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Skonfiguruj moje bezpłatne konto</a>',

	'OA_SOCIAL_LOGIN_TITLE' => 'OneAll Social Login',
	'OA_SOCIAL_LOGIN_TITLE_HELP' => 'Pomoc, aktualizacje &amp; dokumentacja',

	'OA_SOCIAL_LOGIN_VALIDATION_FORM_DESC' => 'Administrator wymaga sprawdzenia lub uzupełnienia swojej nazwy użytkownika i adresu e-mail.',
	'OA_SOCIAL_LOGIN_VALIDATION_FORM_HEADER' => 'Potwierdź swoją nazwę użytkownika i adres e-mail',
	'OA_SOCIAL_LOGIN_VALIDATION_SESSION_ERROR' => 'Brakujące informacje o sesji.'
));
