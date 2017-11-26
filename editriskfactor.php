<?php
 include('adminheader.php');
  ?>
  <div class="container-fluid" style="padding-left:5%;padding-right:5%">
  <h4 class="page-header">Update Risk factor / Premium rate</h4>
<div>
	   <?php
	 include('db.php');
		if(isset($_POST['Updatehealthrisk'])){
			$sql = "update healthrisk set plan10 = ".$_POST['plan10'].", plan20 = ".$_POST['plan20'].", plan40 = ".$_POST['plan40'].", lifetime = ".$_POST['lifetime']."  where planFor = '".$_POST['planFor']."'";
			if(mysql_query($sql)){
				echo "<span style='color:green'>Risk factors have been successfully updated !!</span>";
			}
			else{
				echo "<span style='color:red'>Something wrong happened. Please try again !!</span>";
			}
		}
		else if(isset($_POST['Updatehomerisk'])){
			$sql = "UPDATE `homerisk` SET `buildingrate`=".$_POST['buildingrate'].",`contentrate`=".$_POST['contentrate'].",`buildingRiskFactor`=".$_POST['buildingRiskFactor'].",`contentRiskFactor`=".$_POST['contentRiskFactor']." 
			WHERE Pincode = ".$_POST['Pincode'];
			if(mysql_query($sql)){
				echo "<span style='color:green'>Risk factors have been successfully updated !!</span>";
			}
			else{
				echo "<span style='color:red'>Something wrong happened. Please try again !!</span>";
			}
		}
		else if(isset($_POST['Updatecarrisk'])){
			$sql = "update carrisk set riskfactor = ".$_POST['riskfactor'].", accidentrisk = ".$_POST['accidentrisk']." where carid = ".$_POST['carid'];
			if(mysql_query($sql)){
				echo "<span style='color:green'>Risk factors have been successfully updated !!</span>";
			}
			else{
				echo "<span style='color:red'>Something wrong happened. Please try again !!</span>";
			}
		}
	 if(isset($_GET['instype']) && isset( $_GET['editid' ]))
	 {
		$editid = $_GET['editid'];
		$instype = $_GET['instype'];
		
		if($instype == "healthinsurance"){
			$sql = "select * from healthrisk where riskid = ".$editid;
			$result = mysql_query($sql);
			if($row = mysql_fetch_assoc($result)){
			?>	
			  <div class="row">
				<div class="card col s8" style="padding:30px">
				<legend>Health Insurance Risk</legend>
				<form action="" method="POST">
					<fieldset>
					
					<div class="row">
						<div class="input-field">
							<input id="planFor" type="text" name="planFor" readonly value="<?PHP echo $row['planFor'];?>" class="validate  col s11">
							<label for="planFor">Plan For </label>
						</div>
					</div>
					<div class="row">
						<div class="input-field">
							<input id="plan10" type="text" name="plan10" value="<?PHP echo $row['plan10'];?>" class="validate  col s11">
							<label for="plan10">10yrs Plan (factor)</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field">
							<input id="plan20" type="text" name="plan20" value="<?PHP echo $row['plan20'];?>" class="validate  col s11">
							<label for="plan20">20yrs Plan (factor)</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field">
							<input id="plan40" type="text" name="plan40" value="<?PHP echo $row['plan40'];?>" class="validate  col s11">
							<label for="plan40">40yrs Plan (factor)</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field">
							<input id="lifetime" type="text" name="lifetime" value="<?PHP echo $row['lifetime'];?>" class="validate  col s11">
							<label for="lifetime">Life Time (factor)</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field submit-wrap right">
							<button class="btn btn-info submit" name="Updatehealthrisk" type="submit">Update Health Risk</button>
						</div>
					</div>
				</fieldset>
					</form>
					</div>
					</div>
<?php
			}		
		}
	else if($instype == "homeinsurance"){
			$sql = "select * from homerisk where LriskId = ".$editid;
			$result = mysql_query($sql);
			if($row = mysql_fetch_assoc($result)){
			?>
				
			  <div class="row">
				<div class="card col s8" style="padding:30px">
				<legend>Home Insurance Risk</legend>
				<form action="" method="POST">
					<fieldset>
					
					<div class="row">
						<div class="input-field">
							<input id="Pincode" type="text" name="Pincode" readonly value="<?PHP echo $row['Pincode'];?>" class="validate  col s11">
							<label for="Pincode">Pincode </label>
						</div>
					</div>
					<div class="row">
						<div class="input-field">
							<input id="buildingrate" type="text" name="buildingrate" value="<?PHP echo $row['buildingrate'];?>" class="validate  col s11">
							<label for="buildingrate">Construction (rate) </label>
						</div>
					</div>
					<div class="row">
						<div class="input-field">
							<input id="contentrate" type="text" name="contentrate" value="<?PHP echo $row['contentrate'];?>" class="validate  col s11">
							<label for="contentrate">Content (rate)</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field">
							<input id="buildingRiskFactor" type="text" name="buildingRiskFactor" value="<?PHP echo $row['buildingRiskFactor'];?>" class="validate  col s11">
							<label for="buildingRiskFactor">Building Risk Factor</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field">
							<input id="contentRiskFactor" type="text" name="contentRiskFactor" value="<?PHP echo $row['contentRiskFactor'];?>" class="validate  col s11">
							<label for="contentRiskFactor">Content Risk Factor</label>
						</div>
					</div>
					<div class="row">
										<div class="input-field submit-wrap right">
											<button class="btn btn-info submit" name="Updatehomerisk" type="submit">Update Home Risk</button>
										</div>
					</div>
				</fieldset>
					</form>
					</div>
					</div>
<?php
			}		
		}
		else if($instype == "carinsurance"){
			$sql = "select * from carrisk where carid = ".$editid;
			$result = mysql_query($sql);
			if($row = mysql_fetch_assoc($result)){
			?>	
			 <div class="row">
				<div class="card col s8" style="padding:30px">
				<legend>Car Insurance Risk</legend>
				<form action="" method="POST">
					<fieldset>
					
					<div class="row">
						<div class="input-field">
							<input id="carid" type="text" name="carid" readonly value="<?PHP echo $row['carid'];?>" class="validate  col s11">
							<label for="carid">Car Id </label>
						</div>
					</div>
					<div class="row">
						<div class="input-field">
							<input id="manufacturer" type="text" name="manufacturer" readonly value="<?PHP echo $row['manufacturer'];?>" class="validate  col s11">
							<label for="manufacturer">Manufacturer </label>
						</div>
					</div>
					<div class="row">
						<div class="input-field">
							<input id="modelno" type="text" name="modelno" readonly value="<?PHP echo $row['modelno'];?>" class="validate  col s11">
							<label for="modelno">Model</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field">
							<input id="riskfactor" type="text" name="riskfactor" value="<?PHP echo $row['riskfactor'];?>" class="validate  col s11">
							<label for="riskfactor">Risk Factor</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field">
							<input id="accidentrisk" type="text" name="accidentrisk" value="<?PHP echo $row['accidentrisk'];?>" class="validate  col s11">
							<label for="accidentrisk">Accident Risk Factor</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field submit-wrap right">
							<button class="btn btn-info submit" name="Updatecarrisk" type="submit">Update Car Risk</button>
						</div>
					</div>
				</fieldset>
					</form>
					</div>
					</div>
		<?php
			}		
		}
	 }
?>

</div>
</div>

<?php include('footer.php'); ?>
