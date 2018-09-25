<?php
/*require_once ('db.inc.php');
if (isset($_POST['submit'])) {
  if (!empty($_POST['name']) && !empty($_POST['comment'])) {
    $name = mysqli_real_escape_string($connect, filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $name  = ucfirst(strtolower(trim($name)));
    $comment = mysqli_real_escape_string($connect, filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
    $comment = ucfirst(trim($comment));
    $post_id  = $_POST['posts'];
    $parent_id = $_POST['parent_id'];
    $valid_name = "/^[a-zA-Z ]*$/";
    $output='';
    if(strlen($name)<2 || strlen($name)> 20){
       $comment_error = "Name must be btw 2 and 20 characters";
        $output.= "<div class='alert alert-danger alert-dismissable'>
              <a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
              <strong>".$comment_error."</strong>
           </div>";
    }
    else if(!preg_match($valid_name, $name)){
      $comment_error = "Only letters and white space allowed";
      $output.= "<div class='alert alert-danger alert-dismissable'>
              <a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
              <strong>".$comment_error."</strong>
           </div>";
    }
    else{
      $name_exist = "SELECT user_name_comment FROM comments WHERE user_name_comment= '$name' AND post_id=".$post_id."";
      $query_name_exist = mysqli_query($connect, $name_exist);
      if (mysqli_num_rows($query_name_exist)>0) {
        $comment_error = 'name already exist...Pls try another name';
        $output.= "<div class='alert alert-danger alert-dismissable'>
              <a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
              <strong>".$comment_error."</strong>
           </div>";
      }
      else{
        $count=0;
        $post_comment = "INSERT INTO comments(user_name_comment, comment_content, post_id, parent_id) VALUES('$name','$comment','$post_id','$parent_id')";
        $query_post_comment = mysqli_query($connect, $post_comment);
        if ($query_post_comment) {
          $count++;
          $insert_total_comment = "UPDATE posts SET total_comment=$count WHERE post_id =".$post_id."";
          $query_total_comment = mysqli_query($connect ,$insert_total_comment);
          $post_id = $_POST['posts'];
          $count_comment = "SELECT total_comment FROM posts WHERE post_id = ".$post_id."";
          $query_count_comment = mysqli_query($connect,$count_comment);
          while ($row = mysqli_fetch_assoc($query_count_comment)) {
            $total_count = $row['total_comment'];
            $output .= "<h2>Comments<span class='label main-color-bg' style='font-size: 18px;'>".$total_count."</span></h2>
                      <hr style='border: 1px solid #cccccc; border-radius: 3px;'>";
          }
          $select = "SELECT * FROM comments WHERE post_id=".$post_id."";
          $run_select = mysqli_query($connect, $select);
          $count=0;
          while ($row = mysqli_fetch_assoc($run_select)) {
            $comment_id = $row['comment_id'];
            $name = $row['user_name_comment'];
            $comment = $row['comment_content'];
            $comment_time = $row['time'];
            $comment_time = strtotime($comment_time);
            $comment_time = date('D M Y, h:i a', $comment_time);
            $count++;

            $output .= "<div class='media' data_id='".$comment_id."'>
                          <div class='media-left'>
                          <img src='assets/img/avatar.png' class='media-object' style='width:60px'>
                        </div>
                        <div class='media-body'>
                          <h4 class='media-heading'>".$name."
                            <small style='font-size: 10px;' class='text-danger'>".$comment_time."</small>
                          </h4>
                        <div class='media-text'>
                          <p>".$comment."</p>
                          <div style='padding-bottom: 5px;'>
                            <a href='#' class='btn btn-xs btn-success'><span class='fa fa-thumbs-up'>0</span></a>&nbsp;&nbsp;
                            <a href='#' class='btn btn-xs btn-danger'><span class='fa fa-thumbs-down'>0</span></a>&nbsp;&nbsp;
                            <a href='#' class='btn btn-xs btn-default' id='reply_link'><span>Reply</span></a>
                          </div>
                        </div>
                      </div>
                    </div>";
          }
          $t_count = $count;
          $insert_total_comment = "UPDATE posts SET total_comment=$count WHERE post_id =".$post_id."";
          $query_total_comment = mysqli_query($connect ,$insert_total_comment);
          
          $output .=" </div>    
                    </div>";
          
          $output .= "<div class='alert alert-success alert-dismissable'>
              <a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
              <strong>Comment successful added</strong>
           </div>";
           
        }
        else{
          $output.= "<div class='alert alert-danger alert-dismissable'>
              <a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
              <strong>Comment NOT successful added</strong>
           </div>";
        }
      }
    }
  }
  else{
    $comment_error = 'All Field must be filled';
      $output.= "<div class='alert alert-danger alert-dismissable'>
              <a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
              <strong>".$comment_error."</strong>
           </div>";
  
  }
  echo "$output";
}*/

//display
/*if (isset($_POST['display_comment'])) {
  $post_id = $_POST['posts'];
 
  $output='';
  $count_comment = "SELECT total_comment FROM posts WHERE post_id = ".$post_id."";
  $query_count_comment = mysqli_query($connect,$count_comment);
  while ($row = mysqli_fetch_assoc($query_count_comment)) {
    $total_count = $row['total_comment'];
    $output .= "<h2>Comments<span class='label main-color-bg' style='font-size: 18px;'>".$total_count."</span></h2>
              <hr style='border: 1px solid #cccccc; border-radius: 3px;'>";
  }
  $select = "SELECT * FROM comments WHERE post_id=".$post_id."";
  $run_select = mysqli_query($connect, $select);
  $count=0;
  while ($row = mysqli_fetch_assoc($run_select)) { 
    $comment_id = $row['comment_id'];
    $name = $row['user_name_comment'];
    $comment = $row['comment_content'];
    $comment_time = $row['comment_time'];
    $comment_time = strtotime($comment_time);
    $comment_time = date('D M Y, h:i a', $comment_time);
    $count++;

    $output .= "<div class='media' data_id='".$comment_id."' >
              <div class='media-left'>
                <img src='assets/img/avatar.png' class='media-object' style='width:60px'>
              </div>
              <div class='media-body'>
                <h4 class='media-heading'>".$name."
                  <small style='font-size: 10px;' class='text-danger'>".$comment_time."</small>
                </h4>
                <div class='media-text'>
                  <p>".$comment."</p>
                  <div style='padding-bottom: 5px;'>
                    <a href='#' class='btn btn-xs btn-success'><span class='fa fa-thumbs-up'>0</span></a>&nbsp;&nbsp;
                    <a href='#' class='btn btn-xs btn-danger'><span class='fa fa-thumbs-down'>0</span></a>&nbsp;&nbsp;
                    <a href='#' class='btn btn-xs btn-default' id='reply_link'><span>Reply</span></a>
                  </div>
                </div>
              </div>
            </div>";
  }
  
  $output .=" </div>    
            </div>";
  echo $output;
  $insert_total_comment = "UPDATE posts SET total_comment=$count WHERE post_id =".$post_id."";
  $query_total_comment = mysqli_query($connect ,$insert_total_comment);

}*/
?>