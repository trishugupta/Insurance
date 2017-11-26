<?php
 include('header.php');
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
  if(isset($_GET['policyid']))
  {
	  $sql = "select * from  policy where policyid = ".$_GET['policyid'];
			$result = mysql_query($sql );
  ?>

	<h3 class="page-header">Policy Details</h3>
	
	<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#info">Info</a></li>
</ul>
	 <div class="tab-content">
<div id="info" class="tab-pane fade in active">
			<table class="table table-striped" style="width:100%">
			<tr>
			<th>Policy Number</th>
			<th>Policy Type</th>
			<th>Premium</th>
			<th>Quote Ref.</th>
			<th>Expiry</th>
			<th></th>
			<th></th>
			</tr>
			<?php while ( $row = mysql_fetch_assoc( $result ) ) {
				?>
			<tr>
				<td>
					<?PHP echo $row['PolicyNo'];?>
				</td>
				<td>
					<?PHP
					$sqlhealthP = "select * from healthpolicydetails where policyno =".$row['PolicyNo'];
					$health = mysql_query($sqlhealthP);
					$sqlhomeP = "select * from homepolicydetails where policyno =".$row['PolicyNo'];
					$home = mysql_query($sqlhomeP);
					$sqlcarP = "select * from carpolicydetails where policyno =".$row['PolicyNo'];
					$car = mysql_query($sqlcarP);
					
					if($rw = mysql_fetch_assoc($health))
						echo "Health Insurance";
					else if($rw = mysql_fetch_assoc($home))
						echo "Home Insurance";
					else if($rw = mysql_fetch_assoc($car))
						echo "Car Insurance";
					
					?>
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
				<td><a href="transaction.php?action=claim&policyid=<?php echo $row['PolicyId']; ?>"><input type="button" Value="Make a claim" class="btn btn-info btn-sm"></a>
				</td>
				<td>
				<?php
					if($date = date('Y-m-d') >= $row['EffectTo']){
						echo "<a href='transaction.php?action=renew&policyid=".$row['PolicyId']."'><input type='button' Value='Renew' class='btn btn-info btn-sm'></a>";
					}
				?>
				</td>
			</tr>
			<?php 
			}?>
			</table>
</div>

  <?php
  }?>
</div>

<?php include('footer.php'); ?>
