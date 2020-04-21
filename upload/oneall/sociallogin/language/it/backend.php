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
 * Italian translations by EugyRdT
 * https://forumanicomio.eugy.it
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
	'G_OA_SOCIAL_LOGIN_REGISTER' => 'Utenti OneAll registrati',

	'OA_SOCIAL_LOGIN_CREATE_ACCOUNT_FIRST' => 'Per poter usare Social Login, devi innanzitutto crere un account gratuito su <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a>.',
	'OA_SOCIAL_LOGIN_DEFAULT' => 'Default',
	'OA_SOCIAL_LOGIN_DISCOVER_PLUGINS' => '<a href="http://docs.oneall.com/plugins/" class="external">Scopri</a> i nostri turnkey plugins for Drupal, Joomla, WordPress ...',
	'OA_SOCIAL_LOGIN_FOLLOW_US_TWITTER' => '<a href="http://www.twitter.com/oneall" class="external">Seguici</a> su Twitter per essere informato circa gli aggiornamenti;',
	'OA_SOCIAL_LOGIN_GET_HELP' => '<a href="https://support.oneall.com/forums/" class="external">Contattaci</a> se avessi suggerimenti o ti servisse assistenza!',
	'OA_SOCIAL_LOGIN_READ_DOCS' => '<a href="http://docs.oneall.com/plugins/guide/social-login-phpbb/3.1/" class="external">Leggi</a> la documentazione online per maggiori informazioni circa questo plugin;',
	'OA_SOCIAL_LOGIN_INTRO' => 'Permetti ai tuoi visitatori di registrarsi ed accedere tramite social networks come Twitter, Facebook, LinkedIn, VKontakte, Google and Yahoo tra gli altri. Social Login <strong>aumenta il tuo tasso di registrazioni</strong> semplificando il processo e fornisce dati prelevati dai profili social, con il sistema di permessi. Social Login si integra con i tuo sistema di registrazione esistente, in modo che tu ed i tuoi utenti non dobbiate partire da zero.',
	'OA_SOCIAL_LOGIN_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Crea e/o vedi le mie Credenziali API</a>',
	'OA_SOCIAL_LOGIN_WIDGET_TITLE' => 'Accedi con un social network',

	'OA_SOCIAL_LOGIN_ACP' => 'OneAll Social Login',
	'OA_SOCIAL_LOGIN_ACP_SETTINGS' => 'Impostazioni',

	'OA_SOCIAL_LOGIN_API_AUTODETECT' => 'Autodetermina Connessione API',
	'OA_SOCIAL_LOGIN_API_VERIFY' => 'Verifica impostazioni API',

	'OA_SOCIAL_LOGIN_API_CONNECTION' => 'Connessione API',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER' => 'Gestore Connessione API',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER_DESC' => 'Questo è come il tuo server comunicherà con il servizio di integrazione dei social networks OneAll.',

	'OA_SOCIAL_LOGIN_API_CREDENTIALS_CHECK_COM' => 'Non posso contattare API. La connessione API è impostata correttamente?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_FILL_OUT' => 'Prego riempire ognuno dei campi qui sopra.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_KEYS_WRONG' => 'Le Credenziali API non sono corrette, prego controlla le tue chiavi pubblica/privata.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_OK' => 'Impostazioni corrette - non dimenticare di salvare i cambiamenti!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'Il sottodominio non esiste. Lo hai compilato correttamente?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_TITLE' => 'Credenziali API - <a href="https://app.oneall.com/applications/" class="external">Clicca per creare o vedere le tue credenziali API</a>',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_UNKNOW_ERROR' => 'Risposta sconosciuta - accertati di essere autenticato!',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_USE_AUTO' => 'Il gestore della connessione non sembra funzionare. Usa la funzione Autodetermina.',

	'OA_SOCIAL_LOGIN_API_DETECT_CURL' => 'Rilevato CURL sulla porta %s - non dimenticare di salvare i cambiamenti!',
	'OA_SOCIAL_LOGIN_API_DETECT_FSOCKOPEN' => 'Rilevato FSOCKOPEN on Port %s - non dimenticare di salvare i cambiamenti!',
	'OA_SOCIAL_LOGIN_API_DETECT_NONE' => 'Connessione fallita! Il tuo firewall deve permettere richieste esterne o sulla porta 80 o sulla porta 443.',

	'OA_SOCIAL_LOGIN_API_PORT' => 'Porta di Connessione API',
	'OA_SOCIAL_LOGIN_API_PORT_DESC' => 'Il tuo firewall deve permettere richieste esterne sulla porta 80 e/o 443.',

	'OA_SOCIAL_LOGIN_API_PRIVATE_KEY' => 'Chiave Privata API',
	'OA_SOCIAL_LOGIN_API_PUBLIC_KEY' => 'Chiave Pubblica API',
	'OA_SOCIAL_LOGIN_API_SUBDOMAIN' => 'Sottodominio API',

	'OA_SOCIAL_LOGIN_CURL' => 'PHP CURL',
	'OA_SOCIAL_LOGIN_CURL_DESC' => 'Si raccomanda di usare CURL, ma potrebbe essere disabilitato su alcuni server.',
	'OA_SOCIAL_LOGIN_CURL_DOCS' => '<a href="http://www.php.net/manual/en/book.curl.php" class="external">Manuale CURL</a>',

	'OA_SOCIAL_LOGIN_DISPLAY_LOC' => 'Dove vuoi mostrare Social Login?',

	'OA_SOCIAL_LOGIN_DO_AVATARS' => 'Abilita il caricamento degli avatar dai social networks?',
	'OA_SOCIAL_LOGIN_DO_AVATARS_DESC' => 'Permette di recuperare gli avatar degli utenti dai loro profili social e salvarli nella tua cartella avatar di phpBB.',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_NO' => 'No, non usare avatar dei social network',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_YES' => 'Si, usa gli avatar dei social network',

	'OA_SOCIAL_LOGIN_DO_ENABLE' => 'Abilitare Social Login ?',
	'OA_SOCIAL_LOGIN_DO_ENABLE_DESC' => 'Permette di disabilitare temporaneamente Social Login senza doverlo rimuovere.',
	'OA_SOCIAL_LOGIN_DO_ENABLE_NO' => 'Disabilita',
	'OA_SOCIAL_LOGIN_DO_ENABLE_YES' => 'Abilita',

	'OA_SOCIAL_LOGIN_DO_LINKING' => 'Abilitare il collegamento degli account social?',
	'OA_SOCIAL_LOGIN_DO_LINKING_ASK' => 'Collegare automaticamente gli account dei Social Network agli utenti esistenti?',
	'OA_SOCIAL_LOGIN_DO_LINKING_DESC' => 'Se abilitato, gli account dei social network con email verificatasaranno collegati agli utenti del forum esistenti, che avessero la stessa email.',
	'OA_SOCIAL_LOGIN_DO_LINKING_NO' => 'Disabilita il collegamento degli account',
	'OA_SOCIAL_LOGIN_DO_LINKING_YES' => 'Abilita il collegamento degli account',

	'OA_SOCIAL_LOGIN_DO_REDIRECT' => 'Reindirizzamento',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_ASK' => 'Rimanda gli utenti a questa pagina dopo che si siano connessi con i loro account dei social network',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_DESC' => 'Inserisci un URL completo ad una pagina del tuo forum phpBB. Se lasciato vuoto, gli utenti resteranno sulla stessa pagina.',

	'OA_SOCIAL_LOGIN_DO_VALIDATION' => 'Richiedi validazione del profilo del nuovo utente?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ALWAYS' => 'Abilita validazione profilo',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ASK' => 'Richiedi al nuovo utente di validare nome utente ed email ?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DEPENDS' => 'Validazione profilo solo se necessario',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DESC' => 'Se abilitato, ai nuovi utente sarà richiesto di completare o controllare il loro nome utente e la email.<br />La validazione obbligatoria occorre solo nal caso in cui il nome utente sia già preso, sia mancante la email, oppure la email sia già presa ed il Social Link sia disabilitato.',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_NEVER' => 'Disabilita validazione del profilo',

	'OA_SOCIAL_LOGIN_ENABLE_NETWORKS' => 'Scegli i social networks da abilitare sul tuo forum',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Devi abilitare almeno un social network',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Devi impostare le tue Credenziali API',

	'OA_SOCIAL_LOGIN_FSOCKOPEN' => 'PHP FSOCKOPEN',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DESC' => 'Usa FSOCKOPEN solo se hai un qualsiasi problema con CURL.',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DOCS' => '<a href="http://www.php.net/manual/en/function.fsockopen.php" class="external">Manuale FSOCKOPEN</a>',

	'OA_SOCIAL_LOGIN_INDEX_PAGE' => 'Forum Homepage',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION' => 'Testo della pagina principale',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION_DESC' => 'Questo titolo è mostrato sopra le icone Social Login nella pagina principale.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE' => 'Mostra nella pagina principale?',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE_DESC' => 'Se abilitato, Social Login sarà mostrato nella pagina principale.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_YES' => 'Si, mostra nella pagina principale',

	'OA_SOCIAL_LOGIN_LOGIN_PAGE' => 'Pagina accesso del forum',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION' => 'Testo della pagina di accesso',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION_DESC' => 'Questo titolo sarà mostrato sopra le icone Social Login nella pagina di accesso.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE' => 'Mostrare sull apagina di accesso?',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE_DESC' => 'Se abilitato, Social Login sarà mostrato sulla pagina di accesso.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_YES' => 'Si, mostra sulla pagina di accesso',

	'OA_SOCIAL_LOGIN_INLINE_PAGE' => 'Pagina accesso del forum (visualizzazione inline[=allineata al testo])',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION' => 'Testo della maschera di accesso',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION_DESC' => 'Questo titolo è mostrato sopra le icone dei Social Login contenute inline nella pagina di accesso.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE' => 'Mostrare come modulo inline sulla pagina di accesso?',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE_DESC' => 'Se abilitato, Social Login sarà incluso come modulo inline sulla pagina di accesso. Per abilitare la visualizzazione inline devi selezionare OneAll come metodo di autenticazione nelle impostazioni GENERALE \ GESTIONE COMUNICAZIONI \ AUTENTICAZIONE.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_YES' => 'Si, mostra inline nella pagina di accesso',

	'OA_SOCIAL_LOGIN_OTHER_PAGE' => 'Ogni altra pagina',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION' => 'Testo sulle altre pagine',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION_DESC' => 'Questo titolo è mostrato sopra le icone Social Login icons sulle altre pagine.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE' => 'Mostra su tutte le altre pagine?',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE_DESC' => 'Se abilitato, Social Login sarà mostrato anche su ogni altra pagina del forum.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_YES' => 'Si, mostra su ogni altra pagina',

	'OA_SOCIAL_LOGIN_PORT_443' => 'Comunicazione sulla porta 443/HTTPS',
	'OA_SOCIAL_LOGIN_PORT_443_DESC' => 'Usare la porta 443 è raccomandato, ma dovresti installare (o avere disponibile) OpenSSL sul tuo server.',
	'OA_SOCIAL_LOGIN_PORT_80' => 'Comunicazione sulla porta 80/HTTP',
	'OA_SOCIAL_LOGIN_PORT_80_DESC' => 'Usare la porta 80 è leggermente più veloce, non serve OpenSSL, ma è meno sicuro.',

	'OA_SOCIAL_LOGIN_PROFILE_DESC' => 'Collega il tuo account ad un Social Network',
	'OA_SOCIAL_LOGIN_PROFILE_TITLE' => 'Social Login',

	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE' => 'Pagina di registrazione del forum',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION' => 'Testo della pagina di registrazione',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION_DESC' => 'Questo titolo è mostrato sopra le icone Social Login icons nella pagina di registrazione.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE' => 'Mostrare nella pagina di registrazione?',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE_DESC' => 'Se abilitato, Social Login sarà mostrato nella pagina di registrazione.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_NO' => 'No',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_YES' => 'Si, mostra nella pagina di registrazione',

	'OA_SOCIAL_LOGIN_SETTINGS' => 'Impostazioni',
	'OA_SOCIAL_LOGIN_SETTINGS_UPDATED' => 'Impostazioni aggiornate correttamente.',
	'OA_SOCIAL_LOGIN_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Imposta il mio account gratuito</a>',

	'OA_SOCIAL_LOGIN_TITLE' => 'OneAll Social Login',
	'OA_SOCIAL_LOGIN_TITLE_HELP' => 'Aiuto, Aggiornamenti &amp; Documentazione',

	'OA_SOCIAL_LOGIN_VALIDATION_FORM_DESC' => 'L’amministratore richiede che tu riveda o completi il tuo username ed indirizzo email.',
	'OA_SOCIAL_LOGIN_VALIDATION_FORM_HEADER' => 'Convalida il tuo username ed indirizzo email',
	'OA_SOCIAL_LOGIN_VALIDATION_SESSION_ERROR' => 'Informazioni di sessione mancanti.'
));
