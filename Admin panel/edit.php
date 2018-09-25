<?php
session_start();
require_once('timeout.php');
if(!isset($_SESSION['user_id'])){
	header('location:index.php');
}
else{
	if(isLoginSessionExpired()) {
		header("Location:logout.php?session_expired=1");
	}
}
require_once $_SERVER['DOCUMENT_ROOT'].'/akproko/defines.php';

//total feed
$total_feed = mysqli_query($connect,"SELECT COUNT(sug_id) AS id FROM suggestions");
while($total_fee = mysqli_fetch_assoc($total_feed)){$total_feeds=$total_fee['id'];}

$count_posts = "SELECT COUNT(post_id) as total_post FROM posts";
	$query_count_posts = mysqli_query($connect,$count_posts);
	while ($row = mysqli_fetch_assoc($query_count_posts)) {
		$total_post = $row['total_post'];
	}
	$c_posts = "SELECT COUNT(comment_id) as c_post FROM comments";
	$query_c_posts = mysqli_query($connect,$c_posts);
	while ($row = mysqli_fetch_assoc($query_c_posts)) {
		$total_comment = $row['c_post'];
	}
	$u_posts = "SELECT COUNT(user_id) as u_post FROM users";
	$query_u_posts = mysqli_query($connect,$u_posts);
	while ($row = mysqli_fetch_assoc($query_u_posts)) {
		$total_users = $row['u_post'];
	}
	$total_post = "UPDATE total_all SET total_comment='$total_comment', total_post='$total_post', total_user='$total_users'";
	$run_total_post = mysqli_query($connect, $total_post);
	$sql = "SELECT * FROM total_all";
	$sql_query = mysqli_query($connect,$sql);
	while ($row = mysqli_fetch_assoc($sql_query)) {
		$total_post = $row['total_post'];
		$total_comment = $row['total_comment'];
		$total_user = $row['total_user'];
	}





if (!isset($_GET['id'])) {
	header('location:posts.php');
}
$id = $_GET['id'];
$sql1 = "SELECT * FROM posts WHERE post_id =".$id."";
$sql2 = "SELECT * FROM news ORDER BY news ASC";
$query_sql1 = mysqli_query($connect,$sql1);
$query_sql2 = mysqli_query($connect,$sql2);
if (isset($_POST['submit'])) {
	function security($test){
		$test = filter_var($test, FILTER_SANITIZE_STRING);
		$test =  stripslashes($test);
		return $test;
	}
	$edit_id = mysqli_real_escape_string($connect, $_POST['edit']);
	$post_title = security($_POST['post_title']);
	$post_content = $_POST['editor1'];
	$post_author = security(ucfirst($_POST['post_author']));
	$post_heading = security(ucfirst($_POST['post_heading']));
	$heading = security($_POST['heading']);
	$post_image= strtolower($_FILES['post_img']['name']);
	$img_sizes = strtolower($_FILES['post_img']['size']);
	$img_type = strtolower($_FILES['post_img']['type']);
	$tmp_location = $_FILES['post_img']['tmp_name'];
	if (!empty($post_title) && !empty($post_content) && !empty($post_author) && !empty($heading) && !empty($post_heading) && !empty($post_image) && !empty($edit_id)) {
		$max = 700000; //700kb
		$img_extension = substr($post_image, strpos($post_image, '.')+1);
		if (($img_extension == 'jpg' || $img_extension == 'jpeg'|| $img_extension =='png' || $img_extension =='gif' )){
			$location = "../assets/img/";
			if($img_sizes <= $max){
				if (!file_exists($tmp_location.$post_image)) {
					$successful = move_uploaded_file($tmp_location, $location.$post_image);
					if ($successful) {
						$msg = "Image was successfully uploaded";
						$update = "UPDATE posts SET post_title = '$post_title', post_content = '$post_content', post_image='$post_image', post_author='$post_author', post_news='$heading', post_heading='$post_heading' WHERE post_id='$edit_id'";
						$query_update = mysqli_query($connect, $update);
						if ($query_update) {
							$msg = urlencode("Post successful Edited");
							header("location:posts.php?msg1=".$msg."");
							exit();
						}
						else{
							$msg = "Post can't be Edited at the moment...pls contact the developer";
							header("location:posts.php?msg2=".$msg."");
							exit();
						}
					}
					else{
						$msg = "Image can't be uploaded...contact the developer";
						header("location:posts.php?msg2=".$msg."");
						exit();
					}
				}
				else{
					chmod($tmp_location, 0755);
					unlink($tmp_location);
				}
			}
			else{
				$img_msg= "image size must exceed 700kb";
			}	
		}
		else{
			$img_msg = "Invalid image...Image file must be 'jpg', 'jpeg', 'png' or 'gif'";
		} 
	}
	else{
		$img_msg = "all fields are required";
	}	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel | Edit Page</title>
	<meta charset="utf-8">
	<meta name="viewpoint" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css"/>
	
	<link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/style.css"/>
	<script type="text/javascript" src="../assets/bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/ckeditor/ckeditor.js"></script>
  <script>
  	function mark_text(texts){
		document.getElementById('heading').value = texts.options[texts.selectedIndex].text;
	}
  </script>
</head>
<body>
	<nav class="navbar">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
					<span class="fa fa-navicon"></span>
					<span class="sr-only">Toggle navigation</span>
				</button>
				<a class="navbar-brand" href="#">AdminPanel</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="dashboard.php">Dashboard</a></li>
					<li><a href="comments.php">Comments</a></li>
					<li class="active"><a href="posts.php">Post</a></li>
					<?php if($_SESSION['user_id'] != 4){ ?>
					<li class="disabled"><a href="#">Users</a></li>
				<?php }else{?>
						<li><a href="users.php">Users</a></li>
				<?php }?>
				<li><a href="Suggestion.php">Feedback</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="profile.php">Welcome, <?php echo ucfirst($_SESSION['name']);?></a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div><!--nav collapse -->
		</div>
	</nav>
	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<h1><span class="fa fa-gear fa-lg"> Edit Page</span> <small>Manage Blog Page</small></h1>
				</div>
				<div class="col-md-2">
				</div>
			</div>
		</div>
	</header>
	<section id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
			  <li><a href="dashboard.php">DashBoard</a></li>
			  <li><a href="comments.php">Comments</a></li>
			  <li><a href="posts.php">Post</a></li>
			  <li class="active"><a href="edit.php">Edit</a></li>  
			</ul>
		</div>
	</section>
	<section id="main">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="list-group">
					  <a href="pages.php" class="list-group-item main-color-bg"><span class="fa fa-gear"> DashBoard</span></a>
					   <a href="comments.php" class="list-group-item"><span class="fa fa-comments"> Comments </span><span class="badge"><?php echo $total_comment; ?></span></a>
					  <a href="posts.php" class="list-group-item"><span class="fa fa-pencil"> Posts </span><span class="badge"><?php echo $total_post; ?></span></a>
					  <?php if($_SESSION['user_id'] != 4){ ?>
					  	<a href="#" class="list-group-item"><span class="fa fa-user"> Users </span><span class="badge"><?php echo $total_user; ?></span></a>
					  	<?php } else{ ?>
					  	<a href="users.php" class="list-group-item"><span class="fa fa-user"> Users </span><span class="badge"><?php echo $total_user; ?></span></a>
					  	<?php } ?>
					  	<a href="Suggestion.php" class="list-group-item"><span class="fa fa-envelope"> Feedbacks </span><span class="badge"><?php echo $total_feeds; ?></span></a>
					</div>
					<div class="well">
						<h4>Disk Space Used</h4>
  					<div class="progress">
    					<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%; background-color: #333333; color: #ffffff"> 40%
    				</div>
  				</div>
  				<h4>Bandwidth Used</h4>
  					<div class="progress">
    					<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:60%; background-color: #333333; color: #ffffff"> 60%
    				</div>
  				</div>		
					</div>
				</div>
				<div class="col-md-9">
				<!--website overview-->
					<div class="panel panel">
						<div class="panel-heading main-color-bg">
							<h3 class="panel-title">Edit Post</h3>
						</div>
						<div class="panel-body">
							<?php
							if(isset($img_msg)){?>
								<div class="alert alert-danger alert-dismiss">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong><?php echo $img_msg; ?></strong>
								</div>
							<?php
								}
							?>		
							<div id="success" class="text-danger"></div>
							<h3 class="text text-danger" id="err"></h3>
							<form method="POST" enctype="multipart/form-data" action="" id="form_submit">

								<?php
									while ($row = mysqli_fetch_assoc($query_sql1)) {
										$post_title =$row['post_title'];
										$post_content = $row['post_content'];
										$post_img = $row['post_image'];
										$post_author = $row['post_author'];
										$post_img = $row['post_image'];
										
								?>
			        			<div class="input-group">
			        				<span class="input-group-addon main-color-bg"><span><b>Page Title</b></span></span>
			        				<input type="text" class="form-control input-lg" name="post_title" id="post_title" placeholder="Add page title" value="<?php echo $post_title;?>">
			        			</div>
			        			<br>
			        			<div class="form-group">
					        		<label style="color:#1ed4b4">Page Body</label>
					        		<textarea class="form-control" name="editor1" id="post_content" placeholder="Add page body"><?php echo $post_content;?></textarea>
			        			</div>
			        			<br>
			        			<span class="text text-danger" id="img_err"></span>
					        	<div class="input-group">
					        		<span class="input-group-addon main-color-bg"><span class="fa fa-file-image-o fa-3x"></span></span>
					        		<input type="file" class="form-control img" name="post_img">
					        		<img src="../assets/img/<?php echo $post_img;?>" width='50' height='50' class='img-responsive'>
					        	</div>
					        	<br>
					        	<div class="input-group">
					        		<span class="input-group-addon main-color-bg"><span class="fa fa-user-o"><b> Published by</b></span></span>
					        		<input type="text" class="form-control" name="post_author" id="post_author" placeholder="Enter author's name"  readonly value="<?php echo $post_author; ?>">
					        	</div>
					        	<br>
					        	<input type="hidden" name="edit" class="edit" value="<?php echo $id ;?>">
					        	<input type="hidden" name="post_heading" id="heading">
					        	
					        	<?php } ?>
					        	<div class="form-group">
  										<span class="input-group-addon main-color-bg"><span><b>Select Post-heading</b></span></span>
  										<select class="form-control"  name="heading" id="post_heading" onchange="mark_text(this)">
  											<option value="0">Select</option>
	  										<?php
	  											while ($ns=mysqli_fetch_assoc($query_sql2)) {
	  												$news_id = $ns['news_id'];
	  												$news = ucfirst($ns['news']);
	  										?>
	  										
							        		<option value="<?php echo $news_id; ?>"><?php echo $news; ?></option>
										  	<?php
										  		}
										  	?>
									 		</select>
									 		<span class="text text-danger" id="sel_err"></span>
									 	</div>
					        	<button type="submit" id="submit" name="submit" class="btn btn-block main-color-bg">Save Changes <span class="fa fa-check-square"></span></button>
					        </form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</section>
	<footer style="background-color: #333333; color:#ffffff; padding: 20px; margin-top: 20px;">
		<p class="text-center"><b>DashBoard</b> Akproko Blog &copy;<?php echo date('Y');?></p>
	</footer>
	<script type="text/javascript" src="../assets/bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/edit_post.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/admin_process.js"></script>
  <script src="../assets/ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.replace('editor1');
	</script>
</body>
</html>