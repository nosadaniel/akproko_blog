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
if($_SESSION['user_id'] != 4){
	header('location:dashboard.php');
	exit();
}

require_once $_SERVER['DOCUMENT_ROOT'].'/akproko/defines.php';

//total feed
$total_feed = mysqli_query($connect,"SELECT COUNT(sug_id) AS id FROM suggestions");
while($total_fee = mysqli_fetch_assoc($total_feed)){$total_feeds=$total_fee['id'];}


if (isset($_GET['msgs'])) {
$msgs = filter_var($_GET['msgs'], FILTER_SANITIZE_STRING);
}
if (isset($_GET['msgE'])) {
$msgE = filter_var($_GET['msgE'], FILTER_SANITIZE_STRING);
}

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


$sql = "SELECT * FROM total_all";
$sql_query = mysqli_query($connect,$sql);	
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
	$post_image= mysqli_real_escape_string($connect, strtolower($_FILES['post_img']['name']));
	$img_sizes = strtolower($_FILES['post_img']['size']);
	$img_type = strtolower($_FILES['post_img']['type']);
	$tmp_location = $_FILES['post_img']['tmp_name'];
	if (!empty($post_title) && !empty($post_content) && !empty($post_author) && !empty($heading) && !empty($post_image) && !empty($post_heading)) {
		$max = 700000; //700kb
		if($img_sizes <= $max){
			$img_extension = substr($post_image, strpos($post_image, '.')+1);
			if (($img_extension == 'jpg' || $img_extension == 'jpeg'|| $img_extension =='png' || $img_extension =='gif' )){
				$location = "../assets/img/";
				if (!file_exists($tmp_location.$post_image)) {
					$successful = move_uploaded_file($tmp_location, $location.$post_image);
					$add = "INSERT INTO posts(post_id, `post_title`, `post_content`, `post_image`, `post_news`, `post_heading`, `post_author`,`user_id`) VALUES('NULL','$post_title','$post_content', '$post_image','$heading', '$post_heading','".$_SESSION['name']."',".$_SESSION['user_id'].")";
					$query_add = mysqli_query($connect, $add);
					if ($query_add) {
						$msgs = urlencode("Post successful added");
						header("location:dashboard.php?msgs=".$msgs."");
						exit();
					}
					else{
						$msgE = "Post can't be added at the moment...pls contact the developer";
						header("location:dashboard.php?msgE=".$msgE."");
					}
				}
				else{
					chmod($tmp_location, 0755);
					unlink($tmp_location);
				}
			}
			else{
				$msgE = "Invalid image...Image file must be 'jpg', 'jpeg', 'png' or 'gif'";
				header("location:dashboard.php?msgE=".$msgE."");
			}
		}
		else{
			$msgEE= "image size must exceed 700kb";
		
		}	
	}
	else{
		$msgEE = "all fields are required";
	
	}	
}

if(isset($_POST['submit_user'])){
	function isunique($email){
		$sql = "SELECT user_email FROM users WHERE user_email = '$email'";
		global $connect;
		$querys = mysqli_query($connect, $sql);
		if(mysqli_num_rows($querys)>0){
			 	return false;
		}
		else{
			return true;
		}
	}
	function unique_name($name){
		$sql = "SELECT user_name FROM users WHERE user_name = '$name'";
		global $connect;
		$querys = mysqli_query($connect, $sql);
		if(mysqli_num_rows($querys)>0){
			 	return false;
		}
		else{
			return true;
		}
	}
	$sel_err=$msgEm=$msgEEa=$msgUm=false;
	if(!empty($_POST['user_name']) && !empty($_POST['user_email']) && !empty($_POST['user_password']) && !empty($_POST['user_confirm_password']) && !empty($_POST['user_dob'])){
		if (empty($_POST['gender'])){
			$sel_err = "Please select your gender";
			$Sel_err=true;
		}
		$user_name = mysqli_real_escape_string($connect, strtolower($_POST['user_name']));
		$user_email  =  mysqli_real_escape_string($connect, strtolower($_POST['user_email']));
		$user_password =  mysqli_real_escape_string($connect, $_POST['user_password']);
		$gender =  mysqli_real_escape_string($connect, $_POST['gender']);
		$user_dob  =  mysqli_real_escape_string($connect, $_POST['user_dob']);

		$user_confirm_password = filter_var($_POST['user_confirm_password'], FILTER_SANITIZE_STRING);

		$user_name= filter_var(trim($user_name), FILTER_SANITIZE_STRING);
		$user_email= filter_var(strtolower(trim($user_email)), FILTER_SANITIZE_STRING);
		$user_dob = filter_var(trim($user_dob), FILTER_SANITIZE_STRING);
		$gender = filter_var(trim($gender), FILTER_SANITIZE_STRING);
		$user_password = filter_var(trim($user_password), FILTER_SANITIZE_STRING);
		$user_confirm_password = $_POST['user_confirm_password'];
		if (strlen($user_name) <2 || strlen($user_name)>21 ) {
			$msgUm = "User name must between 2 to 20 characters";
			$msgum=true;
		}
		if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
			$msgEm = "Invalid user email address...Please enter a valid email";
			$msgem=true;
		}
		if (strlen($user_password)<=4 ){
			$msgEEa = "Password must be atleats 5 characters long";
			$msgeea=true;
		}
		if($user_password != $user_confirm_password){
			$msgEEa ="Password don't march...";
			$msgeea=true;
		}
		if (@$msgum==false && @$msgem==false && @$msgeea==false && @$Sel_err==false) {
			if (!isunique($user_email)) {
				$msgdb= urlencode("Email is already in use. Please try another one");
				header("location:dashboard.php?msgE=".$msgdb."");
				$dberr=true;
			}
			if(!unique_name($user_name)){
				$msgdb= urlencode("User name is already in use. Please try another one");
				header("location:dashboard.php?msgE=".$msgdb."");
				$dberr=true;
			}
			if(@$dberr == false){
				$hash_password = md5($user_password);
				$insert = "INSERT INTO users(user_name, user_email, user_gender, user_dob, user_password)
									VALUES('$user_name', '$user_email', '$gender', '$user_dob', '$hash_password')" ;
				$insert_query =  mysqli_query($connect,$insert);
				if($insert_query){
					$msgreport = 'User has been successful be registered';
					
				}
			}

		
		}		
	}
	else{
		$msgsEEa = "ALL FIELD MUST BE FILLED";	
	} 
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel | users</title>
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
		function make_text(texts){
			if (texts.options[texts.selectedIndex].text == 'Selected'){
				document.getElementById('gender').value = '';
				document.getElementById('sel_err').innerHTML = "Please choose your gender"; 
			}
			else{
				document.getElementById('gender').value = texts.options[texts.selectedIndex].text;
			}
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
					<li><a href="posts.php">Post</a></li>
					<li class="active"><a href="users.php">Users</a></li>
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
					<h1><span class="fa fa-gear fa-lg"> Users</span> <small>Manage site user</small></h1>
				</div>
				<div class="col-md-2">
					<div class="dropdown create">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1">Create Content
        			<span class="caret"></span>
        		</button>
						<ul class="dropdown-menu">
         		 <li><a href="#" data-toggle="modal" data-target="#addPage">Add Post</a></li>
         		 <li><a href="#" data-toggle="modal" data-target="#addUser">Add User</a></li>
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
			   <li><a href="posts.php">Post</a></li>
			   <li class="active"><a href="users.php">Users</a></li>  
			</ul>
			<?php
	        	if (isset($msgE)) {
	        ?>
	        <div class="alert alert-danger aleart-dismissable">
	        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        	<h4 class="text-center"><strong><?php echo $msgE; ?></strong></h4>
	        </div>
	     <?php } ?>
			<?php
	        	if (isset($msgs)) {
	        ?>
	        <div class="alert alert-success aleart-dismissable">
	        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        	<h4 class="text-center"><strong><?php echo $msgs; ?></strong></h4>
	        </div>
	      <?php } ?>
	   <?php
	        	if (isset($msgEE)) {
	        ?>
	        <div class="alert alert-danger aleart-dismissable">
	        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        	<h4 class="text-center"><strong><?php echo $msgEE; ?></strong></h4>
	        </div>
	        <?php } ?>
	         <?php
	        	if (isset($msgsEEa)) {
	        ?>
	        <div class="alert alert-danger aleart-dismissable">
	        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        	<h4 class="text-center"><strong><?php echo $msgsEEa; ?></strong></h4>
	        </div>
	        <?php } ?>

	         <?php
	        	if ((isset($msgeea) && $msgeea==true) || (isset($Sel_err) && $Sel_err==true) || (isset($msgum) && $msgum==true) || (isset($msgem) && $msgem==true)) {
	        ?>
	        <div class="alert alert-danger aleart-dismissable">
	        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        	<h4 class="text-warning" style="margin: 0px;"><strong><?php echo @$msgEEa; if(isset($sel_err)){echo "<hr style='margin:5px'>".@$sel_err;}if(isset($msgUm)){ echo "<hr style='margin:5px'>". $msgUm;}if(isset($msgEm)){ echo "<hr style='margin:5px'>". $msgEm;} ?></strong></h4>
	        </div>	
	   <?php }
	   	if (isset($msgreport)) {
	   ?>  
	   		<div class="alert alert-success aleart-dismissable">
	        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        	<h4 class="text-center"><strong><?php echo $msgreport; ?></strong></h4>
	        </div>
	   <?php
	       }
	   ?>
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
					  <a href="users.php" class="list-group-item"><span class="fa fa-user"> Users </span><span class="badge"><?php echo $total_user; ?></span></a>
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
							<h3 class="panel-title">Users</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<input type="text" name="filter_users" id="filter_users" class="form-control" placeholder="Search By name or email address...">
								</div>
							</div>
							<br>
							<div id="msgss"></div>
							<div class="table-responsive">
								<div id="users"></div>
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
	<!-- Modal -->
	<div id="addPage" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header" style="padding-bottom: 0px;">
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

	<!-- Modal for user -->
	<div id="addUser" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header" style="padding-bottom: 0px;">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add User</h4>
	        <div id="report_error"></div>
	        <?php if (isset($msgeea) && $msgeea==true ){?><h3 class="well text-danger"><?php echo $msgEEa; ?><?php }?></h3>
	      </div>
	      <div class="modal-body">
	      	<h3 class="text text-danger" id="err"></h3>
	       	<form method="POST" id="add_user" action="">
	        	<div class="input-group">
	        		<span class="input-group-addon main-color-bg"><span class="fa fa-user"></span></span>
	        		<input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter your name" autocomplete="off" required maxlength="20" value="<?php if(isset($user_name)){echo $user_name; }?>">
	        	</div>
	        	 <?php if(isset($msgum) && $msgum==true){?><span class="well text-danger" style="padding-bottom: 5px; padding-top: 10; padding-left: 10px;"><?php echo $msgUm; }?></span><span id="msg1" class="text-danger"></span>
						<br>
	        	<div class="input-group">
      				<span class="input-group-addon main-color-bg"><span class="fa fa-envelope"></span></span>
      				<input type="email" class="form-control" name="user_email" id="user_email" placeholder="Enter email address" autocomplete="off" required value="<?php if(isset($user_email)){echo $user_email; }?>">
      			</div>
      			<?php if(isset($msgem) && $msgem==true){?><span class="well text-danger" style="padding-bottom: 5px; padding-left: 10px;"><?php echo $msgEm; }?></span>	
			      <br>	
	        	<div class="input-group">
	        		<span class="input-group-addon main-color-bg"><span class="fa fa-lock"></span></span>
	        		<input type="password" class="form-control" name="user_password" id="user_password" placeholder="Enter create password..." autocomplete="off" required>
	        	</div>
	        	 <?php if(isset($msgeea) && $msgeea==true){?><span class="well text-danger" style="padding-bottom: 5px; padding-top: 10; padding-left: 10px;"><?php echo $msgEEa; }?></span><span id="msg2" class="text-danger"></span>	
	        
	        	<br>
	        	<div class="input-group">
	        		<span class="input-group-addon main-color-bg"><span class="fa fa-lock"></span></span>
	        		<input type="password" class="form-control" name="user_confirm_password" id="user_confirm_password" placeholder="Confirm password" autocomplete="off" required>
	        	</div>
	        	<span id="msg3" class="text-danger"></span>
			      <br>
	      		<input type="hidden" name="gender" id="gender" value="<?php if(!empty($gender)) echo $gender; ?>">
	      		<div class="input-group">
	        		<span class="input-group-addon main-color-bg"><span>Sex</span></span>
	        		 <select class="form-control" onchange="make_text(this)">
	        		 	<option>Selected</option>
	        		 	<?php if(!empty($gender)){
	        		 		echo "<option selected>".$gender."</option>";
	        		 		}
	        		 	?>
									<option>Male</option>
									<option>Female</option>
	        		 </select>
	        	</div>
	        <?php if(isset($Sel_err) && $Sel_err==true){?><span class="well text-danger" style="padding-bottom: 5px; padding-top: 10px; padding-left: 10px;"><?php echo $sel_err; }?></span><span id="msg0" class="text-danger"></span>		
	        <br>
	        	<div class="input-group">
	        		<span class="input-group-addon main-color-bg"><span>Date of Birth</span></span>
	        		<input type="date" class="form-control" name="user_dob" id="user_dob" placeholder="Enter date of birth" autocomplete="off" max="2000-12-31" required value="<?php if(isset($user_dob)){ echo $user_dob; }?>">
	        	</div>
	        <br>  
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	         <button type="submit" id="submit_user" name="submit_user" class="btn main-color-bg">Add user</button>
	      </div>
	    </form>
	    </div>
	  </div>
	</div>
	<script type="text/javascript" src="../assets/bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/add_user.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/users.js"></script>
	<script>
		CKEDITOR.replace('editor1');
	</script>
</body>
</html>