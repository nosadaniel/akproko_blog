<?php
session_start();
// to check if sesssion is not set.
if(!isset($_SESSION['user_id'])){
	header('location:index.php');
}
//directory to connect to database
require_once $_SERVER['DOCUMENT_ROOT'].'/akproko/defines.php';
if (isset($_POST['feedback'])) {
	$output='';
	$sel = "SELECT * FROM suggestions";
	$run = mysqli_query($connect,$sel);
	if (mysqli_num_rows($run)>1) {
		$output .= "<div class='table-responsive'><table class='table table-hover'>
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th width='10%'>Feedback</th>
								<th>Date Sent</th>
								<th col='2'>Action</th>
							</tr>
						</thead>"; 
	}
	while ($row = mysqli_fetch_assoc($run)) {
		$sug_id = $row['sug_id'];
		$sug_name = $row['sug_name'];
		$sug_email = $row['sug_email'];
		$sug_body = $row['sug_body'];
		$sug_date = $row['sug_date'];
		$output .="<tbody>
					<tr>
						<td>".ucfirst($sug_name)."</td>
						<td>".$sug_email."</td>
						<td>".substr($sug_body,0, 20)."</td>
						<td>".date('D M y, h:s a',strtotime($sug_date))."</td>
						<td><a hre='#' class='btn btn-info btn-sm' data-toggle='modal' data-target='#".$sug_id."view'>View message</a>
						</td>
						<td><a hre='#' class='btn btn-default btn-sm' data-toggle='modal' data-target='#".$sug_id."reply' reply_id='".$sug_id."'>Reply message</a>
						</td>
					</tr>";
		echo "<!--modal to view messages-->
		<div id='".$sug_id."view' class='modal fade' role='dialog'>
		   <div class='modal-dialog modal-lg'>
		      <!-- Modal content-->
		      <div class='modal-content'>
		        <div class='modal-header' style='padding: 5px 10px 5px 10px;'>
		          <button type='button' class='close' data-dismiss='modal'>&times;</button>
		          <h4 class='modal-title text-primary'><span class='fa fa-comment fa-3x'></span><small>Feedbacks from akprokoblog fan </small></h4>
		        </div>
		        <div class='modal-body'>
		        	<p><b>From: </b>".ucfirst($sug_name)."</p>
		        	<div class='bg-info' style='padding:10px 10px 10px 10px;'>
		        		<p style='font-size:16px' class='text-justify'>".$sug_body."</p>
		        	</div>
		        </div>
		        <div class='modal-footer'>
		          <button type='button' class='btn btn-warning' data-dismiss='modal'>Cancel</button>
		        </div>
		      </div>
		    </div>
		</div>";

		echo "<!--modal to reply messages-->
		<div id='".$sug_id."reply' class='modal fade' role='dialog'>
		   <div class='modal-dialog modal-lg'>
		      <!-- Modal content-->
		      <div class='modal-content'>
		        <div class='modal-header' style='padding: 5px 10px 5px 10px;'>
		          <button type='button' class='close' data-dismiss='modal'>&times;</button>
		          <h4 class='modal-title text-primary'><span class='fa fa-comments-o fa-3x'></span><small>Feedbacks from <b>".ucfirst($sug_name)."</b></small></h4>
		        </div>
		        <div class='modal-body'>
		        	<form>
		        	<div class='input-group'>
              			<span class='input-group-addon'><b>TO</b></span>
              			<input type='email' name='user_email' class='form-control' id='user_email' disabled value='".$sug_email."'>
            		</div>
            		<br>
            		<textarea class='form-control' id='response_content' required placeholder='Please enter your message'></textarea>
		        </div>
		        <div class='modal-footer'>
		          <button type='button' class='btn btn-warning' data-dismiss='modal'>Cancel</button>
		          <input type='submit' value='Reply' class='btn btn-success' id='reply'>
				</form>
		        </div>
		      </div>
		    </div>
		</div>";
	}
	$output.="</tbody><table></div>";
	echo $output;
		
}



?>