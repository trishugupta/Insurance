<?php
 include('adminheader.php');
  ?>
  <div class="container-fluid" style="padding-left:5%;padding-right:5%">
  <h4 class="page-header">Policies</h4>

  <?php 
  include( "db.php" );
			$sql = "select PolicyNo,Premium,QuoteRef,EffectFrom,EffectTo,emailid from  policy p join users u on p.userid = u.userid";
			$result = mysql_query($sql );
  ?>
  <div class="card" style="padding:30px">
<table class="table table-striped" style="width:100%">
			<tr>
			<th>Policy Number</th>
			<th>Premium</th>
			<th>Quote Ref.</th>
			<th>Effective from</th>
			<th>Effective to</th>
			<th>Allotted to User</th>
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
				<td>
					<?PHP echo $row['emailid'];?>
				</td>
			</tr>
			<?php }?>
			</table>
</div>
</div>

<?php include('footer.php'); ?>
