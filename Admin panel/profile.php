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

$counts = "SELECT * FROM total_all";
$query_count_posts = mysqli_query($connect,$counts);
$row = mysqli_fetch_assoc($query_count_posts);
$total_post = $row['total_post'];
$total_comment = $row['total_comment'];
$total_visitor = $row['total_visitor'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel | Profile </title>
	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewpoint" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/style.css"/>
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
				<?php if($_SESSION['user_id'] != 4){ ?>
					<li class="disabled"><a href="users.php">Users</a></li>
				<?php }else{?>
						<li><a href="users.php">Users</a></li>
				<?php }?>
				 <li><a href="Suggestion.php">Feedback</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="#">Welcome, <?php echo ucfirst($_SESSION['name']);?></a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div><!--nav collapse -->
		</div>
	</nav>
	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<h1><span class="fa fa-user fa-lg"> Profile</span> <small>Manage Your Account</small></h1>
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
			  <li class="active"><a href="profile.php">Profile</a></li>
			  <li><a href="Suggestion.php">Feedback</a></li>
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
					  <a href="dashboard.php" class="list-group-item"><span class="fa fa-sign-in"> Visitors </span><span class="badge"><?php echo $total_visitor; ?></span></a>
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
				 <!-- <p class="text text-danger" id="report_err"></p> -->
				<!--  <div id="report_error"></div> -->
					<div class="panel panel">
						<div class="panel-heading main-color-bg">
							<h3 class="panel-title">Profile</h3>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<div id="user_profile"></div>
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
	<!--modal for change name -->
	<div id="changeUsername" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header" style="padding-bottom: 0px;">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"><span class="fa fa-user fa-4x"></span>&nbsp; Change Username</h4>
	        <div id="report_error"></div>
	        <p class="text text-danger" id="report_err"></p>
	      </div>
	      <div class="modal-body">
	       	<form method="POST" id="change_name">
	       		<div class="input-group">
							<span class="input-group-addon"><span class="fa fa-user"></span></span>
							<input type="text" name="user_name" class="form-control" id="user_name" autocomplete="off" autofocus="on" required value="<?php echo $_SESSION['name']; ?>" >
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><span class="fa fa-lock"></span></span>
							<input type="password" name="password" class="form-control" id="password"  autofocus="on"  placeholder="Please enter your password for verification purpose" required>
						</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	         <button type="submit" id="save_changes" name="save_changes" class="btn main-color-bg">Save Changes</button>
	      </div>
	    </form>
	    </div>
	  </div>
	</div>
	<!--modal for change password -->
	<div id="changePassword" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header" style="padding-bottom: 0px;">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"><span class="fa fa-lock fa-4x"></span>&nbsp; Change Password</h4>
	        <div id="report_error_pass"></div>
	        <div id="report_err_pass"></div>
	      </div>
	      <div class="modal-body">
	      	<h3 class="text text-danger" id="err"></h3>
	       	<form method="POST" id="change_password">
	       		<div class="input-group">
							<span class="input-group-addon"><span class="fa fa-lock"></span>&nbsp;Old Password</span>
							<input type="password" name="password_old" class="form-control" id="password_old"  autofocus="on"  placeholder="Please enter your existing password">
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><span class="fa fa-lock"></span>&nbsp;New password</span>
							<input type="password" name="password_new" class="form-control" id="password_new"  autofocus="on" required placeholder="Please enter your new password">
						</div>
						<div id="err_msg"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	         <button type="submit" id="submit_password" name="save_changes" class="btn main-color-bg">Save Changes</button>
	      </div>
	    </form>
	    </div>
	  </div>
	</div>
	<script type="text/javascript" src="../assets/bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/admin_process.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/profile.js"></script>
</body>
</html>