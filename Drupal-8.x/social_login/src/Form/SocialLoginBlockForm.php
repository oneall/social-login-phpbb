<?php

namespace Drupal\social_login\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\Request;

/**
 * Builds the form for the Social Login block.
 */
class SocialLoginBlockForm extends FormBase {

  /**
   * Determines the ID of the form.
   */
  public function getFormId() {
    return 'social_login_block_form';
  }

  /**
   * Gets the configuration names that will be editable.
   */
  public function getEditableConfigNames() {
    return array();
  }

  /**
   * Form submission handler.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * Form constructor.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

  	// Are we using HTTPs?
  	$is_https = Drupal::request()->isSecure();

    // Read Settings.
    $settings = \social_login_get_settings();

    $title = $settings['login_page_caption'];

    $containerid = 'social_login_providers_' . rand(99999, 9999999);

    social_login_add_js_plugin($form, $settings['api_subdomain']);

    $current_uri = \social_login_get_current_url($is_https);
    $callback_uri = Url::fromRoute('social_login.core', [], array(
      'absolute' => TRUE,
      'query' => array(
        'origin' => $current_uri,
      ),
    ))->toString();

    $provider_string = "\"" . implode("\",\"", $settings['enabled_providers']) . "\"";

    $form['social_login_' . $containerid] = array(
      '#label' => $title,
      '#weight' => 0,
      '#theme' => 'provider_container',
      '#containerid' => $containerid,
      '#plugintype' => 'social_login',
      '#providers' => $provider_string,
      '#token' => '',
      '#callbackuri' => $callback_uri,
      // The cache tag is the callback uri (redirect to the same page).
      '#cache' => array(
        'contexts' => array(
          'url',
        ),
      ),
    );

    $renderer = \Drupal::service('renderer');
    $renderer->addCacheableDependency($form, $callback_uri);
    return $form;
  }
}
