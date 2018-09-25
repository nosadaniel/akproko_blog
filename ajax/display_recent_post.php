<?php

session_start();
// to check if sesssion is not set.
if(!isset($_SESSION['user_id'])){
	header('location:index.php');
}
//directory to connect to database
require_once $_SERVER['DOCUMENT_ROOT'].'/akproko/defines.php';
//to display recent post on the dashboard
$pagin_post = "";
$total_post_per_page = 4;
$display='';
if (isset($_POST['display_post'])) {
	$display_post = $_POST['display_post'];
}
else{
	$display_post = 1;
}
$start_from = ($display_post-1)*$total_post_per_page;
if ($_SESSION['user_id']!=4) {
	$sql = "SELECT post_title, post_date, post_author, post_image, post_heading FROM posts WHERE user_id =".$_SESSION['user_id']." ORDER BY post_date DESC";
}
else{
	$sql = "SELECT post_title, post_date, post_author, post_image, post_heading FROM posts ORDER BY post_date DESC LIMIT $start_from, $total_post_per_page";
}
$run_sql = mysqli_query($connect, $sql);
$records = mysqli_num_rows($run_sql);
if($records>0){
	$display.= " <div class='panel panel-default'>
					<div class='panel-heading'>
						<h4 class='panel-title'>Latest Posts</h4>
					</div>
					<div class='panel-body' style='padding:0px;'>
						<div class='table-responsive'>
						<table class='table table-condensed table-striped table-hover'>
							<thead>
								<tr>
									<th>Post Author</th>
									<th width='25%'>Post Title</th>
									<th>Post Image</th>
									<th>Post Heading</th>
									<th>Post Date</th>
								</tr>
							</thead>
							<tbody>";
}
	while ($row = mysqli_fetch_assoc($run_sql)){
		$post_title = $row['post_title'];
		$post_date = date('M d Y, h:i a', strtotime($row['post_date']));
		$post_author = $row['post_author'];
		$post_image = $row['post_image'];
		$post_heading = $row['post_heading'];
		

		$display .="
									<tr class='text-justify'>
										<td>".$post_author."</td>
										<td>".$post_title."</td>
										<td><img src='../assets/img/".$post_image."' class='img-responsive img-rounded' height='60' width='60'></td>
										<td>".$post_heading."</td>
										<td>".$post_date."</td>
										
									</tr>
								";
	}
	$display .="	</tbody>
						</table>
						</div></div>
					</div>	";
echo $display;
//pagination continues
	if($_SESSION['user_id']==4){
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



?>