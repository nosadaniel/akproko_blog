$(document).ready(function(){
	//ajax to display recent post on the dashboard
	display(1);
	function display(display_post){
		$.ajax({
			url:'../ajax/display_recent_post.php',
			method: 'POST',
			data:{display_post:display_post},
			success:function(data){
				$('#display_recent_post').html(data);
			}
		})
	}
	//when click on the pagination
	$('body').delegate('.pagination_link','click', function(e){
		e.preventDefault();
		var display_post = $(this).attr('id');
		display(display_post);
	})
	//function to display all  posts comments on the dashboard
	display_comment();
	function display_comment(){
		$.ajax({
			url:'../ajax/process_admin.php',
			method: 'POST',
			data:{display_comment:1},
			success:function(data){
				$('#display_comments').html(data);
			}
		})
	}
	// to delete selected comments on the dashboard
	$('body').delegate( '#btn_delete','click', function(e){
		e.preventDefault();
		if(confirm('Are you sure that you want to delete the select comment(s)')){
			var id = [];
			$(':checkbox:checked').each(function(i){
				id[i] = $(this).val();
			})
			if (id.length===0) {
				alert('Please Select atleast one checkbox');
			}
			else{
				$.ajax({
					url:'../ajax/process_admin.php',
					method: 'POST',
					data:{id:id},
					success:function(){
						for (var i = 0; i < id.length; i++) {
							$('tr#'+id[i]+'').css('background-color','#ccc');
							$('tr#'+id[i]+'').fadeOut('slow');
						}
						display_comment();
					}
				})
			}
		}
		else{
			return false;
		}
	})
	// to filter display_comments
	$('#filter_comment').keyup(function(e){
		e.preventDefault();
		var filter_com = $('#filter_comment').val();
		if (filter_com !=''){
			$.ajax({
				url:'../ajax/process_admin.php',
				method:'POST',
				data:{filter_comments:1, filter_com:filter_com},
				success: function(data){
					$('#display_comments').html(data);
				}
			})
		}
	})

	
	
});