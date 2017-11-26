<?php include('header.php');
if(isset($_SESSION['Name'])) {
	$userid = $_SESSION["userid"];
}
else{
	header( 'Location:login.php' );
}
 ?>
  <div class="container">
  <?php 
  include( "db.php" );
			$sql = "select * from  policy where userid = ".$userid;
			$result = mysql_query($sql );
  ?>
  <h3 class="page-header">My Account</h3>
	<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#profile">My Profile</a></li>
  <li><a data-toggle="tab" href="#policies">Policies</a></li>
  <li><a data-toggle="tab" href="#claim">Claim History</a></li>
  <li><a data-toggle="tab" href="#renewal">Renewals</a></li>
</ul>
<div class="tab-content">

<div id="policies" class="tab-pane fade">
			<table class="table table-striped" style="width:100%">
			<tr>
			<th>Policy Number</th>
			<th>Premium</th>
			<th>Quote Ref</th>
			<th>Effective from</th>
			<th>Effective to</th>
			<th></th>
			</tr>
			<?php while ( $row = mysql_fetch_assoc( $result ) ) {
				?>

			<tr>
				<td>
					<?PHP echo $row['PolicyNo'];?>
				</td>
				<td>
					<?PHP echo $row['Premium'];?>
				</td>
				<td>
					<?PHP echo $row['QuoteRef'];?>
				</td>
				<td>
					<?PHP echo $row['EffectFrom'];?>
				</td>
				<td>
					<?PHP echo $row['EffectTo'];?>
				</td>
				<td><a href="policy.php?policyid=<?php echo $row['PolicyId']; ?>"><input type="button" Value="Actions" class="btn btn-info btn-sm"></a>
				</td>
			</tr>
			<?php }?>
			</table>
</div>
<div id="profile" class="tab-pane fade in active">
<div class="card" style="padding:20px">
<div class="row">
<?php 
$sql = "select * from users where userid = ".$userid;
$result = mysql_query($sql);
while ( $row = mysql_fetch_assoc( $result ) ) {
				?>
<div class="col s3">
<img src="<?PHP echo $row['photopath'];?>" height="200px" width="200px" alt="profile Pic" />
</div>
<div class="col s9">
<table class="table table-striped">

			<tr>
			<th>First Name</th>
			<td>
					<?PHP echo $row['fname'];?>
				</td></tr><tr>
			<th>Last Name</th>
			<td>
					<?PHP echo $row['lname'];?>
				</td></tr><tr>
			<th>Date of Birth</th>
			<td>
					<?PHP echo $row['dob'];?>
				</td></tr><tr>
			<th>Email ID</th>
			<td>
					<?PHP echo $row['emailid'];?>
				</td>
			</tr>
			<?php }?>
			</table>
			<form action="" method="POST">
			<div class="row">
			<div class="row col s6">
			<div class="input-field col s12">
			<input id="first_name" name="oldpwd" type="text" required class="validate"/>
			<label for="first_name">Old Password</label>
			</div>
			<div class="input-field col s12">
				<input id="last_name" name="newpwd" type="text" required class="validate"/>
				<label for="last_name">New Password</label>
			</div>
			</div>
			<div class="row col s6">
			<br/><br/><br/><br/><br/>
			<button type="submit" name="chnpass" class="btn btn-default">Update password</button>
			</div>
			</div>
			</form>
			<?php
				if(isset($_POST['chnpass'])){
				$oldPwd = $_POST['oldpwd'];
				$sql = "select * from users where userid =".$_SESSION['userid']." and password = '".$oldPwd."'";
				$result = mysql_query($sql);
				if($row = mysql_fetch_assoc($result)){
				$newPwd = $_POST['newpwd'];
				$sql = "UPDATE `users` SET `password`='".$newPwd."' where userid= ".$_SESSION['userid'];
				if(mysql_query($sql))
					echo "<h5><span style='color:green'>Password changed.</span></h5><br/><br/>";
				else
					echo "<h5><span style='color:red'>Sorry, Couldn't change the password.</span></h5><br/><br/>";
				}
				
			}
			?>
</div>
</div>
</div>
</div>

<div id="claim" class="tab-pane fade">
<table class="table table-striped" style="width:100%">
			<tr>
			<th>Claim ID</th>
			<th>Policy Number</th>
			<th>Claim Amount</th>
			<th>Status</th>
			</tr>
			<?php
$sql = "select * from claims where claimedby = ".$userid;
$result = mysql_query($sql);
			while ( $row = mysql_fetch_assoc( $result ) ) {
				?>

			<tr>
				<td>
					<?PHP echo $row['claimId'];?>
				</td>
				<td>
					<?PHP echo $row['policyno'];?>
				</td>
				<td>
					<?PHP echo $row['claimamount'];?>
				</td>
				<td>
					<?PHP 
					if($row['Approved']==0 && $row['Rejected']==0)
						echo "Pending";
					else if($row['Approved']==1)
							echo "Approved";
					else if($row['Rejected']==1)
						echo "Rejected";?>
				</td>
			</tr>
			<?php }?>
			</table>
</div>
<div id="renewal" class="tab-pane fade">
<table class="table table-striped" style="width:100%">
			<tr>
			<th>Renewal ID</th>
			<th>Policy Number</th>
			<th>Revised Premium</th>
			<th>Revised Expiry</th>
			</tr>
			<?php
$sql = "select * from renewals where renewedby = ".$userid;
$result = mysql_query($sql);
			while ( $row = mysql_fetch_assoc( $result ) ) {
				?>

			<tr>
				<td>
					<?PHP echo $row['renewalid'];?>
				</td>
				<td>
					<?PHP echo $row['policyno'];?>
				</td>
				<td>
					<?PHP echo $row['revisedpremium'];?>
				</td>
				<td>
					<?PHP echo $row['revisedexpiry'];?>
				</td>
			</tr>
			<?php }?>
			</table>
</div>
</div>
</div>
</div>
<?php include('footer.php') ?>
