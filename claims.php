<?php include('adminheader.php');
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
			$sql = "select * from  claims ";
			$result = mysql_query($sql );
  ?>
  <h3 class="page-header">Claims</h3>

<div id="claims" class="">
			<table class="table table-striped" style="width:100%">
			<tr>
			<th>Claim ID</th>
			<th>Claim amount</th>
			<th>Policy No</th>
			<th>Claimed by user</th>
			<th>Status</th>
			<th>Approve</th>
			<th>Reject</th>
			</tr>
			<?php while ( $row = mysql_fetch_assoc( $result ) ) {
				?>

			<tr>
				<td>
					<?PHP echo $row['claimId'];?>
				</td>
				<td>
					<?PHP echo $row['claimamount'];?>
				</td>
				<td>
					<?PHP echo $row['policyno'];?>
				</td>
				<td>
					<?PHP echo $row['claimedby'];?>
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
				<td>
					<a href="claims.php?claimid=<?php echo $row['claimId']; ?>&action=approve"><input type="button" Value="Approve" class="btn btn-info btn-sm"></a>
				</td>
				<td><a href="claims.php?claimid=<?php echo $row['claimId']; ?>&action=reject"><input type="button" Value="Reject" class="btn btn-info btn-sm"></a>
				</td>
			</tr>
			<?php }?>
			</table>
</div>
 <?php 
	if(isset($_GET['claimid'])&&isset($_GET['action'])){
		$claimid = $_GET['claimid'];
		$action = $_GET['action'];
		
		$sql = "select * from claims where claimId =".$claimid;
		$result = mysql_query($sql);
		if($row = mysql_fetch_assoc($result)){
		if($action == "approve"){
			$sql = "update claims set Approved = 1, Rejected=0 where claimId =".$claimid;
		}
		else if($action == "reject"){
			$sql = "update claims set Approved = 0, Rejected=1 where claimId =".$claimid;
		}
			mysql_query($sql);
			//header( 'Location:claims.php' );
		}
	}
?>
</div>
</div>
<?php include('footer.php')?>
