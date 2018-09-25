<?php
session_start();
require_once('../admin panel/timeout.php');

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
//to display all users details except password and super admin details
if (isset($_POST['all_users']) || isset($_POST['filter_use'])) {
	if (isset($_POST['all_users'])){
		$display='';
		$sql = "SELECT user_id, user_name, user_email, user_gender, user_dob, time_created FROM users WHERE NOT user_id=".$_SESSION['user_id']."";
	}
	else{
		$display='';
		$search = mysqli_real_escape_string($connect,filter_var(strtolower($_POST['search']), FILTER_SANITIZE_STRING));
		$sql = "SELECT * FROM users WHERE user_name LIKE '%$search%' OR user_email LIKE '%$search%' ";
	}
	$run_sql = mysqli_query($connect, $sql);
	if (mysqli_num_rows($run_sql)>0) {
		$display.= "
								
											<table class='table table-striped table-hover'>
												<thead>
													<tr>
														<th>Name</th>
														<th>Email</th>
														<th>Sex</th>
														<th><span class='fa fa-birthday-cake fa-lg'></span></th>
														<th>Date Created</th>
														<th colspan='2'>Action</th>
													</tr>
												</thead>
												";
		while ($row = mysqli_fetch_assoc($run_sql)) {
			$user_id = $row['user_id'];
			$user_name = $row['user_name'];
			$user_email = $row['user_email'];
			$user_gender = $row['user_gender'];
			$user_dob = date('d M',strtotime($row['user_dob']));
			$time = date('M d Y, h:i a', strtotime($row['time_created']));

			$display .= "		<tr>
												<td>".$user_name."</td>
												<td>".$user_email."</td>
												<td>".$user_gender."</td>
												<td>".$user_dob."</td>
												<td>".$time."</td>
												<td><a href='#' class='btn btn-danger delete' did='".$user_id."' title='Remove User'><span class='fa fa-trash'></	span></a></td>
												
											</tr>";
		}
		$display .= "	</table>";						
	}
	echo $display;
}
//to delete a particular users
if(isset($_POST['del_click'])){
	$delete_id = $_POST['del_id'];
	$sql = "DELETE FROM users WHERE user_id = ".$delete_id."";
	$query_sql = mysqli_query($connect,$sql);
	if($query_sql){
			echo "<div class='alert alert-success alert-dismissable'>
              <a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
              <strong>User Successful Removed.</strong>
           </div>";
  }

}





?>