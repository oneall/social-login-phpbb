diff -r social_login/social_login_core.module /var/www/tests/drupal001_loc/modules/social_login/social_login_core.module
264a265,266
>           
>           watchdog('social_login_core', 'FOO '. print_r($_SESSION, true), WATCHDOG_ERROR);
877a880,884
>       // User fields (depends on name defined!):
>       $user_firstname = empty($identity['name']['givenName']) ? '' : $identity['name']['givenName']; 
>       $user_lastname = empty($identity['name']['familyName']) ? '' : $identity['name']['familyName'];
>       $form['field_first_name'][LANGUAGE_NONE][0]['value']['#default_value'] = $user_firstname;
>       $form['field_last_name'][LANGUAGE_NONE][0]['value']['#default_value'] = $user_lastname;

