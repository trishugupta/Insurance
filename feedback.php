<?php
 include('adminheader.php');
  ?>
  <div class="container-fluid" style="padding-left:5%;padding-right:5%">
  <h4 class="page-header">Feedbacks &amp; Queries</h4>

  <?php 
  include( "db.php" );
  ?>
  
    <ul class="nav nav-tabs">
					<li class="active">
						<a data-toggle="tab" href="#feedback">Feedbacks</a>
					</li>
					<li>
						<a data-toggle="tab" href="#query">Queries</a>
					</li>
</ul>
<div class="tab-content">
		<div id="feedback" class="tab-pane fade in active">
		
  <div class="card" style="padding:30px">
<table class="table table-striped" style="width:100%">
			<tr>
			<th>Query ID</th>
			<th>Name</th>
			<th>Email</th>
			<th>Message</th>
			<th></th>
			</tr>
			<?php 
			$sql = "select * from  queries where isfeedback = 1";
			$result = mysql_query($sql );
			
			while ( $row = mysql_fetch_assoc( $result ) ) {
				?>

			<tr>
				<td>
					<?PHP echo $row['queryid'];?>
				</td>
				<td>
					<?PHP echo $row['name'];?>
				</td>
				<td>
					<?PHP echo $row['email'];?>
				</td>
				<td>
					<?PHP echo $row['message'];?>
				</td>
				<td><!--<a href="policy.php?policyid=<?php echo $row['PolicyId']; ?>"><input type="button" Value="Details" class="btn btn-info btn-sm"></a>-->
				</td>
			</tr>
			<?php }?>
			</table>
</div>
</div>
		<div id="query" class="tab-pane fade">
		
  <div class="card" style="padding:30px">
<table class="table table-striped" style="width:100%">
			<tr>
			<th>Query ID</th>
			<th>Name</th>
			<th>Email</th>
			<th>Message</th>
			<th></th>
			</tr>
			<?php 
			$sql = "select * from  queries where isfeedback = 0";
			$result = mysql_query($sql );
			
			while ( $row = mysql_fetch_assoc( $result ) ) {
				?>

			<tr>
				<td>
					<?PHP echo $row['queryid'];?>
				</td>
				<td>
					<?PHP echo $row['name'];?>
				</td>
				<td>
					<?PHP echo $row['email'];?>
				</td>
				<td>
					<?PHP echo $row['message'];?>
				</td>
				<td><!--<a href="policy.php?policyid=<?php echo $row['PolicyId']; ?>"><input type="button" Value="Details" class="btn btn-info btn-sm"></a>-->
				</td>
			</tr>
			<?php }?>
			</table>
</div>
</div>
</div>
</div>

<?php include('footer.php'); ?>
