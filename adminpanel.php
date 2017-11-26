<?php
 include('adminheader.php');
  ?>
  <div class="container-fluid" style="padding-left:5%;padding-right:5%">
  <h3 class="page-header">Hi Admin</h3>

  <div class="col-sm-8">
  <div class="card" style="padding:30px">
    <h5>Your last login was made on <span style='color:green'>
	<?php 
	include('db.php');
	$sql = "select lastlogin from `users` where userid = ".$_SESSION["userid"];
	$result = mysql_query($sql);
	if($row = mysql_fetch_assoc($result)){
		$date =  Date($row['lastlogin']);
		echo $date;
	}
	?>  UTC </span></h5>
	<hr/>
	<div class="row" style="margin-top:60px;font-size:20px ">
		<div class="row">
		<div class="col s3">No. of policies</div>
		<div class="col s3"><?php $sql="select distinct * from policy"; $result = mysql_query($sql); echo mysql_num_rows($result); ?></div>
		</div>
		<div class="row">
		<div class="col s3">No. of Queries</div>
		<div class="col s3"><?php $sql="select distinct * from queries where isfeedback = 0"; $result = mysql_query($sql); echo mysql_num_rows($result); ?></div>
		</div>
		<div class="row">
		<div class="col s3">No. of Feedbacks</div>
		<div class="col s3"><?php $sql="select distinct * from queries where isfeedback = 1"; $result = mysql_query($sql); echo mysql_num_rows($result); ?></div>
		</div>
	</div>
</div>
</div>
</div>

<?php include('footer.php'); ?>
