$(document).ready(function(){
	//to show content on side bar
	$.ajax({
		url:'ajax/process.php',
		method:'POST',
		data: {side_bar:1},
		success: function(data) {
			$('.display_sidebar').html(data);
		}
	})
	// to show post content
	load_data(1);
	function load_data(add_post){
		$.ajax({
			url:'ajax/process.php',
			method:'POST',
			data:{add_post:add_post},
			success: function(data) {
				$('.display_post').html(data);
			}
		})
	}
	//when click on the pagination
	$('body').delegate('.pagination_link','click', function(e){
		e.preventDefault();
		var page = $(this).attr('id');
		load_data(page);
	})
	//display recent news
	$.ajax({
		url:'ajax/readmore_recent.php',
		method:'POST',
		data:{recent:1},
		success: function(data){
			$('#display_recent_post').html(data);
		}
	})
	//to click on the side bar menu
	$('body').delegate('.news_list','click',function(event){
		event.preventDefault();
		var news = $(this).attr('news_id');
		$.ajax({
			url:'ajax/process.php',
			method:'POST',
			data:{select_news:1, get_news:news},
			success: function(data){
				$('.display_post').html(data);
			}
		})
	})
	// to search for a particular post
	$('#submit').click(function(event){
		event.preventDefault();
		var search = $('#search').val();
		if (search == ''){
			$('#search').attr('placeholder','This field must be filled');
		}
		else{
			$('.msg-err').html('');
			$.ajax({
				url: 'ajax/process.php',
				method: 'POST',
				data:{search_click:1, search:search},
				success: function(data){
					$('.display_post').html(data);
				}
			})

		}

	})
	
});