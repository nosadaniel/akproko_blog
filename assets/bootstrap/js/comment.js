$(document).ready(function(){
	$('#comment_btn').click(function(e){
		e.preventDefault();
		comment_click();
	})
});
//function to validate comments and receive data sent through ajax as JSON
function comment_click(){
	var validate1= false;
		var validate2 = false;
		var comment_name = $('#comment_name').val();
		var comment_text = $('#comment_body').val();
		var post_id = $('#p_id').val();
		if (comment_text=='' || post_id==''){
			$('#comment_body').css('border','1px solid #EC9393');
			$('#comment_body').attr('placeholder','Please make a comment');
			validate1 = true;
		}
		if(comment_name==''|| post_id==''){
			$('#comment_name').css('border','1px solid #EC9393');
			$('#comment_name').attr('placeholder','please enter your name');
			validate2 = true;
		}
		else if (comment_name.length <=3 || comment_name.length >= 11){
			$('#comment_name').attr('placeholder','');
			$('#comment_name').css('border','1px solid gray');
			$('#comment_name').val('');
			$('#comment_name').attr('placeholder','please your name should be at least 4 to 10 characters ');
			validate2 = true;
		}
		if(validate2 == false && validate1 == false ){
			//ajax process
			console.log('username: '+comment_name+ ' text:'+comment_text+' post_id '+ post_id);
			$('#comment_name').attr('placeholder','');
			$('#comment_name').val('');
			$('#comment_body').val('');
			$.ajax({
				url:'ajax/comment_insert.php',
				method:'POST',
				data:{com_insert:1, comment_name:comment_name, comment_text:comment_text, post_id:post_id},
				success: function(data){
					comment_insert(jQuery.parseJSON(data));
					console.log('responseText: '+ data);
				},
				error: function(data){
					console.log('responseText: '+ data);
				}
			});	
		}
}
//function to display the JSON data
function comment_insert(data){
	var c ='';
	c += '<li class="comment-holder" id="'+data.comment.post_id+'">';
  c += '<div class="row" style="margin:0px;">';
  c +=  '<div class="col-md-1 col-xs-2 col-sm-1" style="padding: 0px;">';
  c +=    '<div class="user-img">';
  c +=      ' <img src="assets/img/avatar.png" width="45" height="45" style="margin:6px 5px 0px 6px; " class="img-responsive"/>';
  c +=    '</div>';
  c +=  '</div>';
  c +=  '<div class="col-md-11 col-sm-11 col-xs-10 comment-body">';
  c +=    '<div class="row"><div class="col-md-6 col-sm-6 col-xs-6"><h3 class="username-field">'+data.comment.user+'</h3></div><div class="col-md-6 col-sm-6 col-xs-6"><small style="font-size: 11px; color:blue;">Posted: <span style="font-size: 11px; color:#7CAEF9;"">'+ moment().format("ddd, MMM YYYY, h:mm a")+'</span></small></div></div>';
  c +=    '<div class="comment-text text-justify">';
  c +=      '<p>'+data.comment.text+'</p>';
  c +=    '</div>';
  c +=  '</div>';
  c +='</div>';
c +='</li>';
$('.comments-holder-ul').prepend(c);
}