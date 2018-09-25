
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Akproko | Home</title>
  <meta charset="UTF-8">
  <meta name="description" content="Akprokoblog">
  <meta name="keywords" content="Gossip, Politics, sports, news, footabll">
  <meta name="author" content="Ogagaoghen Meshach">
  <meta name="viewpoint" content="width=device-width, initial-scale=1"/>
   <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="assets/bootstrap/css/style.css"/>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css"/>
  <link rel="stylesheet" href="assets/bootstrap/css/social-share-kit.css" type="text/css">
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  //google ads
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-4827200337295596",
    enable_page_level_ads: true
  });
</script>
  
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
      <form class="navbar-form navbar-right" method="POST" >
         <span class="text-danger msg-err" style="font-weight: bold;"></span>
	      <div class="input-group">
	      	<input type="text" name="search" size="30" placeholder="search by post title..." class="form-control" id="search" autocomplete="off" required="">
	      	<div class="input-group-btn">
            <a href="#" data-toggle="modal" data-target="#searchResult" class="btn btn-info" id="submit">
              <span class="fa fa-search-plus fa-lg"></span>
            </a>
	      		<!-- <button class="btn btn-success" type="submit" id="submit"><span class="fa fa-search-plus fa-lg"></span></button> -->
	      	</div>
	      </div>
	    </form>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right" style="margin-top:18px;">
        <li><a href="#" data-toggle="modal" data-target="#ads">Advert Enquiry</a></li>
        <li><a href="#" data-toggle="modal" data-target="#fd">Feedback/suggest</a></li>
      </ul>
    </div>
  </div>
</nav>
<p><br><br></p>
<!-- for advert-->
<div class="container-fluid" style="margin-top:50px">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<a href="#">
         <img src="assets/img/1511279904.png" class="img-responsive">   
      </a>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-6">
			<a href="#">
        <img src="assets/img/1511279904.png" class="img-responsive">    
      </a>
		</div>
	</div>
</div>
<p><br><br></p>
<!-- social icons-->
<!-- Left & centered positioning -->
<div class="ssk-sticky ssk-left ssk-center ssk-lg">
    <a href="#" class="ssk ssk-facebook"></a>
    <a href="" class="ssk ssk-twitter" data-url="http://url-for-twitter" data-text="Text for twitter" ></a>
    <a href="#" class="ssk ssk-whatsapp hidden-lg hidden-md"></a>
    <a href="#" class="ssk ssk-email"></a>
</div>
<div class="container-fluid">
    <!-- for side bar-->
  <div class="col-md-2 col-sm-4 hidden-xs">
    <div class="display_sidebar"></div>
      <img src="assets/img/1511437060.gif" class="img-responsive">
      <hr>
       <img src="assets/img/1501463407.gif" class="img-responsive">
       <hr>
        <img src="assets/img/1510316376.gif" class="img-responsive">
	</div>
  <!-- news panel -->
	<div class="col-md-6 col-sm-8 col-xs-12">
        <div class="display_post"></div>

  </div>
  <!--Recent news-->
  <div class="col-md-4 col-sm-12 col-xs-12">
    <div class="panel">
      <div class="panel-heading main-color-bg">
        <strong class="panel-title" style="color:#333333;">JUST IN</strong>
      </div>
      <div class="panel-body jumbotron" style="padding-top: 5px; padding-left: 10px; padding-right: 10px;">
        <div id="display_recent_post"></div>
      </div>
    </div>
  </div>
</div>
<p><br></p>
<div class="container">
  <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-4 col-xs-offset-4">
    <!-- <ul class="row">
      <a href="#" class="btn btn-info">Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="#" class="btn btn-info">Next</a>
    </ul> -->
  </div>
</div>

<div id="footer">
  <h5 class="text-center" style="padding-top: 10px; margin-bottom: 0px;">Akproko &copy 2017 - <?php echo date('Y'); ?></h5>
  <p class="text-center"><span class="text-primary">Design and Developed By </span><small>Nosa Daniel</small></p>
</div>
<!--modal for ads-->
<div id="ads" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="fa fa-envelope fa-4x"></span> Please send us an email</h4>
        </div>
        <div class="modal-body">
          <h3 class="text text-danger">
            ads@akprokoblog.com
          </h3>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<!--modal for suggestion-->
<div id="fd" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding: 5px 10px 0px 10px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-primary"><span class="fa fa-envelope fa-3x"></span><small>  We are happy to hear from you</small></h4>
           <div id="msg"></div>
        </div>
        <div class="modal-body">
          <form method="POST" id="suggest_form">
           <div class="input-group">
              <span class="input-group-addon"><span class="fa fa-user"></span></span>
              <input type="text" name="user_name" class="form-control" id="user_name"  placeholder="Please enter your name" autofocus="on" autocomplete="off">
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
              <input type="email" name="user_name" class="form-control" id="user_email"  placeholder="Please enter your email address" autofocus="on" autocomplete="off">
            </div>
            <br>
            <textarea class="form-control" id="user_comment" placeholder="Make your suggestion here..."></textarea>
            <br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
          <input type="submit" name="submit" id="submit" value="submit" class="btn btn-info">
        </form>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript" src="assets/bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/main.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/sugg.js"></script>
<script id="dsq-count-scr" src="//akprokoblog.disqus.com/count.js" async></script>
  <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</body>
</html>