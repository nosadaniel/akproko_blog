$(document).ready(function(){
	//to validate the process of adding admin users
	$('#add_user').submit(function(){		
		var sel_err=false;
		var msgum = false;
		var msgeea= false;
		var msgeeas = false;

		var submit = $('#submit_user');
		var user = $('#user_name').val();
		var user_email = $('#user_email').val();
		var user_password = $('#user_password').val();
		var user_confirm_password = $('#user_confirm_password').val();
		var user_gender = $('#gender').val();
		var user_dob = $('#user_dob').val();
		if (user!='' && user_email!='' && user_password !='' && user_confirm_password!='' && user_dob!='' ){
			if (user_gender==''){
				$('#msg0').html('<div class="well text-danger" style="padding-bottom: 5px;  padding-top: 2px; padding-left: 10px;">Please select your gender</div>');
				sel_err=true;
			}
			if ((user.length < 2) || (user.length >21) ) {
				$('#msg1').html('<div class="well text-danger" style="padding-bottom: 5px;  padding-top: 2px; padding-left: 10px;">User name must between 2 to 20 characters</div>');
				msgum=true;
			}
			if (user_password.length<=4 ){
				$('#msg2').html('<div class="well text-danger" style="padding-bottom: 5px;  padding-top: 2px; padding-left: 10px;">Password must be atleast 5 characters long</div>'); 
				msgeea=true;
			}
			if(user_password != user_confirm_password){
				$('#msg3').html('<div class="well text-danger" style="padding-bottom: 5px;  padding-top: 2px; padding-left: 10px;">Password do not march...Please try again</div>');
				msgeeas=true;
			}
			if (sel_err==false && msgum==false && msgeea==false && msgeeas==false) {
				return true;
			}
			else{
				return false;
			}
		}
	})
})