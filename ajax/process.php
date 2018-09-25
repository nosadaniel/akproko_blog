<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/akproko/defines.php';
if (isset($_POST['side_bar'])) {
	$output='';
	$query1 = "SELECT * FROM news LIMIT 0, 6";
	$query2 = "SELECT * FROM news LIMIT 6, 6";
	$run_query1 = mysqli_query($connect, $query1);
	$run_query2 = mysqli_query($connect, $query2);
	$output .= '<div class="panel-group" id="accordion">
								<div class="panel main-color-bg shadow">
    							<div class="panel-heading">
      							<strong class="panel-title">
        						<a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="color:#333333;">NEWS</a>
      						</strong>
    						</div>
    					<div id="collapse1" class="panel-collapse collapse">
      					<div class="table-responsive">
      						<table class="table table-hover">
							';
	while ($row1 = mysqli_fetch_assoc($run_query1)) {
		$news = $row1['news'];
		$news_id = $row1['news_id'];
    $output.= '<tr>
      						<td><a href="#" class = " remove-underline news_list" news_id="'.$news_id.'">'.$news.'</a></td>
      					</tr>';

	}

	$output .= '</table>
    			</div>
    		</div>
  		</div>';
  $output .= '
							<div class="panel main-color-bg shadow">
    						<div class="panel-heading">
      						<strong class="panel-title">
        						<a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="color:#333333;">SPORTS</a>
      						</strong>
    						</div>
    					<div id="collapse2" class="panel-collapse collapse">
      					<div class="table-responsive">
      						<table class="table table-hover">
      				';
   while ($row2 = mysqli_fetch_assoc($run_query2)) {
		$news1 = $row2['news'];
		$news1_id = $row2['news_id'];
    $output.= '<tr>
      						<td><a href="#" class = "remove-underline news_list" news_id="'.$news1_id.'">'.$news1.'</a></td>
      					</tr>';

	}
	$output .= '</table>
    			</div>
    		</div>
  		</div>
  	</div>';
	echo "$output";
}
if (isset($_POST['add_post']) || isset($_POST['select_news'])  || isset($_POST['search_click'])) {
	$pagin_post = "";
	$output_post = "";
	$total_post_per_page = 4;
	//$add_post='';
	if (isset($_POST['add_post'])){
		$add_post = $_POST['add_post'];
	}
	else{
		$add_post=1;
	}
	$start_from = ($add_post-1)*$total_post_per_page;
	$sql = "SELECT * FROM posts LIMIT $start_from, $total_post_per_page";
	if(isset($_POST['select_news'])){
		$news_id = $_POST['get_news'];
		$sql = "SELECT * FROM posts WHERE post_news = ".$news_id." ORDER BY RAND()";
	}
	
	if(isset($_POST['search_click'])){
		$search = mysqli_real_escape_string($connect, strtolower(trim($_POST['search'])));
		$sql = "SELECT * FROM posts WHERE post_title LIKE '%$search%' ";
		echo "<strong class='text-danger'>SEARCH RESULT...</strong>";
	}
	$run_query = mysqli_query($connect, $sql);
	$num_rows = mysqli_num_rows($run_query);
	if ($num_rows > 0) {
		while ($row = mysqli_fetch_assoc($run_query)) {
			$post_news = $row['post_heading'];
			$post_img = $row['post_image'];
			$post_title = $row['post_title'];
			$post_content = substr(filter_var($row['post_content'], FILTER_SANITIZE_STRING), 0, strpos($row['post_content'],'.'));
			$post_author = $row['post_author'];
			$post_date =  date("M d Y, h:i a",strtotime($row['post_date']));
			$post_id = $row['post_id'];
			$total_comment = $row['total_comment'];

		$output_post .="
						<div class='panel'>
						 	<div class='panel panel-heading main-color-bg' style='margin-bottom: 0px;''>
								<strong class='panel-title' style='color:#333333;'>".$post_news."</strong>
						  	</div>
							<div class='panel panel-body' style='padding:0px; margin-bottom: 0px;'>
								<div class='row'>
									<div class='col-md-4 col-sm-4 col-xs-4' style='padding-right:0px;'>
  										<img src='assets/img/".$post_img."' class='img-responsive img-thumbnail zoom-img shadow'  width='200' height='150' alt='".$post_img."'>
  									</div>
									<div class='text-justify col-md-8 col-sm-8 col-xs-8'>
	    								<a href='readmore.php?id=".$post_id."'  class='remove-underline read_more'>
											<strong>".$post_title."</strong>
											</a>
	    								<p style='border-left: 4px solid #0679C2; padding:5px;'>".$post_content."
	    									<a href='readmore.php?id=".$post_id."'class='btn btn-info btn-xs btn-block read_more'>Read More...</a>
										</p>
	    							</div>
		    					</div>
		    				</div>
							<div class='panel-footer' style='padding-top: 2px; padding-bottom: 0px;''>
								<div class='row'>
									<div class='col-sm-4 col-xs-3' style='padding-left:5px;'>
										<p  class='text-primary' style='font-size: 10px;'><strong class='text'>By</strong> ".ucfirst($post_author)."
										</p>
									</div>
									<div class='col-sm-4 col-xs-3' style='padding:0px;'>
										<b style='font-size: 10px;'>
											<a href='readmore.php?id=".$post_id."#disqus_thread' class='remove-underline text-primary'>0 Comment
										</b></a>

									</div>
									<div class='col-sm-4 col-xs-6' style='padding:0px;'>
										<b class='text text-center text-primary' style='font-size: 10px;'><span class='fa fa-calendar-check-o text-primary'></span>&nbsp;".$post_date.
										"</b>
									</div>
								</div>
							</div>
						</div>
						<hr style='border: 1px solid  #1ed4b4; border-radius: 0px;'>";
					
							
		}
		echo "$output_post";

	}
	else{


		/*echo "<!--modal to view messages-->
		<div id='searchResult' class='modal fade' role='dialog'>
		   <div class='modal-dialog modal-sm'>
		      <!-- Modal content-->
		      <div class='modal-content'>
		        <div class='modal-header' style='padding: 5px 10px 5px 10px;'>
		          <button type='button' class='close' data-dismiss='modal'>&times;</button>
		          <h4 class='modal-title text-danger'><span class='fa fa-warning fa-2x'></span><small> Message</small></h4>
		        </div>
		        <div class='modal-body'>
		        <h4>NO RESULT FOUND <small></small></h4>
		        </div>
		        <div class='modal-footer'>
		          <button type='button' class='btn btn-warning' data-dismiss='modal'>Cancel</button>
		        </div>
		      </div>
		    </div>
		</div>";*/

		echo "<div class='alert alert-danger alert-dismissable'>
              <a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
              <strong> SEARCH RESULT NOT FOUND <small></small></strong>
           </div>";
	}
	//pagination continues
	if(isset($_POST['add_post'])){
		$sel = "SELECT * FROM posts";
		$run_sel = mysqli_query($connect, $sel);
		$total_records = mysqli_num_rows($run_sel);
		$total_pages = ceil($total_records/$total_post_per_page);
		for($i = 1; $i<=$total_pages; $i++){
			$pagin_post .= "<ul class='pagination'>
								<li class='pagination_link' id='".$i."'><a href='#'>".$i."</a></li>
							</ul>";
				/*$pagin_post .="<ul class='row pagination_link'>
						      <a href='#' class='btn btn-info'idid='".$i."'>Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;
						      <a href='#' class='btn btn-info'>Next</a>
    						</ul>";
*/
		}
		echo $pagin_post;
	}
	
}

?>