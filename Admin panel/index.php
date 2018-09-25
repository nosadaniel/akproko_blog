<?php
session_start();
require_once('timeout.php');
if(isset($_SESSION["user_id"])) {
	if(!isLoginSessionExpired()) {
		header("Location:dashboard.php");
	} 
	else {
		header("Location:logout.php?session_expired=1");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel | Account Login</title>
	<meta charset="utf-8">
	<meta name="viewpoint" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css"/>
	
	<link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/mystyle.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/mystyle.css"/>
</head>
<body>
	<nav class="navbar">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">AKPROKO BLOG</a>
			</div>
		</div>
	</nav>
	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-center"><span class="fa fa-cogs fa-lg"> Admin Area</span> <small>Account Login</small></h1>
				</div>
			</div>
		</div>
	</header>
	<section id="main">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 col-md-offset-4" style="margin-top: 20px;">
					<div id="msg1"></div>
					<div id="msg"></div>
					<div class="well shadow">
						<form method="POST" id="form_login">
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-user"></span></span>
								<input type="text" name="user_name" class="form-control" id="user_name"  placeholder="Login with username or email address" autofocus="on" required autocomplete="off">
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-lock"></span></span>
								<input type="password" name="password" class="form-control" id="password" placeholder="Enter Password..." autocomplete="off" autofocus="" required>
							</div>
							<br>
							<button class="btn btn-block btn-default" type="submit" id="login_btn" name="login"><strong>Login</strong></button>
						</form>
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
	<script type="text/javascript" src="../assets/bootstrap/js/enter.js"></script>
	
</body>
</html>