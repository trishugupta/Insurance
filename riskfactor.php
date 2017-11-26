<?php
 include('adminheader.php');
  ?>
  <div class="container-fluid" style="padding-left:5%;padding-right:5%">
  <h3 class="page-header">Risk factors</h3>
<div>
	   <?php
	 include('db.php');
	 $selected_type = "0";
	 if(isset( $_GET['filter' ]))
	 {
		$selected_type = $_GET['itype'];
	}
 ?>
  <div class="row">
  <div class="card col s6" style="padding:30px">
  <form action="" method="GET">
	<div class="row">
	<div class="col s6">
		<label for="itype">Insurance Type</label>
			<select id="itype" name="itype" class="browser-default">
			<option value="0" <?php if($selected_type == "0"){ print "selected='selected'"; }?>>Select Insurance</option>
			<option value="healthinsurance" <?php if($selected_type == "healthinsurance"){ print "selected='selected'"; }?>>Health Insurance</option>
			<option value="homeinsurance" <?php if($selected_type == "homeinsurance"){ print "selected='selected'"; }?>>Home Insurance</option>
			<option value="carinsurance" <?php if($selected_type == "carinsurance"){ print "selected='selected'"; } ?>>Car Insurance</option>
		</select>
		</div>
		<div class="input-field submit-wrap right">
			<button class="btn btn-info submit" name="filter" type="submit">Get all records</button>
		</div>
      </div>
	</form>
	</div>
	</div>
<div class="card" style="padding:30px">
<?php
 if(isset($selected_type)&& $selected_type == "healthinsurance"){
	 $sql = "select * from `healthrisk`";
	$result = mysql_query($sql);
 ?>
	<table class='table table-striped' style='width:100%'>
<tr>
<th>Plan for</th>
<th>10yr Term Rate</th>
<th>20yr Term Rate</th>
<th>40yr Term Rate</th>
<th>Life Time</th>
<th></th>		
</tr>
<?php
while($row=mysql_fetch_array($result))
{
?>
			<tr>
				<td>
					<?PHP echo $row['planFor'];?>
				</td>
				<td>
					<?PHP echo $row['plan10'];?>
				</td>
				<td>
					<?PHP echo $row['plan20'];?>
				</td>
				<td>
					<?PHP echo $row['plan40'];?>
				</td>
				<td>
					<?PHP echo $row['lifetime'];?>
				</td>
				<td>
					<a href="editriskfactor.php?instype=<?php echo $selected_type; ?>&editid=<?php echo $row['riskid']; ?>"><input type="button" Value="Edit" class="btn btn-info btn-sm"></a>
				</td>
			</tr>

			<?php
			}
			?>
			</table>
 <?php 
 }
 else  if(isset($selected_type)&& $selected_type == "homeinsurance"){
	$sql = "select * from `homerisk`";
	$result = mysql_query($sql);
 ?>
	<table class='table table-striped' style='width:100%'>
<tr>
<th>Pincode</th>
<th>Building Rate</th>
<th>Content Rate</th>
<th>Building risk factor</th>
<th>Content risk factor</th>
<th></th>		
</tr>
<?php
while($row=mysql_fetch_array($result))
{
?>
			<tr>
				<td>
					<?PHP echo $row['Pincode'];?>
				</td>
				<td>
					<?PHP echo $row['buildingrate'];?>
				</td>
				<td>
					<?PHP echo $row['contentrate'];?>
				</td>
				<td>
					<?PHP echo $row['buildingRiskFactor'];?>
				</td>
				<td>
					<?PHP echo $row['contentRiskFactor'];?>
				</td>
				<td>
					<a href="editriskfactor.php?instype=<?php echo $selected_type; ?>&editid=<?php echo $row['LriskId']; ?>"><input type="button" Value="Edit" class="btn btn-info btn-sm"></a>
				</td>
			</tr>

			<?php
			}
			?>
			</table>
 <?php 
 }
 else if(isset($selected_type)&& $selected_type == "carinsurance"){
	$sql = "select * from `carrisk`";
	$result = mysql_query($sql);
 ?>
	<table class='table table-striped' style='width:100%'>
<tr>
<th>Car Id</th>
<th>Manufacturer</th>
<th>Model</th>
<th>Risk factor</th>
<th>Accident Risk factor</th>	
<th></th>		
</tr>
<?php
while($row=mysql_fetch_array($result))
{
?>
			<tr>
				<td>
					<?PHP echo $row['carid'];?>
				</td>
				<td>
					<?PHP echo $row['manufacturer'];?>
				</td>
				<td>
					<?PHP echo $row['modelno'];?>
				</td>
				<td>
					<?PHP echo $row['riskfactor'];?>
				</td>
				<td>
					<?PHP echo $row['accidentrisk'];?>
				</td>
				<td>
					<a href="editriskfactor.php?instype=<?php echo $selected_type; ?>&editid=<?php echo $row['carid']; ?>"><input type="button" Value="Edit" class="btn btn-info btn-sm"></a>
				</td>
			</tr>
			<?php
			}
			?>
			</table>
 <?php 
 }
 ?>
</div>
</div>
</div>

<?php include('footer.php'); ?>
