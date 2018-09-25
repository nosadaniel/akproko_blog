<?php 
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['name']);
//$msg = "Logout was successfull";
$url = "index.php";
if(isset($_GET["session_expired"])) {
	$url .= "?session_expired=" . $_GET["session_expired"];
}
header("Location:$url");
//header("location:index.php?".$msg."");
?>