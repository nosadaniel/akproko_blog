$(document).ready(function(){
	//to validate and login admin user
	var submit = $('#login_btn');
	$('#form_login').submit(function(e){
		e.preventDefault();
		//var all = $('#form_login').serialize();
		var user = $('#user_name').val();
		var password = $('#password').val();
		if(user == '' || password == ''){
			$('#msg').html("<div class='alert alert-danger aleart-dismissable'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><p><strong>ALL FIELDS ARE REQUIRED...</strong></p></div>");
		}
		else{
			$.ajax({
				url:'../ajax/login_page.php',
				method: 'POST',
				cache: false,
				data: {log_on:1, user:user, password:password},
				beforeSend: function(){
					// change submit button value text and disabled it
					submit.val('authenticating...').attr('disabled', 'disabled');
				},
				success: function(data){
					if (data == 'afwawwawfaawafwsdsa2e4rq5'){
						window.location.href = 'dashboard.php';
						$('form').trigger('reset');
						submit.val('').removeAttr('disabled');
					}
					else{
						$('#msg').html(data);
						$('#password').val('');
						submit.val('').removeAttr('disabled');
					}
				}
			})
		}
		
	});
});