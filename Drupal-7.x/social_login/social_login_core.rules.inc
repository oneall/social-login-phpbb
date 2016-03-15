<?php
/**
 * @file
 * Functions for integrating the Oneall Social Login module with Rules.
 */

/**
 * Implements hook_rules_event_info().
 * @ingroup rules
 */
function social_login_core_rules_event_info() {
	$events = array();

	$events['social_login_core_user_insert'] = array(
			'label' => t('Update user with social identity data.'),
			'group' => t('OneAll Social Login'),
			'variables' => array(
					'account' => array(
							'label' => t('User account'),
							'type' => 'user',
					),
					'socialprovider' => array(
							'label' => t('Social identity'),
							'type' => 'text',
					),
			),
	);
	return $events;
}

