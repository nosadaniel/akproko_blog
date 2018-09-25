$(document).ready(function(){
	//display recent news
	$.ajax({
		url:'ajax/readmore_recent.php',
		method:'POST',
		data:{recent:1},
		success: function(data){
			$('#display_recent_post').html(data);
		}
	})
	
});