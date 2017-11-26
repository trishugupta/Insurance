<?php
 include('header.php');
 $userid = null;
 if (isset($_SESSION['Name'])) {
	$userid = $_SESSION["userid"];
}
function randomString($length = 6) {
	$str = "";
	$characters = array_merge(range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}
 ?>

<div class="container">
<script>
					$(document).ready(function () {
						var manufacturer = $('#imanufacturer').val();
						$.ajax({
							type: "GET",
							url: "utility.php",
							data: "manufacturer=" + manufacturer,
							success: function(result) {
								$("#imodel").html("<option value='0' selected>Choose Model</option>"+result);
							}
						});
$('#imanufacturer').change(function() {
						var manufacturer = $('#imanufacturer').val();
						$.ajax({
							type: "GET",
							url: "utility.php",
							data: "manufacturer=" + manufacturer,
							success: function(result) {
								$("#imodel").html("<option value='0' selected>Choose Model</option>"+result);
							}
						});
					});
});
</script>
	<h3 class="page-header">Buy Policy</h3>
	<?php 
  include( "db.php" );
if ( isset( $_POST[ 'itype' ])) {
	$_SESSION['itype'] = $_POST['itype'];
	$_SESSION['QuoteRef'] = "QRef2017".mt_rand(1111111,9999999);
  ?>
	<div class="panel panel-default">

		<?php
			if($_POST['itype'] == 'healthinsurance' ){
					$_SESSION['hiperson'] = $_POST['hiperson'];
					$_SESSION['hkidno']= $_POST['hkidno'];
					if($_POST['hiperson'] == 'Self')
						$planfor = 1;
					else if($_POST['hiperson'] == 'Family')
						$planfor = (2+$_POST['hkidno']);
			$iterm = $_POST['siterm'];
			$_SESSION['iterm'] = $iterm;
			?>
		<div class="panel-heading">
			<h5>Premium Details - Health Insurance</h5>
		</div>
		<div class="panel-body">
			<table class="table " style="width:100%">
				<tr>
					<th>Premium Amount</th>
					<th>Sum Assured</th>
					<th>Policy Term</th>
					<th>Premium Frequency</th>
					<th/>
				</tr>
				<tr>
					<td>
						<?php 
						// PREMIUM CALC - HEALTH INSURANCE
					$dob = new DateTime($_POST['hselfage']);
					$to   = new DateTime('today');
					$Age = $dob->diff($to)->y;
					$premium = round((($_POST['hiamount']-$_POST['hiamount']*$iterm/(90 - $Age))/(90 - $Age)),2);
					$_SESSION['premiumamount'] = $premium;
					echo "<i class='fa fa-inr' style='vertical-align:middle;' aria-hidden='true'/> ".$premium;
					?>
					</td>
					<td>
						<?php $_SESSION['InsuredAmount'] = $_POST['hiamount']; echo "<i class='fa fa-inr' style='vertical-align:middle;' aria-hidden='true'/> ".$_POST['hiamount']; ?></td>
					<td>
						<?php 
			if($iterm == 85)
				echo "Life Time";
			else
				echo $iterm." yrs";
			?>
					</td>
					<td>
						<?php 
			$iinterval = $_POST['hinterval'];
			if($iinterval == 1)
				echo "Yearly";
			else if($iinterval == 2)
				echo "Half-Yearly";
			else if($iinterval == 12)
				echo "Monthly";
			?>
					</td>
					<td>
						<a data-toggle="tab" href="#adult">
							<input type="button" Value="Confirm Quote" class="btn btn-info btn-sm">
							</a>
						</td>
					</tr>
				</table>
			</div>
			<?php
				$sql = "INSERT INTO `healthquote`(`UserId`, `QuoteRef`, `ValidFrom`, `ValidTo`, `Premium`, `planfor`, `dob`, `coverage`, `term`, `frequency`)
				VALUES('".$userid."','".$_SESSION['QuoteRef']."','".date('Y-m-d',strtotime('today'))."','".date('Y-m-d',strtotime('today')+(31622400*$iterm))."','".$premium."','".$planfor."','".$_POST['hselfage']."','".$_POST['hiamount']."','".$iterm."','".$iinterval."')";
				mysql_query($sql);
			}
			else if($_POST['itype'] == 'homeinsurance' ){
				?>
			<div class="panel-heading">
				<h5>Premium Details - Home Insurance</h5>
			</div>
			<div class="panel-body">
				<table class="table " style="width:100%">
					<tr>
						<th>Premium Amount</th>
						<th>Building(Sum Insured)</th>
						<th>Contents(Sum Insured)</th>
						<th>Premium Frequency</th>
						<th/>
					</tr>
					<tr>
						<td>
							<i class='fa fa-inr' style='vertical-align:middle;' aria-hidden='true'/>
							<?php 
							$_SESSION['contentCoverage'] = $_POST['icontent'];
							$_SESSION['constructionCoverage'] = $_POST['iconstruction'];
							
							$sql = "select * from homerisk where Pincode = '".$_POST['ipincode']."'";
							$result = mysql_query($sql);
							if($row = mysql_fetch_assoc($result)){
								// PREMIUM CALC - HOME INSURANCE
								$_SESSION['houseage'] = $_POST['houseage'];
								$a = (($_POST['iconstruction']*$row['buildingrate'])/(30-(2017-$_POST['houseage'])))*$row['buildingRiskFactor'];
								$b = ($_POST['icontent']*$row['contentrate'])*$row['contentRiskFactor'];
								$_SESSION['premiumamount'] = round(($a + $b)/($row['buildingRiskFactor']+$row['contentRiskFactor']),2);
								echo $_SESSION['premiumamount'];
							}
							else{
								echo round((($_POST['iconstruction']/30)*0.012 +  $_POST['icontent']*0.01)/2.5,2);
							}
			  ?>
						</td>
						<td>
							<?php echo "<i class='fa fa-inr' style='vertical-align:middle;' aria-hidden='true'/> ".$_POST['iconstruction']; ?></td>
						<td>
							<?php 
							$iterm = $_POST['hiterm'];
			$_SESSION['iterm'] = $iterm;
				echo $_POST['icontent'];
			?>
						</td>
						<td>
							<?php
				echo "Yearly";
			?>
						</td>
						<td>
							<a data-toggle="tab" href="#owner">
								<input type="button" Value="Confirm Quote" class="btn btn-info btn-sm">
								</a>
							</td>
						</tr>
					</table>
				</div>

				<?php
			}
			else if($_POST['itype'] == 'carinsurance' ){
			?>	
				<div class="panel-heading">
					<h5>Premium Details - Car Insurance</h5>
				</div>
				<div class="panel-body">
					<table class="table " style="width:100%">
					<tr>
						<th>Premium Amount</th>
						<th>Coverage Amount</th>
						<th>Accidental Coverage</th>
						<th>Premium Frequency</th>
						<th></th>
					</tr>
						<tr>
							<td>
							<i class='fa fa-inr' style='vertical-align:middle;' aria-hidden='true'/>
							<?php
							$_SESSION['coverage'] =$_POST['ciamount'];
							$_SESSION['citerm'] = $_POST['citerm'];
							$sql = "select * from carrisk where manufacturer = '".$_POST['imanufacturer']."' and modelno = '".$_POST['imodel']."'";
							$result = mysql_query($sql);
							if($row = mysql_fetch_assoc($result)){
								// PREMIUM CALC - CAR INSURANCE
								$purchasedate = new DateTime($_POST['cipurchase']);
								$to   = new DateTime('today');
								$old = $purchasedate->diff($to)->y;
								if(isset($_POST['AccidentCoverage'])){
									$_SESSION['premiumamount'] = round((($_POST['ciamount']*$old)/(80-$_POST['ciage']))*$row['accidentrisk'],2);
								}
								else{
									$_SESSION['premiumamount'] = round((($_POST['ciamount']*$old)/(80-$_POST['ciage']))*$row['riskfactor'],2);
								}
							echo $_SESSION['premiumamount'];
							}?>
							</td>
							<td>
								<?php echo "<i class='fa fa-inr' style='vertical-align:middle;' aria-hidden='true'/> ".$_POST['ciamount']; ?></td>
							<td>
								<?php
								if(isset($_POST['AccidentCoverage']))
									echo "Yes";
								else
									echo "No";
								?>
							</td>
							<td>
								Yearly
							</td>
							<td>
								<a data-toggle="tab" href="#car">
									<input type="button" Value="Confirm Quote" class="btn btn-info btn-sm">
									</a>
								</td>
							</tr>
						</table>
					</div>
					<?php 
			}
			?>
				</div>

				<?php
	 if($_SESSION['itype'] == 'healthinsurance'){?>
				<ul class="nav nav-tabs">
					<li>
						<a  class="active" data-toggle="tab" href="#adult">Adult Details</a>
					</li>
					<?php
					if($_POST['hiperson'] == 'Family'){
						$_SESSION['hkidno'] = $_POST['hkidno'];
						if($_POST['hiperson'] == 'Family' && isset($_POST['hkidno']) && $_POST['hkidno'] > 0){
					?>				
					<li>
						<a data-toggle='tab' href='#kids'>Kids Details</a>
					</li>

					<?php
						}		
					}?>
				</ul>
				<?php	 }
	 else if($_SESSION['itype'] == 'homeinsurance'){?>
				<ul class="nav nav-tabs">
					<li>
						<a class="active" data-toggle="tab" href="#home">Householder's Details</a>
					</li>
				</ul>
				<?php	 }
	 else if($_SESSION['itype'] == 'carinsurance'){?>
				<ul class="nav nav-tabs">
					<li>
						<a class="active" data-toggle="tab" href="#car">Car Details</a>
					</li>
					<li>
						<a data-toggle="tab" href="#driver">Driver Details</a>
					</li>
				</ul>
				<?php
	 }
	 ?>
	 <div>
<form action="transaction.php" name="insurancedetails" method="POST" enctype="multipart/form-data">
					<div class="tab-content">
						<div id="adult" class="tab-pane fade">
							<div class="row">
								<?php 
	 if(isset($_POST['hiperson'])){
		 if($_POST['hiperson'] == 'Self' || $_POST['hiperson'] == 'Family')
		 {
	 ?>
								<div class="card col s6	">
									<h5 class="page-header">Self Details</h5>
									<div class="row">
										<div class="input-field col s6">
											<input id="first_name" name="fname" type="text" class="validate"/>
											<label for="first_name">First Name</label>
										</div>
										<div class="input-field col s6">
											<input id="last_name" name="lname" type="text" class="validate"/>
											<label for="last_name">Last Name</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<p class="help-block">Date of Birth</p>
											<input value="<?php echo $_POST['hselfage'];?>" id="disabled" type="date" name="dob" readonly class="validate" />
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input id="email" name="email" type="email" class="validate"/>
											<label for="email">Email</label>
										</div>
									</div>
									<div class="row">
										<div class="col s12">
											<label for="idtype">Choose Idenity Proof </label>
											<select name="idtype" class="browser-default">
												<option value="Aadhaar" selected>Aadhaar</option>
												<option value="Passport">Passport</option>
												<option value="VoterId">Voter Id</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input id="idNo" name="idNo" type="text" class="validate"/>
											<label for="idNo">Identity No</label>
										</div>
									</div>
									<div class="row">
										<div class="file-field input-field">
											<div class="btn">
												<span>Upload Photo</span>
												<input type="file" accept=".jpg, .png, .jpeg" name="photo"/>
											</div>
											<div class="file-path-wrapper">
												<input class="file-path validate" type="text"/>
											</div>
										</div>
									</div>
								</div>
								<?php
		 }
	 if($_POST['hiperson'] == 'Family'){
	 ?>
								<div class=" card col s6">
									<h5 class="page-header">Spouse Details</h5>
									<div class="row">
										<div class="input-field col s6">
											<input id="first_name" name="sfname" type="text" class="validate"/>
											<label for="first_name">First Name</label>
										</div>
										<div class="input-field col s6">
											<input id="last_name" name="slname" type="text" class="validate"/>
											<label for="last_name">Last Name</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<p class="help-block">Date of Birth</p>
											<input value="<?php echo $_POST['hspouseage'];?>" id="disabled" type="date" name="sdob" readonly class="validate" />
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input id="email" name="semail" type="email" class="validate"/>
											<label for="email">Email</label>
										</div>
									</div>
									<div class="row">
										<div class="col s12">
											<label for="sidtype">Choose Idenity Proof </label>
											<select name="sidtype" class="browser-default">
												<option value="Aadhaar" selected>Aadhaar</option>
												<option value="Passport">Passport</option>
												<option value="VoterId">Voter Id</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input id="idNo" name="sidNo" type="text" class="validate"/>
											<label for="idNo">Identity No</label>
										</div>
									</div>
									<div class="row">
										<div class="file-field input-field">
											<div class="btn">
												<span>Upload Photo</span>
												<input type="file" name="sphoto">
												</div>
												<div class="file-path-wrapper">
													<input class="file-path validate" type="text"/>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="kids" class="tab-pane fade">
								<div class="row">
									<?php 
	 if(isset($_POST['hkidno']) && $_POST['hkidno'] > 0){
	 ?>
									<div class="row card col s6">
										<h5 class="page-header">Child 1 details</h5>
										<div class="row">
											<div class="input-field col s6">
												<input id="k1first_name" name="k1fname" type="text" class="validate"/>
												<label for="k1first_name">First Name</label>
											</div>
											<div class="input-field col s6">
												<input id="k1last_name" name="k1lname" type="text" class="validate"/>
												<label for="k1last_name">Last Name</label>
											</div>
										</div>
										<div class="row">
											<div class="input-field col s12">
												<p class="help-block">Date of Birth</p>
												<input  id="k1dob" type="date" name="k1dob" class="validate" />
											</div>
										</div>
										<div class="row">
											<div class="col s12">
												<label for="k1idtype">Choose Idenity Proof </label>
												<select name="k1idtype" class="browser-default">
													<option value="Aadhaar" selected>Aadhaar</option>
													<option value="Passport">Passport</option>
													<option value="VoterId">Voter Id</option>
												</select>
											</div>
										</div>
										<div class="row">
											<div class="input-field col s12">
												<input id="k1idNo" name="k1idNo" type="text" class="validate"/>
												<label for="k1idNo">Identity No</label>
											</div>
										</div>
										<div class="row">
											<div class="file-field input-field">
												<div class="btn">
													<span>Upload Photo</span>
													<input type="file"  name="k1photo">
													</div>
													<div class="file-path-wrapper">
														<input class="file-path validate" type="text"/>
													</div>
												</div>
											</div>
										</div>
										<?php
		 }
	 if(isset($_POST['hkidno']) && $_POST['hkidno'] > 1){
	 ?>
										<div class="row card col s6">
											<h5 class="page-header">Child 2 details</h5>
											<div class="row">
												<div class="input-field col s6">
													<input id="k2first_name" name="k2fname" type="text" class="validate"/>
													<label for="k2first_name">First Name</label>
												</div>
												<div class="input-field col s6">
													<input id="k2last_name" name="k2lname" type="text" class="validate"/>
													<label for="k2last_name">Last Name</label>
												</div>
											</div>
											<div class="row">
												<div class="input-field col s12">
													<p class="help-block">Date of Birth</p>
													<input  id="k2dob" type="date" name="k2dob" class="validate" />
												</div>
											</div>
											<div class="row">
												<div class="col s12">
													<label for="k2idtype">Choose Idenity Proof </label>
													<select name="k2idtype" class="browser-default">
														<option value="Aadhaar" selected>Aadhaar</option>
														<option value="Passport">Passport</option>
														<option value="VoterId">Voter Id</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="input-field col s12">
													<input id="k2idNo" name="k2idNo" type="text" class="validate"/>
													<label for="k2idNo">Identity No</label>
												</div>
											</div>
											<div class="row">
												<div class="file-field input-field">
													<div class="btn">
														<span>Upload Photo</span>
														<input type="file"  name="k2photo"/>
													</div>
													<div class="file-path-wrapper">
														<input class="file-path validate" type="text"/>
													</div>
												</div>
											</div>
										</div>
										<?php
			}
	 }
	 ?>
									</div>
								</div>

								<div id="owner" class="tab-pane fade">
									<div class="row">
										<div class="row card" style="padding:0px 30px 0px 30px">
											<h5 class="page-header">Householder's Details</h5>
											<div class="row">
												<div class="input-field col s6">
													<input id="first_name" name="hfname" type="text" class="validate"/>
													<label for="first_name">First Name</label>
												</div>
												<div class="input-field col s6">
													<input id="last_name" name="hlname" type="text" class="validate"/>
													<label for="last_name">Last Name</label>
												</div>
											</div>
											<div class="row">
											<div class="col s6">
											<label for="dob">Date of Birth</label>
												<div class="input-field">
													<input type="date" value="<?php echo $_POST['hselfage'];?>" id="disabled"  name="hdob" class="validate" />
												</div>
												</div>
												<label for="email">Email</label>
												<div class="input-field col s6">
													<input id="email" name="hemail" type="email"  class="validate"/>
												</div>
												
											</div>
											<div class="row">
												
												<div class="col s6">
													<label for="idtype">Choose Idenity Proof </label>
													<select name="hidtype" class="browser-default">
														<option value="Aadhaar" selected>Aadhaar</option>
														<option value="Passport">Passport</option>
														<option value="VoterId">Voter Id</option>
													</select>
												</div>
												<div class="input-field col s6">
													<input id="idNo" name="hidNo" type="text" class="validate"/>
													<label for="idNo">Identity No</label>
												</div>
											</div>
											<div class="row">
											<div class="col s4">
													<label for="emp">Employment Status</label>
													<select id="emp" name="emp" class="browser-default">
														<option value="Employed" selected>Employed</option>
														<option value="Self-Employed" selected>Self-Employed</option>
														<option value="Student" selected>Student</option>
														<option value="UnEmployed" selected>Un-Employed</option>
													</select>
												</div>
											<div class="col s4">
													<label for="state">State</label>
													<select name="state" id="state" class="browser-default"> 
														<option value="" selected="selected">Select a State</option> 
														<option value="AP">Andhra Pradesh</option>
														<option value="ARP">Arunachal Pradesh</option>
														<option value="BIH">Bihar</option>
														<option value="CT">Chattisgarh</option>
														<option value="DL">Delhi</option>
														<option value="MH">Maharashtra</option>
														<option value="MP">Madhya Pradesh</option>
														<option value="OD">Odisha</option>
														<option value="SK">Sikkim</option>
														<option value="UP">Uttar Pradesh</option>
														<option value="WB">West Bengal</option>
													</select>
												</div>
												<div class="input-field col s4">
													<input id="pincode" name="hpincode" type="text" value="<?php echo $_POST['ipincode'];?>" readonly class="validate"/>
													<label for="pincode">Pincode</label>
												</div>
											</div>
											 <div class="row">
												<div class="input-field">
												<textarea id="add" name="hadd" class="materialize-textarea"></textarea>
												<label for="add">Complete Address </label>
												</div>
											</div>
											<div class="row">
												<div class="file-field input-field">
													<div class="btn">
														<span>Upload Photo</span>
														<input type="file" accept=".jpg, .png, .jpeg" name="hphoto"/>
													</div>
													<div class="file-path-wrapper">
														<input class="file-path validate" type="text"/>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
								<div id="car" class="tab-pane fade">
								<div class="row">
										<div class="row card" style="padding:0px 30px 0px 30px">
											<h5 class="page-header">Car Details</h5>
											<div class="row">
									<div class="col s4">
									<label for="imanufacturer">Manufacturer</label>
										<select id="imanufacturer" name="imanufacturer" class="browser-default" readonly value="<?php echo $_POST['imanufacturer'];?>" >
										<option value="0" selected>Choose Manufacturer</option>
									<?php
									$carmanufacturersql = "select distinct manufacturer from carrisk";
									$result = mysql_query($carmanufacturersql);
									while($row = mysql_fetch_assoc($result)){
										echo "<option value='".$row['manufacturer']."'";if($_POST['imanufacturer'] == $row['manufacturer']){ print "selected='selected'"; };echo ">".$row['manufacturer']."</option>";
									}
										?>
									</select>
									</div>
									<div class="col s4">
									<label for="imodel">Model Name</label>
									<select id="imodel" class="browser-default" name="imodel" value="<?php echo $_POST['imodel'];?>" readonly>
										<option value="0">Choose Model</option>
									</select>
									</div>
									
									<div class="col s4">
									<label for="cipurchase">Purchase Date : </label>
										<input type="date" id="cipurchase" name="cipurchase"  min="2013-12-31" max="2017-11-07" readonly value="<?php echo $_POST['cipurchase'];?>" />
									</div>
								</div>
											<div class="row">
												<div class="input-field col s6">
													<input id="vno" name="vno" type="text" class="validate"/>
													<label for="vno">Vehicle No.</label>
												</div>
												<div class="input-field col s6">
													<input id="vregloc" name="vregloc" type="text" class="validate"/>
													<label for="vregloc">Vehicle Reg. Location</label>
												</div>
											</div>
											<div class="row">
													<div class="control col s6"style="padding-top:20px">
													<input type="checkbox" class="filled-in" id="AccidentCoverage" name="AccidentCoverage" />
													<label for="AccidentCoverage">Include Accidental Coverage</label>
												</div>
											
												<div class="input-field col s6">
													<input id="AccCoverageAmount" name="AccCoverageAmount" type="text" class="validate"/>
													<label for="AccCoverageAmount">Accidental Coverage Amount</label>
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<div id="driver" class="tab-pane fade">
								<div class="row">
										<div class="row card" style="padding:0px 30px 0px 30px">
											<h5 class="page-header">Driver Details</h5>
											<div class="row">
												<div class="input-field col s6">
													<input id="first_name" name="cfname" type="text" class="validate"/>
													<label for="first_name">First Name</label>
												</div>
												<div class="input-field col s6">
													<input id="last_name" name="clname" type="text" class="validate"/>
													<label for="last_name">Last Name</label>
												</div>
											</div>
											<div class="row">
												<div class="input-field col s12">
													<p class="help-block">Date of Birth</p>
													<input value="<?php echo $_POST['hselfage'];?>" id="disabled" type="date" name="cdob" class="validate" />
												</div>
											</div>
											<div class="row">
												<div class="input-field col s12">
													<input id="email" name="cemail" type="email" class="validate"/>
													<label for="email">Email</label>
												</div>
											</div>
											<div class="row">
												<div class="col s12">
													<label for="idtype">Choose Idenity Proof </label>
													<select name="cidtype" class="browser-default">
														<option value="dl" selected>Driving License</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="input-field col s12">
													<input id="idNo" name="cidNo" type="text" class="validate"/>
													<label for="idNo">Driving License No</label>
												</div>
											</div>
											<div class="row">
												<div class="file-field input-field">
													<div class="btn">
														<span>Upload Photo</span>
														<input type="file" accept=".jpg, .png, .jpeg" name="cphoto"/>
													</div>
													<div class="file-path-wrapper">
														<input class="file-path validate" type="text"/>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<button type="submit" name="buypolicy" class="btn btn-info ">Buy Policy</button>
						</form>	 
						</div>
						<?php 
}
}
else
{
	?>
						<form>
							<div class="row center">
								<div class = "row" style="margin-top:40px;margin-bottom:60px">
									<a href='getquote.php' >
										<input type='button' Value='Get a Quote first !!' class='btn btn-info btn-sm'/>
									</a>
								</div>

							</div>
							<div class="divider" style="margin-bottom:30px"/>
							<!--<div class="row center" style="margin-top:100px">
								<h5 class="col s6">Already have a Quote Ref ?</h5>
								<div class="input-field col s3">
									<input type="text" id="quoteref" name="quoteref"/>
									<label for="quoteref">Enter Quote Reference no.</label>
								</div>
								<div class="input-field col s3">
									<a href='getquote.php' >
										<input type='button' Value='Submit' class='btn btn-info btn-sm'/>
									</a>
								</div>
							</div>-->	
						</form>	
						<?php }?>
					</div>
					<? include('footer.php'); ?>