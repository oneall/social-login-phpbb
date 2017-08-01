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
 * French translations by Galixte
 * http://www.galixte.com
 */

/**
 * DO NOT CHANGE
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
	'OA_SOCIAL_LOGIN_ACP' => 'Passerelle de connexion OneAll',
	'OA_SOCIAL_LOGIN_ACP_SETTINGS' => 'Paramètres',
	'OA_SOCIAL_LOGIN_API_AUTODETECT' => 'Détection automatique de la connexion à l’API',
	'OA_SOCIAL_LOGIN_API_CONNECTION' => 'Connexion à l’API',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER' => 'Gestionnaires de connexion à l’API',
	'OA_SOCIAL_LOGIN_API_CONNECTION_HANDLER_DESC' => 'OneAll est un gestionnaire de connexions aux API.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_CHECK_COM' => 'Impossible de se connecter à l’API. Est-ce que la connexion à l’API a été configurée correctement ?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_FILL_OUT' => 'Merci de remplir chacun des champs ci-dessus.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_KEYS_WRONG' => 'Les certificats d’API sont incorrects, merci de vérifier les clés publiques et privées.',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_OK' => 'Les paramètres sont corrects - Ne pas oublier de sauvegarder les changements !',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'Le sous domaine n’existe pas. A t-il été rempli correctement ?',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_TITLE' => 'Certificats d’API - <a href="https://app.oneall.com/applications/" class="external">Cliquer ici pour créer et voir ses certificats d’API</a>',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_UNKNOW_ERROR' => 'Réponse inconnue - Merci de s’assurer que la connexion est établie !',
	'OA_SOCIAL_LOGIN_API_CREDENTIALS_USE_AUTO' => 'Le gestionnaire de connexion ne semble pas fonctionner. Merci d’utiliser la détection automatique.',
	'OA_SOCIAL_LOGIN_API_DETECT_CURL' => 'CURL a été détecté sur le port %s - Ne pas oublier de sauvegarder les changements !',
	'OA_SOCIAL_LOGIN_API_DETECT_FSOCKOPEN' => 'FSOCKOPEN a été détecté sur le port %s - Ne pas oublier de sauvegarder les changements !',
	'OA_SOCIAL_LOGIN_API_DETECT_NONE' => 'La connexion a échouée ! Votre pare-feu doit permettre les requêtes sortantes soit sur le port 80 ou 443.',
	'OA_SOCIAL_LOGIN_API_PORT' => 'Port de connexion à l’API',
	'OA_SOCIAL_LOGIN_API_PORT_DESC' => 'Votre pare-feu doit autoriser les requêtes sortantes sur un le port 80 ou 443.',
	'OA_SOCIAL_LOGIN_API_PRIVATE_KEY' => 'Clé privé l’API',
	'OA_SOCIAL_LOGIN_API_PUBLIC_KEY' => 'Clé publique l’API',
	'OA_SOCIAL_LOGIN_API_SUBDOMAIN' => 'Sous domaine de l’API',
	'OA_SOCIAL_LOGIN_API_VERIFY' => 'Paramètres de vérification de l’API',
	'OA_SOCIAL_LOGIN_CREATE_ACCOUNT_FIRST' => 'Pour utiliser la passerelle de connexion OneAll, au préalable il doit être créé un compte gratuit sur <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a> et configurer un site.',
	'OA_SOCIAL_LOGIN_CURL' => 'PHP CURL',
	'OA_SOCIAL_LOGIN_CURL_DESC' => 'L’utilisation de CURL est recommandé mais peut être désactivé sur certains serveurs.',
	'OA_SOCIAL_LOGIN_CURL_DOCS' => '<a href="http://www.php.net/manual/en/book.curl.php" class="external">Manuel de CURL</a>',
	'OA_SOCIAL_LOGIN_DEFAULT' => 'Défaut',
	'OA_SOCIAL_LOGIN_DISCOVER_PLUGINS' => '<a href="http://docs.oneall.com/plugins/" class="external">Découvrir</a> nos plugins clés en main pour Drupal, Joomla, WordPress.',
	'OA_SOCIAL_LOGIN_DISPLAY_LOC' => 'Position de la passerelle de connexion OneAll',
	'OA_SOCIAL_LOGIN_DO_AVATARS' => 'Activer l’envoi d’avatars depuis les réseaux sociaux ?',
	'OA_SOCIAL_LOGIN_DO_AVATARS_DESC' => 'Permet de récupérer les avatars de l’utilisateur sur ses réseaux sociaux pour les envoyer dans le dossier des avatars de phpBB.',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_NO' => 'Non, ne pas utiliser les avatars des réseaux sociaux',
	'OA_SOCIAL_LOGIN_DO_AVATARS_ENABLE_YES' => 'Oui, utiliser les avatars des réseaux sociaux',
	'OA_SOCIAL_LOGIN_DO_ENABLE' => 'Activer la passerelle de connexion OneAll ?',
	'OA_SOCIAL_LOGIN_DO_ENABLE_DESC' => 'Permet de désactiver temporairement la passerelle de connexion OneAll sans avoir à l’enlever.',
	'OA_SOCIAL_LOGIN_DO_ENABLE_NO' => 'Désactiver',
	'OA_SOCIAL_LOGIN_DO_ENABLE_YES' => 'Activer',
	'OA_SOCIAL_LOGIN_DO_LINKING' => 'Activer la liaison des comptes avec les réseaux sociaux ?',
	'OA_SOCIAL_LOGIN_DO_LINKING_ASK' => 'Lier automatiquement les comptes des réseaux sociaux avec les comptes utilisateurs existants ?',
	'OA_SOCIAL_LOGIN_DO_LINKING_DESC' => 'Si activé, les comptes des réseaux sociaux avec une adresse e-mail vérifiée seront liés avec les comptes utilisateurs phpBB existants ayant la même adresse e-mail.',
	'OA_SOCIAL_LOGIN_DO_LINKING_NO' => 'Désactiver la liaison des comptes',
	'OA_SOCIAL_LOGIN_DO_LINKING_YES' => 'Activer la liaison des comptes',
	'OA_SOCIAL_LOGIN_DO_REDIRECT' => 'Redirection',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_ASK' => 'Rediriger les utilisateurs vers cette page après avoir été connecté avec leur compte de réseau social',
	'OA_SOCIAL_LOGIN_DO_REDIRECT_DESC' => 'Saisir une adresse URL complète vers une page de votre forum phpBB. Si aucune adresse n’est indiquée l’utilisateur restera sur la même page.',
	'OA_SOCIAL_LOGIN_DO_VALIDATION' => 'Demander la confirmation du profil aux nouveaux utilisateurs ?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ALWAYS' => 'Activer la confirmation du profil',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_ASK' => 'Demander aux nouveaux utilisateurs de saisir leur nom d’utilisateur et leur adresse e-mail ?',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DEPENDS' => 'Confirmation exceptionnelle du profil',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_DESC' => 'Si activé, les nouveaux utilisateurs seront invités à saisir ou confirmer leur nom d’utilisateur et leur adresse e-mail.<br /> Si sélectionnée, une confirmation exceptionnelle sera demandée uniquement si la connexion automatique au réseau social est désactivée, que le nom d’utilisateur est récupéré, que l’adresse e-mail est manquante mais a été récupérée.',
	'OA_SOCIAL_LOGIN_DO_VALIDATION_NEVER' => 'Désactiver la confirmation du profil',
	'OA_SOCIAL_LOGIN_ENABLE_NETWORKS' => 'Choisir les réseaux sociaux autorisés sur votre forum',
	'OA_SOCIAL_LOGIN_ENABLE_SOCIAL_NETWORK' => 'Au moins un réseau social doit être activé',
	'OA_SOCIAL_LOGIN_ENTER_CREDENTIALS' => 'Configurer ses certificats d’API',
	'OA_SOCIAL_LOGIN_FOLLOW_US_TWITTER' => '<a href="http://www.twitter.com/oneall" class="external">Nous suivre</a> sur Twitter pour rester informé des nouveautés.',
	'OA_SOCIAL_LOGIN_FSOCKOPEN' => 'PHP FSOCKOPEN',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DESC' => 'Utiliser uniquement FSOCKOPEN si des problèmes sont rencontrés avec CURL.',
	'OA_SOCIAL_LOGIN_FSOCKOPEN_DOCS' => '<a href="http://www.php.net/manual/en/function.fsockopen.php" class="external">Manuel de FSOCKOPEN</a>',
	'OA_SOCIAL_LOGIN_GET_HELP' => '<a href="http://www.oneall.com/company/contact-us/" class="external">Nous contacter</a> pour tout commentaire ou demande d’aide !',
	'OA_SOCIAL_LOGIN_INDEX_PAGE' => 'Page d’accueil du forum',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION' => 'Légende',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_CAPTION_DESC' => 'Ce titre sera affiché au-dessus des icônes de la passerelle de connexion OneAll sur la page d’accueil du forum.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE' => 'Activer la passerelle de connexion OneAll sur la page d’accueil du forum ?',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_ENABLE_DESC' => 'Si activé, la passerelle de connexion OneAll sera affichée sur la page d’accueil du forum.',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_NO' => 'Désactiver',
	'OA_SOCIAL_LOGIN_INDEX_PAGE_YES' => 'Activer',
	'OA_SOCIAL_LOGIN_INTRO' => 'Permet aux utilisateurs de se connecter et de s’enregistrer avec les réseaux sociaux tels que Twitter, Facebook, LinkedIn, Hyves, VKontakte, Google et Yahoo et bien d’autres.<br /> La passerelle de connexion OneAll <strong>permet d’augmenter le nombre de nouveaux utilisateurs</strong> en simplifiant l’enregistrement avec des informations <strong>récupérées depuis les profils des réseaux sociaux</strong> (les permissions utilisées sont basiques). La passerelle de connexion OneAll s’intègre au système d’enregistrement actuel du forum ainsi les utilisateurs n’auront pas à recommencer leur enregistrement sur le forum.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE' => 'Page de connexion du forum',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION' => 'Légende',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_CAPTION_DESC' => 'Ce titre sera affiché au-dessus des icônes de la passerelle de connexion OneAll sur la page de connexion du forum.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE' => 'Activer la passerelle de connexion OneAll sur la page de connexion du forum ?',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_ENABLE_DESC' => 'Si activé, la passerelle de connexion OneAll sera affichée sur la page de connexion du forum.',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_NO' => 'Désactiver',
	'OA_SOCIAL_LOGIN_LOGIN_PAGE_YES' => 'Activer',
	'OA_SOCIAL_LOGIN_INLINE_PAGE' => 'Page de login du forum (affichage intégré)',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION' => 'Légende',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_CAPTION_DESC' => 'Ce titre sera affiché au-dessus des icônes de la passerelle de connexion OneAll sur la page de login du forum.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE' => 'Intégrer la passerelle de connexion OneAll sur la page de login du forum ?',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_ENABLE_DESC' => 'Si activé, la passerelle de connexion OneAll sera intégrée à la page de login. Pour ceci il faut utiliser OneAll comme moyen d’authentification dans la config sous GENERAL \ COMMUNICATION \ AUTHENTIFICATION.',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_NO' => 'Désactiver',
	'OA_SOCIAL_LOGIN_INLINE_PAGE_YES' => 'Activer',
	'OA_SOCIAL_LOGIN_OTHER_PAGE' => 'Toutes les autres pages du forum',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION' => 'Légende',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_CAPTION_DESC' => 'Ce titre sera affiché au-dessus des icônes de la passerelle de connexion OneAll sur les autres pages du forum.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE' => 'Activer la passerelle de connexion OneAll sur les autres pages du forum ?',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_ENABLE_DESC' => 'Si activé, la passerelle de connexion OneAll sera affichée sur les autres pages du forum.',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_NO' => 'Désactiver',
	'OA_SOCIAL_LOGIN_OTHER_PAGE_YES' => 'Activer',
	'OA_SOCIAL_LOGIN_PORT_443' => 'Communication via HTTPS sur le port 443',
	'OA_SOCIAL_LOGIN_PORT_443_DESC' => 'L’utilisation du port 443 est recommandé, il est possible qu’il soit nécessaire d’installer OpenSSL sur le serveur d’hébergement du forum.',
	'OA_SOCIAL_LOGIN_PORT_80' => 'Communication via HTTP sur le port 80',
	'OA_SOCIAL_LOGIN_PORT_80_DESC' => 'L’utilisation du port 80 est un peu plus rapide, ne nécessite pas OpenSSL mais est moins sécurisé.',
	'OA_SOCIAL_LOGIN_PROFILE_DESC' => 'Lier votre compte à un réseau social',
	'OA_SOCIAL_LOGIN_PROFILE_TITLE' => 'Passerelle de connexion OneAll',
	'OA_SOCIAL_LOGIN_READ_DOCS' => '<a href="http://docs.oneall.com/plugins/guide/social-login-phpbb/3.1/" class="external">Lire</a> la documentation en ligne pour en savoir d’avantage sur ce plugin.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE' => 'Page d’inscription du forum',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION' => 'Légende',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_CAPTION_DESC' => 'Ce titre sera affiché au-dessus des icônes de la passerelle de connexion OneAll sur la page d’inscription du forum.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE' => 'Activer la passerelle de connexion OneAll sur la page d’inscription du forum ?',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_ENABLE_DESC' => 'Si activé, la passerelle de connexion OneAll sera affichée sur la page d’inscription du forum.',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_NO' => 'Désactiver',
	'OA_SOCIAL_LOGIN_REGISTRATION_PAGE_YES' => 'Activer',
	'OA_SOCIAL_LOGIN_SETTINGS' => 'Paramètres',
	'OA_SOCIAL_LOGIN_SETTNGS_UPDATED' => 'Paramètres mis à jour avec succès.',
	'OA_SOCIAL_LOGIN_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Configurer mon compte gratuit</a>',
	'OA_SOCIAL_LOGIN_SOCIAL_LINK' => 'Service de liens sociaux (Social Link)',
	'OA_SOCIAL_LOGIN_TITLE' => 'Passerelle de connexion OneAll',
	'OA_SOCIAL_LOGIN_TITLE_HELP' => 'Aide, mises à jour &amp; documentation',
	'OA_SOCIAL_LOGIN_VALIDATION_FORM_DESC' => 'L’administrateur requiert la saisie de votre nom d’utilisateur et de votre adresse e-mail.',
	'OA_SOCIAL_LOGIN_VALIDATION_FORM_HEADER' => 'Confirmer votre nom d’utilisateur et votre adresse e-mail.',
	'OA_SOCIAL_LOGIN_VALIDATION_SESSION_ERROR' => 'Des informations de la session courante sont manquantes.',
	'OA_SOCIAL_LOGIN_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Créer et voir mes certificats d’API</a>',
	'OA_SOCIAL_LOGIN_WIDGET_TITLE' => 'Connexion avec un réseau social',
	'G_OA_SOCIAL_LOGIN_REGISTER' => 'Utilisateurs inscrits via OneAll'
));
