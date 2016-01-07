<?php
/**
 * @file
 * Contains \Drupal\social_login\Form\SocialLoginBlockForm.
 */

namespace Drupal\social_login\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Unicode;
use Drupal\Core\Url;

/**
 * Builds the Social Login form for the Social Login block.
 */
class SocialLoginBlockForm extends FormBase {
	/**
	 * {@inheritdoc}
	 */
	public function getFormId() {
		return 'social_login_block_form';
	}
	/**
	 * {@inheritdoc}
	 */
	public function getEditableConfigNames() {
		return array();
	}
	/**
	 * {@inheritdoc}
	 */
	public function submitForm(array &$form, FormStateInterface $form_state) {
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(array $form, FormStateInterface $form_state) {
		global $is_https;

		// Read Settings.
		$settings = \social_login_get_settings();

		$title = $settings['login_page_caption'];

		$containerid = 'social_login_providers_' . rand(99999, 9999999);
		
		\social_login_add_js_plugin($form, $settings['api_subdomain']);

		$current_uri = \social_login_get_current_url($is_https);
		$callback_uri = Url::fromRoute('social_login.core', [], array('absolute' => TRUE, 'query' => array('origin' => $current_uri)))->toString();

		$provider_string = "\"". implode("\",\"", $settings['enabled_providers']) ."\"";

		$form['social_login_' . $containerid] = array(
				'#label' => $title,
				'#weight' => 0,
				// render the TWIG template, with it's variables and JS:
				'#theme' => 'provider_container',
				'#containerid' => $containerid,
				'#plugintype' => 'social_login',
				'#providers' => $provider_string,
				'#token' => '',
				'#callbackuri' => $callback_uri,
				// Caching: the cache tag is the callback uri (so we can redirect to the same page), so the url context is suitable:
				'#cache' => array(
					'contexts' => array('url'),
				),
		);
		$renderer = \Drupal::service('renderer');
		$renderer->addCacheableDependency($form, $callback_uri);
		return $form;
	}

}
?>