$(document).ready(function(){
	//display all users
	display_users();
	function display_users(){
		$.ajax({
			url:'../ajax/display_all_users.php',
			method:'POST',
			data:{all_users:1},
			success:function(data){
				$('#users').html(data);
			}
		})
	}
	//to delete a specific user
	$('body').delegate('.delete', 'click', function(e){
		e.preventDefault();
		var del_id = $(this).attr('did');
		if (confirm("You're sure that you want to remover this user")){
			$.ajax({
				url:'../ajax/display_all_users.php',
				method:'POST',
				data:{del_click:1, del_id:del_id},
				success: function(data){
					display_users();
					$('#msgss').html(data);
				}
			})
		}
	})
	// to search for a particular user
	$('#filter_users').keyup(function(e){
		e.preventDefault();
		var search = $('#filter_users').val();
		if (search !=''){
			$.ajax({
				url:'../ajax/display_all_users.php',
				method:'POST',
				data:{filter_use:1, search:search},
				success: function(data){
					$('#users').html(data);
				}
			})
		}
	})
});