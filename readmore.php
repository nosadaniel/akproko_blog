<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/akproko/defines.php';
require_once MODELS .'comments.php';
  $post_id = $_GET['id'];
  $title = "SELECT post_title FROM posts WHERE post_id =".$post_id." ";
  $run_query1 = mysqli_query($connect, $title);
  $sql = "SELECT * FROM posts WHERE post_id =".$post_id." ";
  $run_query2 = mysqli_query($connect, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php while ($rows = mysqli_fetch_assoc($run_query1)){ $post_title=$rows['post_title'];
  ?>
  <title><?php echo $post_title;?></title>
  <meta charset="UTF-8">
  <meta name="description" content="akprokoblog">
  <meta name="keywords" content="<?php echo $post_title;}?>">
  <meta name="author" content="Ogagaoghene Meshach">
  <meta name="viewpoint" content="width=device-width, initial-scale=1"/>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="assets/bootstrap/css/owl.carousel.css"/>
  <link rel="stylesheet" href="assets/bootstrap/css/owl.theme.default.min.css"/>
  <link rel="stylesheet" href="assets/bootstrap/css/animate.css"/>
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css"/>
  <link rel="stylesheet" href="assets/bootstrap/css/social-share-kit.css" type="text/css">
  <link rel="stylesheet" href="assets/bootstrap/css/style.css"/>
   <link rel="stylesheet" href="assets/bootstrap/css/comment_style.css"/>
  
</head>
<body>
 
  <!-- for navigation -->
<nav class="navbar navbar-fixed-top shadow">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" style="margin-top:15px; margin-left: 5px;">
        <span class="fa fa-navicon"></span> 
      </button>
      <a class="navbar-brand" href="index.php" style="margin-top: 10px;"><strong>AKPROKO BLOG</strong></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <form class="navbar-form navbar-right">
        <div class="input-group">
          <input type="text" name="search" size="30" placeholder="search..." class="form-control" id="search" >
          <div class="input-group-btn">
            <button class="btn btn-success" type="submit" id="submit">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</nav>
<p><br><br></p>
<!-- for slider-->
<div class="container">
  <div class="row">
    <div class="col-md-12">
    </div>
  </div>
</div>
<!-- for advert-->
<div class="container-fluid" style="margin-top:50px">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<a href="#"><img></a>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-6">
			<a href="#"><img></a>
		</div>
	</div>
</div>
<p><br><br></p>


<div class="container-fluid">
  <!-- news panel -->
	<div class="col-md-8 col-sm-8 col-xs-12" >
    <?php
      while ($row = mysqli_fetch_assoc($run_query2)) {
        $post_heading = $row['post_heading'];
        $post_img = $row['post_image'];
        $post_title = $row['post_title'];
        $post_content = $row['post_content'];
        $post_author = $row['post_author'];
        $post_date =  date("M d Y, h:i a",strtotime($row['post_date']));
        $total_comment = $row['total_comment'];
    ?>
     
        <div class="shadow" style="background-color: white; padding: 20px; border-radius: 3px;">
          <h1 class="well shadow"><small class='text-primary text-justify'><?php echo $post_title; ?></small></h1>
          <a href='#' data-toggle='modal' data-target='#<?php echo $post_id; ?>'>
            <img src='assets/img/<?php echo $post_img; ?>' class='img-responsive' height='200' width='200'>
          </a>
          <p><?php echo $post_content;?></p>
          <hr style="border: 1px solid  #1ed4b4; border-radius: 3px;">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-5 col-sm-4 col-xs-4">
                <p class="text-danger"><b>Published By:</b>&nbsp;<?php echo $post_author; ?></p>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3">
                <a href='readmore.php?id=<?php echo $post_id?>#disqus_thread' class='remove-underline text text-danger'>0 Comments</a>
              </div> 
               <div class="col-md-4 col-sm-4 col-xs-4">
                <p class="text-danger"><span class="fa fa-calendar-check-o"></span>&nbsp;<?php echo $post_date;?></p>
              </div>
            </div>
          </div>
          <hr style="border: 1px solid  #1ed4b4; border-radius: 3px;">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <!--share icon -->
              <b>Share this Story:</b>
              <div class="ssk-group ssk-count ssk-lg">
                <a href="#" class="ssk ssk-facebook" data-toggle="tooltip" title="Share on facebook" ></a>
                <a href="#" class="ssk ssk-twitter" data-toggle="tooltip" title="Share on twitter" ></a>
                <a href="#" class="ssk ssk-whatsapp hidden-lg hidden-md" data-toggle="tooltip" title="Share on whatsapp" ></a>
                <a href="#" class="ssk ssk-email" data-toggle="tooltip" title="Share with your email address" ></a>
              </div>
              <hr style="border: 1px solid  #1ed4b4; border-radius: 3px;">
            </div>
           </div>
          <?php
            }
          ?>
          <!--most read stories-->
          <div class="row">
            <?php
              $query = "SELECT post_image, post_title, total_comment, post_id FROM posts";
              $run_query = mysqli_query($connect, $query);
            ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="panel" style="margin-bottom: 0px;">
                <div class="panel-heading main-color-bg">
                  <strong class="panel-title" style="color:#333333;">Most Read Stories</strong>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="owl-carousel owl-theme well ">
                      <?php
                        while ($row = mysqli_fetch_assoc($run_query)) {
                        $post_id = $row['post_id'];
                        $post_title = substr($row['post_title'], 0, 40);
                        $post_image = $row['post_image'];
                      ?>
                      <div class="item">
                        <div class='thumbnail' style="margin:0px;" >
                          <a href='readmore.php?id=<?php echo $post_id; ?>' class='remove-underline' >  
                            <img src='assets/img/<?php echo $post_image;?>' class='img-responsive'  alt='<?php echo $post_image;?>' style='width:100%;' >
                            <div class='caption' style="padding: 0px;">
                              <strong class='text-justify text-primary'><?php echo substr($post_title, 0, 30);?></strong>
                            </div>
                          </a>
                        </div>
                      </div>
                      <?php
                        }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr style="border: 1px solid #cccccc; border-radius: 3px;">
          <!--comment area-->
          <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12">
                <!--disqus comment plugin api-->
                <div id="disqus_thread"></div> 
                <!-- custom comment-->
              <div class="comment-wrapper">
                <h3 class="comment-title">User feedback....</h3>
                <div class="comment-insert">
                  <div class="input-group" style="margin: 5px 5px 0px 5px;">
                    <span class="input-group-addon">name</span>
                    <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter your name here..." maxlength="10">
                     <input type="hidden" name="" id="p_id" value="<?php echo $_GET['id']; ?>">
                  </div>
                  <div class="comment-container">
                    <textarea name="comment_body" id="comment_body" class="comment-insert-text" placeholder="Comment here..."></textarea>

                  </div>
                  <div class="comment-btn">
                    <button class="btn btn-info btn-sm" type="submit" id="comment_btn">Post</button>
                  </div>
                </div>
                <div class="comment-list">
                  <ul class="comments-holder-ul">
                    <?php $comments = Comments::getComments($connect, $_GET['id']); ?>
                    <?php require_once INCLUDES .'comment_box.php'; ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      <div class="clearfix"></div>  
  </div>
  <!--Recent news-->
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="panel shadow" style="margin-bottom: 0px;">
      <div class="panel-heading main-color-bg">
        <strong class="panel-title " style="color:#333333;">RECENT NEWS</strong>
      </div>
      <div class="panel-body shadow" style="padding: 10px;">
        <div id="display_recent_post"></div>
      </div>
    </div>
  </div>
</div>
  <p><br></p>
<!--footer-->
<div id="footer">
  <h5 class="text-center" style="padding-top: 10px; margin-bottom: 0px;">Akproko &copy 2017 - <?php echo date('Y'); ?></h5>
  <p class="text-center"><span class="text-primary">Design and Developed By </span><small>Nosa Daniel</small></p>
</div>

<!--#modal-->                    
<div class='modal fade' id='<?php echo $_GET['id'];?>' role='dialog'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title'><?php echo $post_title; ?></h4>
      </div>
    <div class='modal-body'>
      <img src='assets/img/<?php echo $post_img; ?>' class='img-responsive img-thumbnail' alt='<?php echo $post_img; ?>' width='600' height='600'>
    </div>
  </div>
</div> 

<script type="text/javascript" src="assets/bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/owl.carousel.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/myslider.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/reads_main.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/comment.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/moment.js"></script>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();  
});
</script>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

var disqus_config = function () {
this.page.url = akprokoblog  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = '<?php echo $_SERVER['SCRIPT_NAME'].'?id='.$_GET['id'] ?>'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};

(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://akprokoblog.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<script id="dsq-count-scr" src="//akprokoblog.disqus.com/count.js" async></script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</body>
</html>
?>