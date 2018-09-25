$(document).ready(function(){
	$('#suggest_form').submit(function(e){
		e.preventDefault();
		var submit_btn = $('#submit');
		var user_name = $('#user_name').val();
		var user_email = $('#user_email').val();
		var user_comment = $('#user_comment').val();
		var name_err, email_err, commment_err;
		name_err=email_err=commment_err=false;
		if (user_name==''){
			$('#user_name').attr('placeholder','Please enter your name');
			 $('#user_name').css('border', '1px solid #FEAFAF');
			 name_err = true;
		}
		if(user_name.length==1 || user_name.length>20){
			$('#user_name').attr('placeholder','name must be between 2 to 20 characters long');
			 $('#user_name').css('border', '1px solid #FEAFAF');
			 $('#user_name').val('');
			 name_err =  true;
		}
		if (user_email==''){
			$('#user_email').attr('placeholder','Please enter your email address');
			 $('#user_email').css('border', '1px solid #FEAFAF');
			 email_err= true;
		}
		if (user_comment==''){
			$('#user_comment').attr('placeholder','Please make your suggestion...');
			 $('#user_comment').css('border', '1px solid #FEAFAF');
			
			 commment_err = true;
		}
		if (name_err==false && email_err==false && commment_err==false){			
			$.ajax({
				url:'ajax/suggest.php',
				method:'post',
				data:{suggest:1,user_name, user_email, user_comment},
				beforeSend: function(){
					submit_btn.val('submitting').attr('disable', 'disable');
				},
				success: function(data){
					$('form').trigger('reset');
					submit_btn.val('').removeAttr('disable');
					$('#msg').html(data);
				}
			});
		}

	});
});