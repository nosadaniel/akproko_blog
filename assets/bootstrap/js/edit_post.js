$(document).ready(function(){
	//to validate edited post
	$('#submit').click(function(){
		var post_title = $('#post_title').val();
		var post_content =  $('#post_content').text();
		var img = $('.img').val();
		var img_extension = img.split('.').pop().toLowerCase();
		var post_author = $('#post_author').val();
		var post_heading =  $('#post_heading').find(':selected').text();
		
		$('#sel_err').html('');
			$('#img_err').html('');
		if (jQuery.inArray(img_extension, ['jpg','png', 'jpeg', 'gif']) == -1)
		{
			$('#img_err').html('Image must be jpg, png, jpeg or gif and it must not be empty');
			return false;
		}
		if(post_heading=='Select'){
			$('#sel_err').html('No post heading selected...Please make a selection');
			return false;
		}
		if (post_heading=='' || img=='' || post_author=='' || post_title==''){
			$('#err').html('All fields are required');
			return false;
		}
		else{
			return true;
		}
	})
	
});