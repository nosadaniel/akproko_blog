$(document).ready(function(){
	$.ajax({
		url:'../ajax/feedback.php',
		method:'post',
		data:{feedback:1},
		success: function(data){
			$('#feedback_msg').html(data);
		}
	});
});