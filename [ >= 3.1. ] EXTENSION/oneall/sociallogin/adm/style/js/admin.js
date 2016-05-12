jQuery.noConflict();

(function($) {
	$(function() {
		$(document).ready(function($) {
			
			/* Open links in new window */
			$('a.external').attr('target', '_blank');

			/* Autodetect API Connection Handler */
			$('#oa_social_login_autodetect_api_connection_handler').click(function() {

				var button = this;
				if ($(button).hasClass('working') === false) {
					$(button).addClass('working');

					var message_string;
					var message_container;

					var data = {};
					var sid = $('#sid').html();
					var ajaxurl = 'index.php?sid=' + sid + '&i=-oneall-sociallogin-acp-sociallogin_acp_module&mode=settings&task=autodetect_api_connection';

					message_container = $('#oa_social_login_api_connection_handler_result');
					message_container.removeClass('success_message error_message').addClass('working_message');
					message_container.html('');

					$.post(ajaxurl, data, function(response_string) {
						var response_parts = response_string.split('|');
						var response_status = response_parts[0];
						var response_flag = response_parts[1];
						var response_text = response_parts[2];

						/* CURL/FSOCKOPEN Radio Box */
						var radio_curl = $("#oa_social_login_api_connection_handler_curl");
						var radio_fsockopen = $("#oa_social_login_api_connection_handler_fsockopen");
						var radio_port_80 = $("#oa_social_login_api_connection_port_80");
						var radio_port_443 = $("#oa_social_login_api_connection_port_443");

						radio_curl.removeAttr("checked");
						radio_fsockopen.removeAttr("checked");
						radio_port_80.removeAttr("checked");
						radio_port_443.removeAttr("checked");

						/* CURL detected, HTTPS */
						if (response_flag == "curl_443") {
							radio_curl.prop("checked", true);
							radio_port_443.prop("checked", true);
						}
						/* CURL detected, HTTP */
						else if (response_flag == "curl_80") {
							radio_curl.prop("checked", true);
							radio_port_80.prop("checked", true);
						}
						/* FSOCKOPEN detected, HTTPS */
						else if (response_flag == "fsockopen_443") {
							radio_fsockopen.prop("checked", true);
							radio_port_443.prop("checked", true);
						}
						/* FSOCKOPEN detected, HTTP */
						else if (response_flag == "fsockopen_80") {
							radio_fsockopen.prop("checked", true);
							radio_port_80.prop("checked", true);
						}
						/* No handler detected */
						else {
							radio_curl.prop("checked", true);
							radio_port_443.prop("checked", true);
						}

						message_container.removeClass("working_message");
						message_container.html(response_text);

						if (response_status == "success") {
							message_container.addClass("success_message");
						} else {
							message_container.addClass("error_message");
						}

						$(button).removeClass("working");
					});
				}
				return false;
			});

			/* Verify API Settings */
			$('#oa_social_login_test_api_settings').click(function() {
				var button = this;
				if ($(button).hasClass('working') === false) {
					$(button).addClass('working');
					var message_string;
					var message_container;

					var radio_fsockopen_val = $("#oa_social_login_api_connection_handler_fsockopen:checked").val();
					var radio_port_443 = $("#oa_social_login_api_connection_port_443:checked").val();

					var subdomain = $('#oa_social_login_api_subdomain').val();
					var key = $('#oa_social_login_api_key').val();
					var secret = $('#oa_social_login_api_secret').val();
					
					/* Do not pass CURL in the URL, this is blocked by some hosts */
					var handler = (radio_fsockopen_val === 'fs' ? 'fs' : 'cr');
					var port = (radio_port_443 === '443' ? 443 : 80);
					var sid = $('#sid').html();

					var data = {
					  'api_subdomain' : subdomain,
					  'api_key' : key,
					  'api_secret' : secret,
					  'api_connection_port': port,
					  'api_connection_handler' : handler
					};

					var ajaxurl = 'index.php?sid=' + sid + '&i=-oneall-sociallogin-acp-sociallogin_acp_module&mode=settings&task=verify_api_settings';

					message_container = $('#oa_social_login_api_test_result');
					message_container.removeClass('success_message error_message').addClass('working_message');
					message_container.html('');

					$.post(ajaxurl, data, function(response_string) {

						var response_parts = response_string.split('|');
						var response_status = response_parts[0];
						var response_text = response_parts[1];

						message_container.removeClass('working_message');
						message_container.html(response_text);

						if (response_status == "success") {
							message_container.addClass('success_message');
						} else {
							message_container.addClass('error_message');
						}
						$(button).removeClass('working');
					});
				}
				return false;
			});
		});
	});
})(jQuery);
