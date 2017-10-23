<?php
/**
 * @package   	OneAll Social Login Mod
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
if (!defined ('IN_PHPBB'))
{
	exit;
}

if (!isset ($lang) || !is_array ($lang))
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
// in a URL you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
$lang = array_merge ($lang,
	array (
		'OASL_DO_AVATARS' => 'Utiliser les avatars des réseaux sociaux?',
		'OASL_DO_AVATARS_DESC' => 'Télécharge l\'avatar du profile social de l\'utilisateur et enregistre l\'image dans votre répertoire d\'avatars.',
		'OASL_DO_AVATARS_ENABLE_YES' => 'Oui, télécharger les avatars des réseaux sociaux',
		'OASL_DO_AVATARS_ENABLE_NO' => 'Oui, ne pas télécharger les avatars',
		'OASL_PROFILE_TITLE' => 'Connexion avec Social Login',
		'OASL_PROFILE_DESC' => 'Liez votre compte à un réseau social',
		'OASL_WIDGET_TITLE' => 'Connexion avec un réseau social:',
		'OASL_SETTNGS_UPDATED' => 'Paramètres mis à jour avec succès.',
		'OASL_INTRO' => 'Permet à vos utilisateurs de se connecter et de s\'enregistrer avec les résaux sociaux tels que Twitter, Facebook, LinkedIn, Hyves, VKontakte, Google et Yahoo pour ne citer qu\'eux. Social Login <strong>augmente le nombre d\'utilisateurs enregistrés</strong> en simplifiant le processus d\'enregistrement et permet de <strong>récupérer les données des profils sociaux (opt-in)</strong>. Social Login s\'intègre parfaitement avec votre système d\'enregistrement et vos utilisateurs n\'ont pas à remplir tous les champs de votre formulaire d\'enregistrement.',
		'OASL_TITLE' => 'OneAll Social Login',
		'OASL_TITLE_HELP' => 'Aide, mises à jour et documentation',
		'OASL_FOLLOW_US_TWITTER' => '<a href="http://www.twitter.com/oneall" class="external">Suivez nous</a> sur Twitter pour être informé des mises à jour;',
		'OASL_READ_DOCS' => '<a href="http://docs.oneall.com/plugins/" class="external">Lisez</a> la documentation en ligne pour plus d\'information sur ce plugin;',
		'OASL_DISCOVER_PLUGINS' => '<a href="http://docs.oneall.com/plugins/" class="external">Découvrez</a> nos plugins clé en main pour  Drupal, Joomla, WordPress;',
		'OASL_GET_HELP' => '<a href="http://www.oneall.com/company/contact-us/" class="external">Contactez nous</a> si vous avez des commentaires ou besoin d\'aide!',
		'OASL_CREATE_ACCOUNT_FIRST' => 'Pour pouvoir utiliser Social Login, vous devez d\'abord créer un compte gratuit ici : <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a> et configurer un Site.',
		'OASL_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Mettre en place mon compte gratuit</a>',
		'OASL_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Créer et vérifier mes paramètres pour l\'API</a>',
		'OASL_API_CONNECTION' => 'Connexion API',
		'OASL_API_CONNECTION_HANDLER' => 'Gestionnaire de connexion API:',
		'OASL_CURL' => 'PHP CURL',
		'OASL_CURL_DESC' => 'L\'utilisation de CURL est recommandée mais l\'extension peut être désactivée sur certains serveurs.',
		'OASL_CURL_DOCS' => '<a href="http://www.php.net/manual/en/book.curl.php" class="external">Manuel d\'utilisation de CURL</a>',
		'OASL_FSOCKOPEN' => 'PHP FSOCKOPEN',
		'OASL_FSOCKOPEN_DESC' => 'Utilisez FSOCKOPEN si vous rencontrez des problèmes avec CURL.',
		'OASL_FSOCKOPEN_DOCS' => '<a href="http://www.php.net/manual/en/function.fsockopen.php" class="external">Manuel d\'utilisation de FSOCKOPEN</a>',
		'OASL_API_PORT' => 'Port de connexion pour l\'API:',
		'OASL_PORT_443' => 'Communiquez sur le port 443 (HTTPS)',
		'OASL_PORT_443_DESC' => 'L\'utilisation du  port 443 est recommandée cependant l\'installation de OpenSSL peut être requise sur votre serveur.',
		'OASL_PORT_80' => 'Communication via HTTP sur le port 80',
		'OASL_PORT_80_DESC' => 'L\'utilsation du port 80 est légèrement plus rapide, et ne demande pas l\installation de OpenSSL, mais elle est moins sécurisée.',
		'OASL_API_AUTODETECT' => 'Détecter automatiquement le type de connexion pour l\'API',
		'OASL_API_CREDENTIALS_TITLE' => 'Clés API - <a href="https://app.oneall.com/applications/" class="external">Cliquez ici pour créer ou voir vos clés API</a>',
		'OASL_API_SUBDOMAIN' => 'Sous domaine de l\'API:',
		'OASL_API_PUBLIC_KEY' => 'Clé publique de l\'API:',
		'OASL_API_PRIVATE_KEY' => 'Clé privée de l\'API:',
		'OASL_API_VERIFY' => 'Vérifier les paramètres de l\'API',
		'OASL_ENABLE_NETWORKS' => 'Activer les réseaux sociaux ou fournisseurs d\'identification de votre choix',
		'OASL_DO_ENABLE' => 'Activer Social Login?',
		'OASL_DO_ENABLE_DESC' => 'Vous permet de désactiver Social Login de manière temporaire sans avoir à le désinstaller.',
		'OASL_DO_ENABLE_YES' => 'Activer Social Login',
		'OASL_DO_ENABLE_NO' => 'Desactiver Social Login',
		'OASL_DEFAULT' => 'Défaut',
		'OASL_DO_LINKING' => 'Activer la liaison automatique?',
		'OASL_DO_LINKING_ASK' => 'Lier automatiquement les comptes des réseaux sociaux aux comptes qui existent déjà?',
		'OASL_DO_LINKING_DESC' => 'Si activé, les comptes des réseaux sociaux avec une adresse email vérifiée seront liés aux comptes utilisateurs phpBB qui ont la même address email.',
		'OASL_DO_LINKING_YES' => 'Activer les liens entre les comptes',
		'OASL_DO_LINKING_NO' => 'Désactiver les liens entre les comptes',
		'OASL_DO_REDIRECT' => 'Paramétrage de la redirection',
		'OASL_DO_REDIRECT_ASK' => 'Rediriger les utilisateurs vers cette page après lorsque la connexion avec le compte de réseau social est terminée :',
		'OASL_DO_REDIRECT_DESC' => 'Entrez une URL complète vers une page de votre forum phpBB. Si le paramètre est vide, l\'utilisateur reste sur la même page.',
		'OASL_API_DETECT_CURL' => 'CURL détecté sur le port %s - n\'oubliez pas de sauvegarder vos changements!',
		'OASL_API_DETECT_FSOCKOPEN' => 'FSOCKOPEN détecté sur le port %s - n\'oubliez pas de sauvegarder vos changements!',
		'OASL_API_DETECT_NONE' => 'Connexion échouée! Votre pare-feu doit autoriser les requêtes sortantes  sur les ports 80 ou 443.',
		'OASL_API_CREDENTIALS_FILL_OUT' => 'Remplissez SVP chacun des champs ci-dessus.',
		'OASL_API_CREDENTIALS_USE_AUTO' => 'Le gestionnaire de connexion semble ne pas fonctionner. Utilisez la détection automatique.',
		'OASL_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'Le sous domaine n\'existe pas. Avez vous rempli le champ correctement ?',
		'OASL_API_CREDENTIALS_KEYS_WRONG' => 'Les clés de l\API sont incorrectes, vérifiez votre clé publique et votre clé privée.',
		'OASL_API_CREDENTIALS_CHECK_COM' => 'Ne peut pas contacter l\'API. Le paramétrage de l\'API est il correct ?',
		'OASL_API_CREDENTIALS_UNKNOW_ERROR' => 'Réponse inconnue- Vérifiez que vous êtes bien connectés!',
		'OASL_API_CREDENTIALS_OK' => 'Le paramétrage est correct - n\'oubliez pas de sauvegarder vos changements',
		'OASL_SETTINGS' => 'Paramétrage OneAll Social Login',
		'OASL_ENABLE_SOCIAL_NETWORK' => 'Vous devez activer au moins un réseau social',
		'OASL_ENTER_CREDENTIALS' => 'Vous devez paramétrer vos clés d\'API',
		'OASL_ACCOUNT_ALREADY_LINKED' => 'Le compte de ce réseau social est déjà lié à un compte existant sur ce forum.',
		'OASL_ACCOUNT_INACTIVE_OTHER' => 'Le compte a été créé. Cependant le forum requière une activation.<br />Une clé d\'activation a été envoyée vers votre adresse email.',
		'OASL_ACCOUNT_INACTIVE_ADMIN' => 'Le compte a été créé. Cependant le forum requière une activation par une administrateur.<br />Un message à été envoyé vers les administrateurs et vous serz informé par email lorsque votre compte sera activé.'
	));
