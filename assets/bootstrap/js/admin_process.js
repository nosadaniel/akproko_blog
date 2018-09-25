$(document).ready(function(){
	//function to display all posts in admin panel
	display_all(1);
	function display_all(display_all){
		$.ajax({
			url:'../ajax/process_admin.php',
			method:'POST',
			data:{display_all:display_all},
			success: function(data){
				$('#display_all_posts').html(data);
			}
		})
	}
	//when click on the pagination
	$('body').delegate('.pagination_link','click', function(e){
		e.preventDefault();
		var page = $(this).attr('id');
		display_all(page);
	})
	//to search for all post in admin panel
	$('#filter_post').keyup(function(e){
		e.preventDefault();
		var filter = $('#filter_post').val();
		if (filter_post !=''){
			$.ajax({
				url:'../ajax/process_admin.php',
				method:'POST',
				data:{filter_post:1, filter:filter},
				success: function(data){
					$('#display_all_posts').html(data);
				}
			})
		}
		else{
			$('#filter_post').val('');
		}
	})
	//to delete a specfic post by using an id name
	$('body').delegate('.delete', 'click', function(e){
		e.preventDefault();
		var delete_id = $(this).attr('delete_id');
		if (confirm("You're sure that you want to delete this post")){
			$.ajax({
				url:'../ajax/process_admin.php',
				method:'POST',
				data:{delete_click:1, delete_id:delete_id},
				success: function(data){
					$('#msg').html(data);
					display_all(1);
				}
			})
		}
	})
	

});