jQuery(document).ready(function($) {

	/* Autodetect API Connection Handler */
	jQuery('#oa_social_login_autodetect_api_connection_handler').click(function() {
		var button = this;
		if 	(jQuery(button).hasClass('working') === false){		
			jQuery(button).addClass('working');
			
			var message_string;
			var message_container;
			var is_success;
	
			var data = {};
			var sid = jQuery('#sid').html();
			var ajaxurl = 'index.php?sid=' + sid + '&i=oa_social_login&mode=index&task=autodetect_api_connection';
	
			message_container = jQuery('#oa_social_login_api_connection_handler_result');
			message_container.removeClass('success_message error_message').addClass('working_message');
			message_container.html('Contacting API - please wait this may take a few minutes ...');
	
			jQuery.post(ajaxurl, data, function(response) {
		
				/* CURL/FSOCKOPEN Radio Box */
				var radio_curl = jQuery("#oa_social_login_api_connection_handler_curl");
				var radio_fsockopen = jQuery("#oa_social_login_api_connection_handler_fsockopen");
				var radio_port_80 = jQuery("#oa_social_login_api_connection_port_80");
				var radio_port_443 = jQuery("#oa_social_login_api_connection_port_443");
	
				radio_curl.removeAttr("checked");
				radio_fsockopen.removeAttr("checked");
				radio_port_80.removeAttr("checked");
				radio_port_443.removeAttr("checked");
	
				/* CURL detected, HTTPS */
				if (response == 'success_autodetect_api_curl_443') {
					is_success = true;
					radio_curl.attr("checked", "checked");
					radio_port_443.attr("checked", "checked");
					message_string = 'Detected CURL on Port 443 - do not forget to save your changes!';
				}
				/* CURL detected, HTTP */
				else if (response == 'success_autodetect_api_curl_80') {
					is_success = true;
					radio_curl.attr("checked", "checked");
					radio_port_80.attr("checked", "checked");
					message_string = 'Detected CURL on Port 80 - do not forget to save your changes!';
				}
				/* FSOCKOPEN detected, HTTPS */
				else if (response == 'success_autodetect_api_fsockopen_443') {
					is_success = true;
					radio_fsockopen.attr("checked", "checked");
					radio_port_443.attr("checked", "checked");
					message_string = 'Detected FSOCKOPEN on Port 443 - do not forget to save your changes!';
				}
				/* FSOCKOPEN detected, HTTP */
				else if (response == 'success_autodetect_api_fsockopen_80') {
					is_success = true;
					radio_fsockopen.attr("checked", "checked");
					radio_port_80.attr("checked", "checked");
					message_string = 'Detected FSOCKOPEN on Port 80 - do not forget to save your changes!';
				}
				/* No handler detected */
				else {
					is_success = false;
					radio_curl.attr("checked", "checked");
					radio_port_443.attr("checked", "checked");
					message_string = 'Autodetection Error';
				}
	
				message_container.removeClass('working_message');
				message_container.html(message_string);
	
				if (is_success) {
					message_container.addClass('success_message');
				} else {
					message_container.addClass('error_message');
				}
				
				jQuery(button).removeClass('working');
			});		
		}
		return false;
	});

	/* Verify API Settings */
	jQuery('#oa_social_login_test_api_settings').click(function() {
		var button = this;
		if 	(jQuery(button).hasClass('working') === false){		
			jQuery(button).addClass('working');
			var message_string;
			var message_container;
			var is_success;
	
			var radio_fsockopen_val = jQuery("#oa_social_login_api_connection_handler_fsockopen:checked").val();
			var radio_port_443 = jQuery("#oa_social_login_api_connection_port_443:checked").val();
	
			var subdomain = jQuery('#oa_social_login_api_subdomain').val();
			var key = jQuery('#oa_social_login_api_key').val();
			var secret = jQuery('#oa_social_login_api_secret').val();
			var handler = (radio_fsockopen_val === 'fsockopen' ? 'fsockopen' : 'curl');
			var use_https = (radio_port_443 === '443' ? '1' : '0');
			var sid = jQuery('#sid').html();
	
			var data = {
			  'api_subdomain' : subdomain,
			  'api_key' : key,
			  'api_secret' : secret,
			  'api_connection_handler' : handler,
			  'api_connection_use_https' : use_https,
			};
	
			var ajaxurl = 'index.php?sid=' + sid + '&i=oa_social_login&mode=index&task=verify_api_settings';
	
			message_container = jQuery('#oa_social_login_api_test_result');
			message_container.removeClass('success_message error_message').addClass('working_message');
			message_container.html('Contacting API - please wait this may take a few minutes ...');
	
			jQuery.post(ajaxurl, data, function(response) {
				
				is_success = false;
				if (response == 'error_selected_handler_faulty') {
					message_string = 'The connection handler does not seem to work. Please use the Autodetection.';
				} else if (response == 'error_not_all_fields_filled_out') {
					message_string = 'Please fill out each of the fields above.'
				} else if (response == 'error_subdomain_wrong') {
					message_string = 'The subdomain does not exist. Have you filled it out correctly?'
				} else if (response == 'error_subdomain_wrong_syntax') {
					message_string = 'The subdomain has a wrong syntax!'
				} else if (response == 'error_communication') {
					message_string = 'Could not contact API. Is the API connection setup properly?'
				} else if (response == 'error_authentication_credentials_wrong') {
					message_string = 'The API credentials are wrong, please check your keys.';
				} else if (response == 'success') {
					is_success = true;
					message_string = 'The settings are correct - do not forget to save your changes!';
				} else {
					message_string = 'Unknow response - please make sure that you are logged in!';
				}
	
				message_container.removeClass('working_message');
				message_container.html(message_string);
	
				if (is_success) {
					message_container.addClass('success_message');
				} else {
					message_container.addClass('error_message');
				}
				jQuery(button).removeClass('working');	
			});
		}
		return false;
	});
});