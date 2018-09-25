<?php foreach ($comments as $key=>$comment) {?>
<li class="comment-holder" id="<?php echo $comment['post_id'];?>">
  <div class="row" style="margin: 0px;">
    <div class="col-md-1 col-xs-2 col-sm-1" style="padding: 0px;">
      <div class="user-img">
        <img src="assets/img/avatar.png" width="45" height="45" style="margin:6px 5px 0px 6px; " class="img-responsive"/>
      </div>
    </div>
    <div class="col-md-11 col-sm-11 col-xs-10 comment-body">
      <div class="row"><div class="col-md-6 col-sm-6 col-xs-6"><h3 class="username-field"><?php echo $comment['user_name_comment']; ?></h3></div><div class="col-md-6 col-sm-6 col-xs-6"><small style="font-size: 11px; color:blue;">Posted: <span style="font-size: 11px; color:#7CAEF9;""><?php echo date('D, M Y h:i a',strtotime($comment['comment_time'])); ?></span> </small></div></div>
      <div class="comment-text text-justify">
        <p><?php echo $comment['comment_content'];?></p>
      </div>
    </div>
  </div>
</li>
<?php } ?>