<?php
//directory for connection to database
require_once $_SERVER['DOCUMENT_ROOT'].'/akproko/defines.php';
//to logout inactive user admin after 1hour
require_once('../admin panel/timeout.php');
session_start();
if(isset($_POST['log_on'])){
	if(!empty($_POST['user']) && !empty($_POST['password'])){
		function clean($val){
			$val = trim($val);
			$val = stripslashes($val);
			$val = filter_var($val, FILTER_SANITIZE_STRING);
			return $val;
		}
		$user_name = mysqli_real_escape_string($connect, clean($_POST['user']));
		$password = mysqli_real_escape_string($connect, clean($_POST['password']));
		$hash_password = md5($password);
		$user_name = strtolower($user_name);
		$sql = "SELECT * FROM users WHERE user_password='$hash_password' AND (user_name ='$user_name' OR user_email='$user_name')";
		$run_sql = mysqli_query($connect, $sql);
		if(mysqli_num_rows($run_sql)==1){
			$row = mysqli_fetch_assoc($run_sql);
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['name'] = ucfirst($row['user_name']);
			$_SESSION['loggedin_time'] = time();
			echo "afwawwawfaawafwsdsa2e4rq5";
		}
		else{
			echo "<div class='alert alert-danger aleart-dismissable'>
	        	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	        	<p><strong>Incorrect Username or Password...</strong></p>
	        </div>";
		}
	}
}


?>