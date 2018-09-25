<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/akproko/defines.php';
// to display recent post
if (isset($_POST['recent'])) {
  $output='';
  $sql = "SELECT * FROM posts ORDER BY post_date DESC LIMIT 0, 4";
  $sql_query = mysqli_query($connect, $sql);

 while ($row = mysqli_fetch_assoc($sql_query)) {
    $post_id = $row['post_id'];
    $post_title = substr($row['post_title'], 0, 80);
    $post_image = $row['post_image'];
    $post_author = $row['post_author'];
    $total_comment = $row['total_comment'];
    $post_date =  date("M d y, h:i a",strtotime($row['post_date']));

    $output.= " <div class='row'>
                  <div class='col-md-3 col-sm-3 col-xs-3' style='padding-right:0px;'>
                    <a href='readmore.php?id=".$post_id."'>
                      <img src='assets/img/".$post_image."' class='img-responsive img-thumbnail shadow'  width='100' height='100' alt='".$post_image."'>
                    </a>
                  </div>
                  <div class='col-md-9 col-sm-9 col-xs-9'style='padding-left:5px;'>
                    <a href='readmore.php?id=".$post_id."' class='remove-underline'>
                        <p style='font-size:15px; line-height:20px;' class='text-justify'>".$post_title."</p>
                    </a>
                  </div>          
                </div>
                <div class='row' style='padding-top:5px;'>
                  <div class='col-md-4 col-sm-4 col-xs-4'>
                    <p  class='text text-danger' style='font-size: 12px;'><a href='#' title='share'<span class='fa fa-share text-primary'></span></a>&nbsp;&nbsp;".$post_author."
                    </p>
                  </div>
                  <div class='col-md-3 col-sm-2 col-xs-2' style='padding:0px;'>
                    <p style='font-size: 12px;'><a href='readmore.php?id=".$post_id."#disqus_thread' class='remove-underline text text-danger'>0 Comments</a>
                    </p>
                  </div>
                  <div class='col-md-5 col-sm-6 col-xs-6'>
                    <p class='text text-center text-danger' style='font-size: 12px;'><span class='fa fa-calendar-check-o text-primary'></span>&nbsp;".$post_date."</p>
                  </div>
                </div>
              <hr style='border: 1px solid  #1ed4b4; border-radius: 3px; margin-bottom:10px; margin-top:0px;'>
            
          ";
  
  }

   echo $output; 
}

?>
