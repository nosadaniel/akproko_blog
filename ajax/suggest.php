<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/akproko/defines.php';
if (isset($_POST['suggest'])) {
	function clean($data){
		$data = filter_var($data,FILTER_SANITIZE_STRING);
		$data = ucfirst($data);
		return $data;
	}
	$user_name = mysqli_real_escape_string($connect, $_POST['user_name']);
	$user_email = mysqli_real_escape_string($connect, $_POST['user_email']);
	$user_comment = mysqli_real_escape_string($connect, $_POST['user_comment']);
	if (!empty($user_name) && !empty($user_email) && !empty($user_comment)) {
		$user_name = clean($user_name);
		$user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);
		$user_comment = clean($user_comment);
		$val = "/^[a-zA-Z ]*$/";
		if(!preg_match($val, $user_name)) {
			echo "<div class='alert alert-warning aleart-dismissable'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><p><strong>INVALID CHARACTERS FOUND IN YOU NAME...</strong><br>Pleas try a valid one</p></div>";
		}
		else{
			if (!filter_var($user_email,FILTER_VALIDATE_EMAIL)) {
				echo "<div class='alert alert-warning aleart-dismissable'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><p><strong>INVALID EMAIL ADDRESS...</strong></p></div>";
			}
			else{
				$insert = "INSERT INTO suggestions(sug_id,sug_name,sug_email,sug_body,sug_date)VALUES('', '$user_name','$user_email','$user_comment', CURRENT_TIMESTAMP)";
				$run = mysqli_query($connect,$insert);
				if ($run) {
					echo "<div class='alert alert-info aleart-dismissable'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><p><strong>Suggestion Sent Successfully...Thanks for you feedback</strong><br>
						We will get back to you soon through the email address you provided.</p></div>";
				}
				else{
					echo "<div class='alert  alert-danger alert-dismissable'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><p><strong>Oops something went wrong...The developer has been contacted</strong><br>Please try again another time</p></div>";
				}
			}
		}
	}
	else{
		echo "<div class='alert alert-danger aleart-dismissable'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><p><strong>ALL FIELDS ARE REQUIRED...</strong></p></div>";
	}
}



?>