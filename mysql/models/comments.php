<?php
/**
* 
*/
//require_once $_SERVER['DOCUMENT_ROOT'].'/akproko/defines.php';
class Comments
{	
	public static function getComments($connect, $post_id){
		$output = array();
		$sel = "SELECT * FROM comments WHERE post_id =".$post_id." ORDER BY comment_time DESC";
		$run_sel = mysqli_query($connect, $sel);
		if($run_sel){
			if (mysqli_num_rows($run_sel)>0) {
				while($row = mysqli_fetch_assoc($run_sel)){
					$output[] = $row;
				}
			}
		}
		return $output;
	}
	public static function insert($user,$text,$post_id, $connect){
		$sql = "INSERT INTO comments(comment_id, user_name_comment, comment_content, comment_time, post_id)
		VALUES('','$user','$text',CURRENT_TIMESTAMP, $post_id)";
		$query = mysqli_query($connect,$sql);
		if ($query) {
			$std = new stdClass();
			$std->user = $user;
			$std->text = $text;
			$std->post_id = (int)$post_id;
			return $std;
		}
		return null;
	}
	public static function update(){

	}
	public static function delete(){

	}
}


?>