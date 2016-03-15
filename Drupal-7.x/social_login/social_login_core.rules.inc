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
    	'account' => array('label' => t('User account'),'type' => 'user')
    );
	$oa_fields = social_login_core_listfields();
    foreach ($oa_fields as $name => $desc) {
    	$oa_vars[$name] = array_intersect_key($desc, array('label' => true, 'type' => true, 'description' => true));
    }
	return array(
		/* Rules event when OneAll user is created */
		'social_login_core_user_insert' => 
			array(
				'label' => t('OneAll user inserted.'),
				'group' => t('OneAll Social Login'),
				'variables' => $oa_vars,
			),
	);
}

