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
	$oa_vars = array(
    	'account' => array('label' => t('User account'),'type' => 'user', 'description' => 'User created.')
    );
	$oa_fields = social_login_core_profilefields(); /* called without argument returns profile definition. */
    foreach ($oa_fields as $name => $desc) {
    	$oa_vars[$name] = array_intersect_key($desc, array('label' => true, 'type' => true, 'description' => true));
    }
	return array(
		/* Rules event when OneAll user is created */
		'social_login_core_user_insert' => 
			array(
				'label' => t('OneAll registered user.'),
				'group' => t('OneAll Social Login'),
				'variables' => $oa_vars,
			),
	);
}


