<?php
session_start();
if(!isset($_SESSION['user_id'])){
	header('location:index.php');
}
//to connect to database
require_once $_SERVER['DOCUMENT_ROOT'].'/akproko/defines.php';
//to view user_profile
if (isset($_POST['user_profile'])) {
	$output="";
	$sql = "SELECT * FROM users WHERE user_id=".$_SESSION['user_id']."";
	$run = mysqli_query($connect, $sql);
	$output .= "<table class='table table-striped table-hover'>
									<thead>
										<tr>
											<th width='20%'>Name</th>
											<th width='10%'>email</th>
											<th width='20%'><span class='fa fa-birthday-cake'></span></th>
											<th width='20%'>Action</th>
											<th></th>
										</tr>
									</thead>
									";
	if (mysqli_num_rows($run)==1) {
		$row = mysqli_fetch_assoc($run);
		$name= $row['user_name'];
		$email= $row['user_email'];
		$user_dob = date('d M',strtotime($row['user_dob']));

		$output .="<tbody>
								<tr>
									<td>".ucfirst($name)."</td>
									<td>".$email."</td>
									<td>".$user_dob."</td>
									<td><a href='#' class='btn btn-primary' title='change Username' data-toggle='modal' data-target='#changeUsername'><span class='fa fa-gear'></span>&nbsp; Change username</a></td>
									<td><a href='#' class='btn btn-warning' title='change password' data-toggle='modal' data-target='#changePassword'><span class='fa fa-gear'></span>&nbsp; Change password</a></td>
								</tr>
							</tbody>";
	}
	$output.="</table>";
	echo $output;
}
//to change username
if (isset($_POST['name_change'])) {
	if (!empty($_POST['user']) && !empty( $_POST['password'])) {
		function clean($val){
			$val = trim($val);
			$val = stripslashes($val);
			$val = filter_var($val, FILTER_SANITIZE_STRING);
			return $val;
		}
		$user_name = clean($_POST['user']);
		$password = clean($_POST['password']);
		$user_name = strtolower($user_name);
		$hash_password = md5($password);
		if (strlen($user_name) <2 || strlen($user_name)>21 ) {
			$msg = "User name must between 2 to 20 characters";
			echo "<div class='alert alert-danger alert-dismissable'>
							<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	        	<p><strong>".$msg."</strong></p>
	        </div>";
	        exit();
		}
		$sql = "SELECT * FROM users WHERE user_password='$hash_password' AND user_id =".$_SESSION['user_id']."";
		$run_pass = mysqli_query($connect, $sql);
		//check if password is correct
		if (mysqli_num_rows($run_pass)==0) {
			echo "<div class='alert alert-danger alert-dismissable'>
							<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	        	<p><strong>Incorrect Password...</strong></p>
	        </div>";
	        exit();
		}
		$sql_name = "SELECT user_name, user_id FROM users WHERE user_name='$user_name' AND user_id =".$_SESSION['user_id']."";
		$run_name = mysqli_query($connect, $sql_name);
		//check if username is already in user by the same user		
		if (mysqli_num_rows($run_name)==1) {
				echo "<div class='alert alert-warning alert-dismissable'>
								<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        				<p><strong>Username Already In Used By You...Pls Choose Another Different Username</strong></p>
        			</div>";
        			exit();
        			$check1=true;
    }
    $sql_name1 = "SELECT user_name, user_id FROM users WHERE user_name='$user_name'";
		$run_name1 = mysqli_query($connect, $sql_name1);
		// check if username is already in used by another user
		if (mysqli_num_rows($run_name1)>=1) {
			echo 	"<div class='alert alert-danger alert-dismissable'>
							<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      				<p><strong>Username Already In Used By Another User...please Try Again</strong></p>
      			</div>";
  		$check2=true;
  		exit();
  	}
		if(!isset($check1) && !isset($check2)){
			$sql_update ="UPDATE users SET user_name='$user_name' WHERE user_id=".$_SESSION['user_id']."";
			$run_update = mysqli_query($connect, $sql_update);
			if($run_update){
				unset($_SESSION['user_id']);
				unset($_SESSION['name']);
				echo "39ia;k#aw";
			}
		}
	}
	else{
		echo "<div class='alert alert-danger alert-dismissable'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	        	<p><strong>All fields are required...</strong></p>
	        </div>";
	}
}
//to change user password
if (isset($_POST['change_password'])) {
	if (!empty($_POST['old_pass']) && !empty( $_POST['new_pass'])) {
		function clean($val){
			$val = trim($val);
			$val = stripslashes($val);
			$val = filter_var($val, FILTER_SANITIZE_STRING);
			return $val;
		}
		$old_pass = clean($_POST['old_pass']);
		$new_pass = clean($_POST['new_pass']);
		$hash_old_password = md5($old_pass);
		$hash_new_password = md5($new_pass);
		if (strlen($new_pass) <=4 ) {
			$msg = "Password Must Be Atleast 5 Characters Long";
			echo "<div class='alert alert-danger alert-dismissable'>
							<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	        	<p><strong>".$msg."</strong></p>
	        </div>";
	        exit();
		}
		if ($old_pass==$new_pass) {
			$msg = "Your New Password Must be Different From The Existing One";
			echo "<div class='alert alert-danger alert-dismissable'>
							<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	        	<p><strong>".$msg."</strong></p>
	        </div>";
	        exit();
		}
		$sql = "SELECT * FROM users WHERE user_password='$hash_old_password' AND user_id =".$_SESSION['user_id']."";
		$run_pass = mysqli_query($connect, $sql);
		if (mysqli_num_rows($run_pass)==0) {
			echo "<div class='alert alert-danger alert-dismissable'>
							<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	        	<p><strong>Your Old Password Is Incorrect...</strong></p>
	        </div>";
	        $pass=true;
		}
		else{
			$pass=false;
		}
		if($pass==false){
			$sql_update ="UPDATE users SET user_password='$hash_new_password' WHERE user_id=".$_SESSION['user_id']."";
			$run_update = mysqli_query($connect, $sql_update);
			if($run_update){
				unset($_SESSION['user_id']);
				unset($_SESSION['name']);
				echo "alfjoawf34awp87";
			}
		}
	}
	else{
		echo "<div class='alert alert-danger alert-dismissable'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	        	<p><strong>All fields are required...</strong></p>
	        </div>";
	}
}
//close connection
mysqli_close($connect);
?>