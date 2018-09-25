<?php
session_start();
// to check if sesssion is not set.
if(!isset($_SESSION['user_id'])){
	header('location:index.php');
}
//directory to connect to database
require_once $_SERVER['DOCUMENT_ROOT'].'/akproko/defines.php';
//to check if display_all post or filter_post is set.
if (isset($_POST['display_all']) || isset($_POST['filter_post'])) {
	$display="";
	//to show only posts that are posted by a specific user admin
	if (isset($_POST['display_all']) && $_SESSION['user_id']!=4){
		$sql = "SELECT * FROM posts  WHERE user_id=".$_SESSION['user_id']."";
	}
	//to show show all post to the super admin
	$pagin_post = "";
	$total_post_per_page = 4;
	$display_all='';
	if (isset($_POST['display_all']) && $_SESSION['user_id']==4){
		$display_all = $_POST['display_all'];
	}
	else{
		$display_all=1;
	}
	if($_SESSION['user_id']==4){
		$start_from = ($display_all-1)*$total_post_per_page;
		$sql = "SELECT * FROM posts LIMIT $start_from, $total_post_per_page";
	}
	//to search/filter a post by post author or post title. only for the super admin.
	if (isset($_POST['filter_post']) && $_SESSION['user_id']==4){
		$filter = mysqli_real_escape_string($connect,filter_var(ucfirst($_POST['filter']), FILTER_SANITIZE_STRING));
		$sql = "SELECT * FROM posts WHERE post_title LIKE '%$filter%' OR post_author LIKE '%$filter%'";
	}
	//run the query
	$run_sql = mysqli_query($connect, $sql);
	if(mysqli_num_rows($run_sql)>0){
		$display.="
								<table class='table table-condensed table-striped table-hover table-bordered'>
									<thead class='main-color-bg text-justify'>
										<tr>
											<th width='10%''>Post Date</th>
											<th>Published By</th>
											<th>Post Title</th>
											<th>Post Image</th>
											<th>Post Content</th>
											<th>Post Heading</th>
											<th>Edit Post</th>
											<th>Delete Post</th>
										</tr>
									</thead>
									<tbody>
							";
		$count = 0;
		while ($row = mysqli_fetch_assoc($run_sql)){
			$post_id = $row['post_id'];
			$post_title = $row['post_title'];
			$post_date = date('M d Y, h:i a', strtotime($row['post_date']));
			$post_author = $row['post_author'];
			$post_image = $row['post_image'];
			$post_heading = $row['post_heading'];
			$post_content = filter_var($row['post_content'], FILTER_SANITIZE_STRING);
			$post_content = substr($post_content, 0, 50);

			$display .="
										<tr class='text-justify'>
											<td>".$post_date."</td>
											<td>".$post_author."</td>
											<td>".$post_title."</td>
											<td><img src='../assets/img/".$post_image."' class='img-responsive' height='50' width='50'></td>
											<td>".$post_content."</td>
											<td>".$post_heading."</td>
											<td><a href='edit.php?id=".$post_id."' class='btn btn-warning edit' edit_id='".$post_id."' data-toggle='tooltip' title='Edit'><span class='fa fa-gear'></span></a>
											</td>
											<td><a href='#' class='btn btn-danger delete' delete_id='".$post_id."'  data-toggle='tooltip' title='Delete'><span class='fa fa-trash' ></span></a>
											</td>
										</tr>";
		}

		$display .="	</tbody>
								</table>";
		echo $display;
	}	
	else{
		echo "<div class='alert alert-danger alert-dismissable'>
              <a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
              <strong>NO RESULT FOUND</strong>
           </div>";
	}
	if(isset($_POST['display_all']) && $_SESSION['user_id']==4){
		$sel = "SELECT * FROM posts";
		$run_sel = mysqli_query($connect, $sel);
		$total_records = mysqli_num_rows($run_sel);
		$total_pages = ceil($total_records/$total_post_per_page);
		for($i = 1; $i<=$total_pages; $i++){
			$pagin_post .= "<ul class='pagination'>
								<li class='pagination_link' id='".$i."'><a href='#'>".$i."</a></li>
							</ul>";
		}
		echo $pagin_post;
	}
}
// to delete a post from the dashboard
if(isset($_POST['delete_click'])){
	$delete_id = $_POST['delete_id'];
	$sql = "DELETE FROM posts WHERE post_id = ".$delete_id."";
	$query_sql = mysqli_query($connect,$sql);
	if($query_sql){
			echo "<div class='alert alert-danger alert-dismissable'>
              <a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
              <strong>POST SUCCESSFULL DELETED</strong>
           </div>";
  }

}

//to display all comments and search either by commentary name or comment content
if (isset($_POST['display_comment']) || isset($_POST['filter_comments'])) {
	if (isset($_POST['display_comment'])){
		$display='';
		$sql = "SELECT comment_id, user_name_comment, comment_content, comment_time, posts.post_id, comments.post_id, post_title FROM comments, posts WHERE posts.post_id=comments.post_id ORDER BY comment_time DESC";
	}
	else{
		$display='';
		$filter = mysqli_real_escape_string($connect,filter_var(ucfirst($_POST['filter_com']), FILTER_SANITIZE_STRING));
		$sql = "SELECT * FROM comments WHERE comment_content LIKE '%$filter%' OR user_name_comment LIKE '%$filter%' ";
	}
	$run_sql = mysqli_query($connect, $sql);
	if (mysqli_num_rows($run_sql)>0) {
		$display.= "
											<div class='table-responsive'>
											<table class='table table-striped table-hover'>
												<thead>
													<tr>
														<th>Name</th>
														<th width='30%'>Comment</th>
														<th>Created</th>
														<th>Post commented on</th>
														<th>Action</th>
													</tr>
												</thead>
												";
		while ($row = mysqli_fetch_assoc($run_sql)) {
			$comment_id = $row['comment_id'];
			$comment_name = $row['user_name_comment'];
			$comment_content = $row['comment_content'];
			$post_title = $row['post_title'];
			$comment_time = date('D M Y, h:i a', strtotime($row['comment_time']));

			$display .= "		<tr id='".$comment_id."'>
												<td>".$comment_name."</td>
												<td>".$comment_content."</td>
												<td>".$comment_time."</td>
												<td>".$post_title."</td>
												<td><input type='checkbox' name='comment_id[]' class='delete_comment' value='".$comment_id."'</td>
											</tr>";
		}
		$display .= "				
										</div></table>
									
									<a href='#' class='btn btn-default' id='btn_delete' title='Change the comment content'><span class='fa fa-trash'></	span></a>";
	}
	else{
		echo "<div class='alert alert-warning alert-dismissable'>
              <a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
              <strong>No result found</strong>
           </div>";
	}
	
echo $display;
}
// to delete selected comments
if (isset($_POST['id'])){
		$id = $_POST['id'];
		//$msg = "This post has been remove by the admin";
		foreach ($id as $key) {
			$sql = "DELETE FROM comments WHERE comment_id=".$key."";
			$query_sql = mysqli_query($connect,$sql);
		}
}
?>