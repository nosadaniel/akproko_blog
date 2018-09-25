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
if (isset($_GET['msg1'])) {
$msg = $_GET['msg1'];
}
if (isset($_GET['msg2'])) {
	$msg2 = $_GET['msg2'];
}
if (isset($_GET['msgs'])) {
$msgs = $_GET['msgs'];
}
if (isset($_GET['msgE'])) {
$msgE = $_GET['msgE'];
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

$sql2 = "SELECT * FROM news ORDER BY news ASC";
$query_sql2 = mysqli_query($connect,$sql2);
if (isset($_POST['submit'])) {
	function security($test){
		$test = filter_var($test, FILTER_SANITIZE_STRING);
		$test =  stripslashes($test);
		return $test;
	}
	$post_title = mysqli_real_escape_string($connect, security($_POST['post_title']));
	$post_content =mysqli_real_escape_string($connect, $_POST['editor1']);
	$post_author = mysqli_real_escape_string($connect, security($_POST['post_author']));
	$post_heading = mysqli_real_escape_string($connect, $_POST['post_heading']);
	$heading = mysqli_real_escape_string($connect, security($_POST['heading']));
	$post_image= mysqli_real_escape_string($connect, strtolower($_FILES['post_img']['name']));;
	$img_sizes = strtolower($_FILES['post_img']['size']);
	$img_type = strtolower($_FILES['post_img']['type']);
	$tmp_location = $_FILES['post_img']['tmp_name'];
	if (!empty($post_title) && !empty($post_content) && !empty($post_author) && !empty($post_heading) && !empty($heading) && !empty($post_image)) {
		$max = 700000; //700kb
		//echo "$img_sizes";
		$img_extension = substr($post_image, strpos($post_image, '.')+1);
		if (($img_extension == 'jpg' || $img_extension == 'jpeg'|| $img_extension =='png' || $img_extension =='gif' )){
			$location = "../assets/img/";
			if($img_sizes <= $max){
				if (!file_exists($tmp_location.$post_image)) {
					$successful = move_uploaded_file($tmp_location, $location.$post_image);
					if ($successful) {
							$msgs = "Image was successfully uploaded";
						$add = "INSERT INTO posts(post_id, `post_title`, `post_content`, `post_image`, `post_news`, `post_heading`, `post_author`,`user_id`) VALUES('NULL','$post_title','$post_content', '$post_image','$heading', '$post_heading','".$_SESSION['name']."',".$_SESSION['user_id'].")";
						$query_add = mysqli_query($connect, $add);
						if ($query_add) {
							$msgs = urlencode("Post successful added");
							header("location:posts.php?msgs=".$msgs."");
							exit();
						}
						else{
							$msgE = "Post can't be added at the moment...pls contact the developer";
							header("location:posts.php?msgE=".$msgE."");
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
				$msgEE= "image size must not exceed 700kb";
			}
		}	
		else{
			$msgE = "Invalid image...Image file must be 'jpg', 'jpeg', 'png' or 'gif'";
			header("location:posts.php?msgE=".$msgE."");
		}
	}
	else{
		$msgEE = "all fields are required";
	
	}	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel | Post</title>
	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewpoint" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/style.css"/>
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
					<h1><span class="fa fa-gear fa-lg"> Post</span> <small>Manage Blog Posts</small></h1>
				</div>
				<div class="col-md-2">
					<div class="dropdown create">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1">Create Content
        			<span class="caret"></span>
        		</button>
						<ul class="dropdown-menu">
         		 <li><a href="#" data-toggle="modal" data-target="#addPage">Add Post</a></li>
         		 <li class="disabled"><a href="#">Add User</a></li>
        		</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<section id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
			  <li><a href="dashboard.php">DashBoard</a></li>
			  <li><a href="comments.php">Comments</a></li>
			   <li class="active"><a href="posts.php">Post</a></li>  
			</ul>
		</div>
	</section>
	<section id="main">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="list-group">
					  <a href="dashboard.php" class="list-group-item main-color-bg"><span class="fa fa-gear"> DashBoard</span></a>
					   <a href="comments.php" class="list-group-item"><span class="fa fa-comments"> Comments </span><span class="badge"><?php echo $total_comment; ?></span></a>
					  <a href="posts.php" class="list-group-item"><span class="fa fa-pencil"> Posts </span><span class="badge"><?php echo $total_post; ?></span></a>
					  <?php if($_SESSION['user_id'] != 4){ ?>
					  	<a href="profile.php" class="list-group-item"><span class="fa fa-user"> Login </span><span class="badge"><?php echo $_SESSION['name']; ?></span></a>
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
    					<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:60%; background-color: #333333; color: #ffffff"> 40%
    				</div>
  				</div>		
					</div>
				</div>
				<div class="col-md-9">
				<!--website overview-->
					<div class="panel panel">
						<div class="panel-heading main-color-bg">
							<h3 class="panel-title">Posts</h3>
						</div>
						<div class="panel-body" style="padding: 10px;">
							<div class="row">
								<div class="col-md-12">
									<?php 
									if(isset($msg)){?>
										<div class="alert alert-success alert-dismiss">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											<strong><?php echo $msg;?></strong>
										</div>
									<?php 
										}
										if(isset($msg2)){
									?>
										<div class="alert alert-danger alert-dismiss">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											<strong><?php echo $msg2;?></strong>
										</div>
									<?php
										}
					        	if (isset($msgE)) {
					        ?>
					        <div class="alert alert-danger aleart-dismissable">
					        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					        	<h4 class="text-center"><strong><?php echo $msgE; ?></strong></h4>
					        </div>
					     	<?php 
					     		}
					        if (isset($msgs)) {
					        ?>
					        <div class="alert alert-success aleart-dismissable">
					        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					        	<h4 class="text-center"><strong><?php echo $msgs; ?></strong></h4>
					        </div>
					      <?php 
					    		}
					        	if (isset($msgEE)) {
					        ?>
					        <div class="alert alert-danger aleart-dismissable">
					        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					        	<h4 class="text-center"><strong><?php echo $msgEE; ?></strong></h4>
					        </div>
					        <?php } 
					        	if ($_SESSION['user_id']==4) {
					        ?>				
									<input type="text" name="filter_post" id="filter_post" class="form-control" placeholder="filter posts by title Or author... " autocomplete="off">
									<?php } ?>
								</div>
							</div>
							<br>
							<!--Display all posts-->
							<div class="table-responsive">
								<div id="msg"></div>
								<div id="display_all_posts"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer style="background-color: #333333; color:#ffffff; padding: 20px; margin-top: 20px;">
		<p class="text-center"><b>DashBoard</b> Akproko Blog &copy;<?php echo date('Y');?></p>
	</footer>
	<!-- Modal for add post -->
	<div id="addPage" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add Post</h4>
	      </div>
	      <div class="modal-body">
	      	<h3 class="text text-danger" id="err"></h3>
	       	<form method="POST" enctype="multipart/form-data">
	        	<div class="input-group">
	        		<span class="input-group-addon main-color-bg"><span><b>Page Title</b></span></span>
	        		<input type="text" class="form-control" name="post_title" id="post_title" placeholder="Add page title" autocomplete="off">
	        	</div>
	        	<br>
	        	<div class="form-group">
			    		<label style="color:#1ed4b4">Page Body</label>
			    		<textarea class="form-control" name="editor1" id="post_content" placeholder="Add page body" autocomplete="off"></textarea>
						</div>
						<br>
	        	<span class="text text-danger" id="img_err"></span>
		        <div class="input-group">
	        		<span class="input-group-addon main-color-bg"><span><b>Insert Image</b></span></span>
	        		<input type="file" class="form-control img" name="post_img">
		        </div>
	        	<br>
	        	<div class="input-group">
	        		<span class="input-group-addon main-color-bg"><span><b>Published by</b></span></span>
	        		<input type="text" class="form-control" name="post_author" id="post_author" placeholder="Enter author's name" autocomplete="off" readonly value="<?php echo $_SESSION['name']; ?>" >
	        	</div>
					  <br>
					  <input type="hidden" name="post_heading" id="heading">
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
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	         <button type="submit" id="submit" name="submit" class="btn main-color-bg">Submit Post</button>
	      </div>
	    </form>
	    </div>
	  </div>
	</div>
	<script type="text/javascript" src="../assets/bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/admin_process.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/edit_post.js"></script>
  <script src="../assets/ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.replace('editor1');
		$(function () {
  $('[data-toggle="tooltip"]').tooltip();
  $(selector).tooltip({container:'body'});
})
	</script>
</body>
</html>