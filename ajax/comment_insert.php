<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/akproko/defines.php';
//require_once MYSQL_DIR.'db.php';
if (isset($_POST['com_insert'])) {
	$user = filter_var($_POST['comment_name'], FILTER_SANITIZE_STRING);
	$text = filter_var($_POST['comment_text'], FILTER_SANITIZE_STRING);
	$user = ucfirst($user);
	$text = ucfirst(str_replace("\n", "<br>",$text));
	$post_id = (int)$_POST['post_id'];
	$user = mysqli_real_escape_string($connect,$user);
	$text = mysqli_real_escape_string($connect,$text);
	if(!empty($user) && !empty($text) && !empty($post_id)){
		if (strlen($user)<=3 || strlen($user)>=11) {
			echo "please your name should be at least 4 to 10 characters ";
			die();
		}
		require_once MODELS .'comments.php';
		$std = new stdClass();
		$std->comment = null;
		$std->error = false;
		if (class_exists('Comments')) {
			$comment_info = Comments::insert($user, $text, $post_id, $connect);
			if ($comment_info!=null) {
				$std->error = false;
			}
			$std = new stdClass();
			$std->comment = $comment_info;
		}
		echo json_encode($std);

	}
	else{
		echo "<script>alert('All fields are required');</script>";
	}
}

?>