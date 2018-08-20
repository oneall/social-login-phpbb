<?php

namespace Drupal\social_login\Form;

use Drupal;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\Request;

/**
 * Builds the form for the Social Login block.
 */
class SocialLoginBlock extends FormBase
{
    /**
     * Determines the ID of the form.
     */
    public function getFormId()
    {
        return 'social_login_block_form';
    }

    /**
     * Gets the configuration names that will be editable.
     */
    public function getEditableConfigNames()
    {
        return [];
    }

    /**
     * Form submission handler.
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
    }

    /**
     * Form constructor.
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        // Are we using HTTPs?
        $is_https = Drupal::request()->isSecure();

        // Read Settings.
        $settings = \social_login_get_settings();

        // Container.
        $containerid = 'social_login_providers_' . rand(99999, 9999999);

        // Add library.
        social_login_add_js_plugin($form, $settings['api_subdomain']);

        // Get the current url.
        $current_uri = \social_login_get_current_url($is_https);

        // Build callback url.
        $callback_uri = Url::fromRoute('social_login.controller', [], [
            'absolute' => true,
            'query' => [
                'origin' => $current_uri
            ]
        ])->toString();

        // Social login form.
        $form['social_login'] = [
            '#theme' => 'provider_container',
            '#label' => $settings['login_page_caption'],
            '#weight' => 0,
            '#containerid' => $containerid,
            '#plugintype' => 'social_login',
            '#providers' => $settings['enabled_providers'],
            '#token' => '',
            '#callbackuri' => $callback_uri,
            // The cache tag is the callback uri (redirect to the same page).
            '#cache' => [
                'contexts' => [
                    'url'
                ]
            ]
        ];

        // Prevent caching.
        $renderer = \Drupal::service('renderer');
        $renderer->addCacheableDependency($form, $callback_uri);

        // Done.
        return $form;
    }
}
