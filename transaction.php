<?php
 include('header.php');
 $userid = null;
 if (isset($_SESSION['Name'])) {
	$userid = $_SESSION["userid"];
}
if(!isset($_POST['buypolicy'])&&!isset($_GET['action'])&&!isset($_GET['claimbtn'])){
	header('Location:getquote.php');
}
			if(isset($_GET['claimbtn'])){
				include('db.php');
				$claimamount = $_GET['claimamount'];
				$policyno = $_GET['policyno'];
				$sql = "INSERT INTO `claims`(`claimamount`, `policyno`, `claimedby`) 
				VALUES ('".$claimamount."','".$policyno."','".$_SESSION['userid']."')";
				if(mysql_query($sql)){
			?>
				<div class="container ">
				<h4 class="page-header">Claims</h4>
					<div class='row center' >
						<div class=' panel-default'>
						<h4 style='color:green;margin-top:100px'>Claim made Successfully !!</h4>
						<h6>You can check the status of your claims from claim history screen.</h6>
					</div>
				 </div>
				<?php
				}
				else{
					mysql_error();
				}
			}
 ?>
 	 <script>
	 $(document).ready(function () {
		// $('#renewterm').change(function() {
			// var x = parseInt($('#oldPrem').text()) + $('#oldPrem').text()*0.1;
			// $('#oldPrem').text(x);
			// $('#revisedPrem').text("Your premium Amount is revised.")
			// });
			$("#c1").click(function() {
				$("#c1").addClass("active");
				$("#c2").removeClass("active");
				$("#c3").removeClass("active");  
				$("#dbcard").css("display", "block");
				$("#cdcard").css("display", "none");
				$("#ntbank").css("display", "none");
			});
			$("#c2").click(function() {
				$("#c1").removeClass("active");
				$("#c2").addClass("active");
				$("#c3").removeClass("active");
				$("#dbcard").css("display", "none");
				$("#cdcard").css("display", "block");
				$("#ntbank").css("display", "none");				
			});
			$('#c3').click(function() {
				$("#c1").removeClass("active");
				$("#c2").removeClass("active");
				$("#c3").addClass("active");  
				$("#dbcard").css("display", "none");
				$("#cdcard").css("display", "none");
				$("#ntbank").css("display", "block");
			});
	 });	
	</script>
	<?php 
	include("db.php"); 
	if(isset($_POST['buypolicy'])){?>
	<div class="container">
	<h4 class="page-header">Complete Payment</h4>
	<?php
		if($_SESSION['itype'] == 'healthinsurance'){
			if($_SESSION['hiperson'] == 'Self'){
				// SELF
				$_SESSION['fname'] = $_POST['fname'];
				$_SESSION['lname'] = $_POST['lname'];
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['dob'] = $_POST['dob'];
				$_SESSION['idtype'] = $_POST['idtype'];
				$_SESSION['idNo'] = $_POST['idNo'];
				 if(isset($_FILES['photo'])){
						 $errors= array();
						 $_SESSION['file_name'] = $_FILES['photo']['name'];
						 $file_tmp =$_FILES['photo']['tmp_name'];
					 move_uploaded_file($file_tmp,"images/".$_SESSION['file_name']);
				 }
			}
			else if($_SESSION['hiperson'] == 'Family'){
				// SELF
				$_SESSION['fname'] = $_POST['fname'];
				$_SESSION['lname'] = $_POST['lname'];
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['dob'] = $_POST['dob'];
				$_SESSION['idtype'] = $_POST['idtype'];
				$_SESSION['idNo'] = $_POST['idNo'];
				
				// Spouse
				$_SESSION['sfname'] = $_POST['sfname'];
				$_SESSION['slname'] = $_POST['slname'];
				$_SESSION['semail'] = $_POST['semail'];
				$_SESSION['sdob'] = $_POST['sdob'];
				$_SESSION['sidtype'] = $_POST['sidtype'];
				$_SESSION['sidNo'] = $_POST['sidNo'];
				
				 if(isset($_FILES['photo']) && isset($_FILES['sphoto']) ){
						 $errors= array();
						 $_SESSION['file_name'] = $_FILES['photo']['name'];
						 $file_tmp =$_FILES['photo']['tmp_name'];
					 move_uploaded_file($file_tmp,"images/".$_SESSION['file_name']);
					
						 $_SESSION['file_name_spouse'] = $_FILES['sphoto']['name'];
						 $file_tmp_spouse =$_FILES['sphoto']['tmp_name'];
					 move_uploaded_file($file_tmp_spouse,"images/".$_SESSION['file_name_spouse']);
				 }
				
				if(isset($_SESSION['hkidno'])&& ($_SESSION['hkidno']=='1' ||$_SESSION['hkidno']=='2')){
				// Kid 1
				$_SESSION['k1fname'] = $_POST['k1fname'];
				$_SESSION['k1lname'] = $_POST['k1lname'];
				//$_SESSION['k1email'] = $_POST['k1email'];
				$_SESSION['k1dob'] = $_POST['k1dob'];
				$_SESSION['k1idtype'] = $_POST['k1idtype'];
				$_SESSION['k1idNo'] = $_POST['k1idNo'];
				if(isset($_FILES['k1photo'])){
						 $errors= array();
						 $_SESSION['file_name_k1'] = $_FILES['k1photo']['name'];
						 $file_tmp =$_FILES['k1photo']['tmp_name'];
						 move_uploaded_file($file_tmp,"images/".$_SESSION['file_name_k1']);
				}
				}
				if(isset($_SESSION['hkidno'])&& $_SESSION['hkidno']=='2'){
				// Kid 2
				$_SESSION['k2fname'] = $_POST['k2fname'];
				$_SESSION['k2lname'] = $_POST['k2lname'];
				//$_SESSION['k2email'] = $_POST['k2email'];
				$_SESSION['k2dob'] = $_POST['k2dob'];
				$_SESSION['k2idtype'] = $_POST['k2idtype'];
				$_SESSION['k2idNo'] = $_POST['k2idNo'];
				if(isset($_FILES['k1photo'])){
						 $errors= array();
						 $_SESSION['file_name_k2'] = $_FILES['k2photo']['name'];
						 $file_tmp =$_FILES['k2photo']['tmp_name'];
						 move_uploaded_file($file_tmp,"images/".$_SESSION['file_name_k2']);
					}
				}
			}
		}
		else if($_SESSION['itype'] == 'homeinsurance'){
				$_SESSION['hfname'] = $_POST['hfname'];
				$_SESSION['hlname'] = $_POST['hlname'];
				$_SESSION['hemail'] = $_POST['hemail'];
				$_SESSION['hdob'] = $_POST['hdob'];
				$_SESSION['hidtype'] = $_POST['hidtype'];
				$_SESSION['hidNo'] = $_POST['hidNo'];
				$_SESSION['emp'] = $_POST['emp'];
				$_SESSION['state'] = $_POST['state'];
				$_SESSION['hpincode'] = $_POST['hpincode'];
				$_SESSION['hadd'] = $_POST['hadd'];
				
				if(isset($_FILES['hphoto'])){
						 $errors= array();
						 $_SESSION['file_name'] = $_FILES['hphoto']['name'];
						 $file_tmp =$_FILES['hphoto']['tmp_name'];
						 move_uploaded_file($file_tmp,"images/".$_SESSION['file_name']);
				}
		}
		else if($_SESSION['itype'] == 'carinsurance'){
			
				$_SESSION['cfname'] = $_POST['cfname'];
				$_SESSION['clname'] = $_POST['clname'];
				$_SESSION['cemail'] = $_POST['cemail'];
				$_SESSION['cdob'] = $_POST['cdob'];
				$_SESSION['cidtype'] = $_POST['cidtype'];
				$_SESSION['cidNo'] = $_POST['cidNo'];
				
				$_SESSION['imanufacturer'] = $_POST['imanufacturer'];
				$_SESSION['imodel'] = $_POST['imodel'];
				$_SESSION['cipurchase'] = $_POST['cipurchase'];
				$_SESSION['vno'] = $_POST['vno'];
				$_SESSION['vregloc'] = $_POST['vregloc'];
				$_SESSION['AccidentCoverage'] = $_POST['AccidentCoverage'];
				$_SESSION['AccCoverageAmount'] = $_POST['AccCoverageAmount'];
				
				if(isset($_FILES['cphoto'])){
						 $errors= array();
						 $_SESSION['file_name'] = $_FILES['cphoto']['name'];
						 $file_tmp =$_FILES['hphoto']['tmp_name'];
						 move_uploaded_file($file_tmp,"images/".$_SESSION['file_name']);
				}
		}
		$_SESSION['buypolicyNo'] = mt_rand(1111111111,9999999999);
	?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h6>
				<b>Payment Details</b>
			</h6>
		</div>
		<div class="panel-body">
			<table class="table " style="width:100%">
				<tr>
					<th>Quote Ref. No</th>
					<th>Policy No</th>
					<th>Policy Type</th>
					<th>Premium Amount</th>
				</tr>
				<tr>
					<td><?php echo $_SESSION['QuoteRef']; ?></td>
					<td><?php echo $_SESSION['buypolicyNo']; ?></td>
					<td><?php
					if($_SESSION['itype'] == "healthinsurance")
						echo "Health Insurance"; 
					if($_SESSION['itype'] == "carinsurance")
						echo "Car Insurance";
					if($_SESSION['itype'] == "homeinsurance")
						echo "Home Insurance";
					?>
					</td>
					<td><?php echo $_SESSION['premiumamount']; ?></td>
				</tr>
			</table>
		</div>
	</div>		
	<?php 
	}
	else if(isset($_GET['action'])){
		if($_GET['action'] == "claim")
		{
			$policyid = $_GET['policyid'];
			$sql= "select * from policy where policyid = ".$policyid;
			
			$result = mysql_query($sql);
			?><div class="container">
		<h4 class="page-header">Claims</h4>
				<div class="panel panel-default">
			<div class="panel-heading">
				<h6>
					<b>Make a Claim</b>
				</h6>
			</div>
			<div class="panel-body">
			<div class="row">
				<table class="table " style="width:100%">
					<tr>
						<th>Quote Ref.</th>
						<th>Policy No</th>
						<th>Policy Type</th>
						<th>Premium Amount</th>
						<th>Insured Amount</th>
					</tr>
					<tr>
					<?php if($row = mysql_fetch_assoc($result)){
					?>
						<td><?php echo $row['QuoteRef']; ?></td>
						<td><?php echo $row['PolicyNo']; ?></td>
						<td><?PHP
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
					
					?></td>
						<td><?php echo $row['Premium']; ?></td>
						<td><?php echo $row['InsuredSum']; ?></td>
						
					</tr>
				</table>
</div>
<div class="row center" style="padding:20px">
<form action="" method="GET">
		<div class="row">
			<div class="input-field col s4">
				<input type="text" id="policyno" name="policyno" value ="<?php echo $row['PolicyNo'];?>" readonly/>
				<label for="policyno">Policy No. : </label>
			</div>
			<?php
			}
			?>
			<div class="input-field col s4">
				<input type="number" id="claimamount" name="claimamount"/>
				<label for="claimamount">Claim Amount :  <i class="fa fa-inr" style="vertical-align:middle;" aria-hidden="true"></i></label>
				<p class="help-block">It should be less than the insured sum to be approved. </p>
			</div>
			<button type="submit" name="claimbtn" class="btn btn-info ">Claim Amount</button>
		</div>
		</div>
			</div>
		</div>
	<?php	
	}
		else if($_GET['action'] == "renew")
		{
			$policyid = $_GET['policyid'];
			?>
			<div class="container">
	<h4 class="page-header">Renew</h4>
			<div class="panel panel-default">
		<div class="panel-heading">
			<h6>
				<b>Renew Policy</b>
			</h6>
		</div>
		<div class="panel-body center">
			<table class="table " style="width:100%">
				<tr>
					<th>Quote Ref. No</th>
					<th>Policy No</th>
					<th>Expiry Date</th>
					<th>Premium Amount</th>
					<th>Select Renewal Term</th>
				</tr>
				<tr><?php 
				$sql = "select * from policy where policyid=".$policyid;
				$result = mysql_query($sql);
				if($row = mysql_fetch_assoc($result)){
					
				?>
			
					<td><?php echo $row['QuoteRef'];?></td>
					<td><?php echo $row['PolicyNo'];?></td>
					<td><?php echo $row['EffectTo'];?></td>
					<td id="oldPrem"><?php echo $row['Premium']; ?></td>
					<td><select id="renewterm" name="idtype" class="browser-default">
							<option value="5" selected>5 years</option>
							<option value="10">10 years</option>
							<option value="15">15 years</option>
						</select></td>
					<?php
				}?>
				</tr>
			</table>
			<span id="revisedPrem" style="color:blue;"></p>
		</div>
	</div>
	<?php	}
	}
	if(!((isset($_GET['action']) && $_GET['action'] == "claim")||isset($_GET['claimamount']))){
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h6>
				<b>Choose Payment Method</b>
			</h6>
		</div>
		<div class="panel-body" style="min-height:300px;">
			<div class="row">
				<div class="vertical-menu col s4">
					<a id="c1" href="#" class="active">Debit Card</a>
					<a id="c2" href="#">Credit Card</a>
					<a id="c3" href="#">Net Banking</a>
				</div>
				<div class="col s8">
					<div class="card" style="padding:10px 40px 10px 40px">
						<div class="row">
							<form action="payment.php" method="POST">
							<div id="dbcard" style="display:block">
										<div class="row">
                                    <div class="input-field">
											<input id="cardNumber" type="number" name="dcardno" maxlength="22" class="validate .right-alert col s11">
											<label for="cardNumber">Debit Card number</label><i class="material-icons postfix">credit_card</i>
									</div>
									</div>
										<div class="row">
										<div class="input-field">
											<input id="name" type="text" name="name" class="validate  col s11"><i class="material-icons postfix">account_circle</i>
												<label for="name">Name on Card</label>
											</div>
										</div>
										<div class="row">
										<label for="expiryNo">Expiry Date</label>
										<div class="input-field">
											<input id="expiryNo" type="month" name="expiryNo" class="validate col s11"><span style="font-size:22px"><i class="fa fa-calendar" aria-hidden="true"></i></span>
										</div>
										</div>
										<div class="row">
										<div class="input-field">
											<input id="cvv" type="password" name="cvv" class="validate  col s11" maxlength="3">
											<label for="cvv">CVV</label>
										</div>
										</div>
										<div class="row">
										<div class="input-field submit-wrap right">
											<button class="btn btn-info submit" name="pay" type="submit">Pay</button>
										</div>
									</div>
							</div>
							</form>
							<form action="payment.php" method="POST">
							<div id="cdcard" style="display:none">
								<div class="row">
                                    <div class="input-field">
											<input id="cardNumber" type="number" name="ccardno" class="validate  col s11">
											<label for="cardNumber">Credit Card number</label><i class="material-icons postfix">credit_card</i>
									</div>
									</div>
									<div class="row">
										<div class="input-field">
											<input id="name" type="text" name="name" class="validate  col s11"><i class="material-icons postfix">account_circle</i>
												<label for="name">Name on Card</label>
											</div>
										</div>
										<div class="row">
										<label for="expiryNo">Expiry Date</label>
										<div class="input-field">
										
											<input id="expiryNo" type="month" name="expiryNo" class="validate datepicker col s11"><span style="font-size:30px"><i class="fa fa-calendar" aria-hidden="true"></i></span>
											
										</div>
										</div>
										<div class="row">
										<div class="input-field">
											<input id="cvv" type="password" name="cvv" class="validate  col s11">
											<label for="cvv">CVV</label>
										</div>
										</div>
										<div class="row">
										<div class="input-field submit-wrap right">
											<button class="btn btn-info submit" name="pay" type="submit">Pay</button>
										</div>
									</div>
							</div>
							</form>
							<form action="payment.php" method="POST">
							<div id="ntbank" style="display:none">
									<div class="row">
										<div class="input-field">
										<i class="material-icons prefix">account_circle</i>
											<input id="name" type="text" name="username" class="validate  col s11">
												<label for="name">Username</label>
											</div>
										</div>
										<div class="row">
										<div class="input-field">
										<i class="material-icons prefix">mode_edit</i>
											<input id="cvv" type="password" name="cvv" class="validate  col s11">
											<label for="cvv">Password</label>
										</div>
										</div>
<<<<<<< HEAD
=======
							<div class="row">
										<div class="input-field submit-wrap right">
											<button class="btn btn-info submit" name="pay" type="submit">Pay</button>
										</div>
									</div>
>>>>>>> fd7b884ef08e7b18eec369799d8da3cadc46c891
							</div>
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<?php
	}
	?>
		</div>
		<?php include('footer.php'); ?>