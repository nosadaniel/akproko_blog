$(document).ready(function(){
	//to display user profile
	display_user_profile();
	function display_user_profile(){
		$.ajax({
			url:'../ajax/display_users.php',
			method:'POST',
			data:{user_profile:1},
			success: function(data){
				$('#user_profile').html(data);
			}
		})
	}
	// to change username
	$('#change_name').submit(function(e){
		e.preventDefault();
		var user = $('#user_name').val();
		var password = $('#password').val();
		if (user=='' || password==''){
			$('#report_err').html('<div class="well text-danger" style="padding-bottom: 5px;  padding-top: 2px; padding-left: 10px;">All Fields Are Required</div>');
		}
		else{
			$('#report_err').html('');
			$.ajax({
				url:'../ajax/display_users.php',
				method: 'POST',
				cache: false,
				data: {name_change:1, user:user, password:password},
				beforeSend: function(){
					// change submit button value text and disabled it
					$('#save_changes').val('authenticating...').attr('disabled', 'disabled');
				},
				success: function(data){
					if (data == '39ia;k#aw'){
						$('#save_changes').val('Close').attr('disabled', 'disabled');
						$('#report_error').html('<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p><strong>Username was successfully changed</strong>...You can now logout and then login with your new Username <b>' +user+'</b></p><div>');
						$('#password').val('');
						$('#user_name').val('');
					}
					else{
						$('#report_error').html(data);
						$('#password').val('');
						$('#save_changes').val('').removeAttr('disabled');
					}
				}
			})
		}
	})
	// to change password
	$('#change_password').submit(function(e){
		e.preventDefault();
		var msg = false;
		var msg2 = false;
		var old_pass = $('#password_old').val();
		var new_pass = $('#password_new').val();
		if (old_pass !='' && new_pass!=''){
			if ((new_pass.length <=4) ) {
				$('#report_err_pass').html('');
				$('#err_msg').html('<div class="well text-danger" style="padding-bottom: 5px;  padding-top: 2px; padding-left: 10px;">Password must be atleast 5 characters long</div>');
				msg = true;
			}
			if(old_pass==new_pass){
				$('#report_err_pass').html('');
				$('#err_msg').html('<div class="well text-danger" style="padding-bottom: 5px;  padding-top: 2px; padding-left: 10px;">Your New Password Must be Different From The Existing One</div>');
				msg2 = true;
			}
			if (msg==false && msg2==false){
				$('#report_err_pass').html('');
				$.ajax({
					url:'../ajax/display_users.php',
					method: 'POST',
					cache: false,
					data: {change_password:1, old_pass:old_pass, new_pass:new_pass},
					beforeSend: function(){
						// change submit button value text and disabled it
						$('#submit_password').val('authenticating...').attr('disabled', 'disabled');
					},
					success: function(data){
						if (data == 'alfjoawf34awp87'){
							$('#submit_password').val('Close').attr('disabled', 'disabled');
							$('#report_error_pass').html('<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p><strong>Password Change Successfully</strong>...You can now logout and then login with your new password</p><div>');
							$('#password_new').val('');
							$('#password_old').val('');
						}
						else{
							$('#report_error_pass').html(data);
							$('#password_new').val('');
							$('#err_msg').html('');
							$('#submit_password').val('').removeAttr('disabled');
						}
					}
				})
			}
		}
		else{
			$('#report_err_pass').html('<div class="well text-danger" style="padding-bottom: 5px;  padding-top: 2px; padding-left: 10px;">All Fields Are Required</div>');
		}
	})
});