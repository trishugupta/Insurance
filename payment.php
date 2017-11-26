<?php
 include('header.php');
 // if(isset($_POST['buypolicy'])){
	// $_SESSION['tranid'] = "Txn2017".randomString(11);
	// $_SESSION['buypolicyNo'] = mt_rand(1111111111,9999999999);
 // }
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
  if(isset($_POST['pay'])){
	$_SESSION['tranid'] = "Txn2017".randomString(11);
 }
	
 if (isset($_SESSION['Name'])) {
	$userid = $_SESSION["userid"];
}
 ?>
 
  <div class="container">
    <h3 class="page-header">Transaction</h3>
	<div class="row container-fluid">
	<h6 class="left">Transaction Id : <span style="color:blue"><?php echo $_SESSION['tranid']; ?></span></h6>
	<h6 class="left">Policy No : <span style="color:blue"><?php echo $_SESSION['buypolicyNo']; ?></span></h6>
	<h6 class="right">Transaction Date : <span style="color:blue"><?php echo date("d-m-y"); ?></span></h6>
	</div>
   <?php 
   include( "db.php" );
		 if(isset($_POST['pay'])){
			 if($_SESSION['itype'] == 'healthinsurance'){
				 $sql= "";
				 if($_SESSION['hiperson'] == 'Self'){
					 $sql = "insert into healthpolicydetails (`fname`,`lname`,`email`,`dob`,`idtype`,`idno`,`relation`,`photopath`,`policyno`) 
					 values ('".$_SESSION['fname']."','".$_SESSION['lname']."','".$_SESSION['email']."','".$_SESSION['dob']."','".$_SESSION['idtype']."','".$_SESSION['idNo']."','Self','images/".$_SESSION['file_name']."','".$_SESSION['buypolicyNo']."')";
				 }
				 else if($_SESSION['hiperson'] == 'Family'){
					 $sql = "insert into healthpolicydetails (`fname`,`lname`,`email`,`dob`,`idtype`,`idno`,`relation`,`photopath`,`policyno`) 
					 values ('".$_SESSION['fname']."','".$_SESSION['lname']."','".$_SESSION['email']."','".$_SESSION['dob']."','".$_SESSION['idtype']."','".$_SESSION['idNo']."','Self','images/".$_SESSION['file_name']."','".$_SESSION['buypolicyNo']."')";
					 $sql .= ",('".$_SESSION['sfname']."','".$_SESSION['slname']."','".$_SESSION['semail']."','".$_SESSION['sdob']."','".$_SESSION['sidtype']."','".$_SESSION['sidNo']."','Spouse','images/".$_SESSION['file_name_spouse']."','".$_SESSION['buypolicyNo']."')";
					 
					 if($_SESSION['hkidno'] == 1){
						 $sql .= ",('".$_SESSION['k1fname']."','".$_SESSION['k1lname']."','','".$_SESSION['k1dob']."','".$_SESSION['k1idtype']."','".$_SESSION['k1idNo']."','Kids','images/".$_SESSION['file_name_k1']."','".$_SESSION['buypolicyNo']."')";
					 }
					 else if($_SESSION['hkidno'] == 2){
					$sql .= ",('".$_SESSION['k1fname']."','".$_SESSION['k1lname']."','','".$_SESSION['k1dob']."','".$_SESSION['k1idtype']."','".$_SESSION['k1idNo']."','Kids','images/".$_SESSION['file_name_k1']."','".$_SESSION['buypolicyNo']."')";
				   $sql .= ",('".$_SESSION['k2fname']."','".$_SESSION['k2lname']."','','".$_SESSION['k2dob']."','".$_SESSION['k2idtype']."','".$_SESSION['k2idNo']."','Kids','images/".$_SESSION['file_name_k2']."','".$_SESSION['buypolicyNo']."')";
				 }
				 }
				 if(mysql_query($sql))
				 {
				  if (!isset($_SESSION['Name'])) {
					  
					  $userSql = "select * from users where emailid = '".$_SESSION['email']."'";
					 $result = mysql_query($userSql);
					 if(!($row = mysql_fetch_assoc($result))){
					 $sql = "insert into users (`fname`,`lname`,`emailid`,`dob`,`password`,`photopath`) values('".$_SESSION['fname']."','".$_SESSION['lname']."','".$_SESSION['email']."','".$_SESSION['dob']."','".$_SESSION['tranid']."','images/".$_SESSION['file_name']."')";
					 mysql_query($sql);
					  
					  $expdate = date('Y-m-d',strtotime('today')+(31622400*$_SESSION['iterm']));
					  
					 $sql = "insert into policy (QuoteRef,PolicyNo,EffectFrom,EffectTo,Premium,InsuredSum,addInsured,userid) values ('".$_SESSION['QuoteRef']."','".$_SESSION['buypolicyNo']."',
					'".date("Y-m-d")."','".$expdate."','".$_SESSION['premiumamount']."','".$_SESSION['InsuredAmount']."','','".mysql_insert_id()."')";
					if(mysql_query($sql)){
					 echo "<div class='row center' >
					 <div class=' panel-default'>
					 <h4 style='color:green;margin-top:100px'>Payment completed Successfully !!</h4>
				 </div>";
					 echo "<span>Note down the transaction id for future reference. You can use your <b>Transaction Id</b> as password to view your policies.</span>";
					 }else{
						  mysql_error();
					  echo "<div class='row center' >
					 <div class=' panel-default'>
					 <h4 style='color:red;margin-top:100px'>Payment failed !!</h4>
					 <h6>Do not refresh the screen !!</h6>
					 </div>
					 </div>"; 
					 }
				  }
				  }
					 else
					 {
						 $userSql = "select * from users where emailid = '".$_SESSION['email']."'";
					 $result = mysql_query($userSql);
					$row = mysql_fetch_assoc($result);
					 
					 $expdate = date('Y-m-d',strtotime('today')+(31622400*$_SESSION['iterm']));
					  
					$sql = "insert into policy (QuoteRef,PolicyNo,EffectFrom,EffectTo,Premium,InsuredSum,addInsured,userid) values ('".$_SESSION['QuoteRef']."','".$_SESSION['buypolicyNo']."',
					'".date("Y-m-d")."','".$expdate."','".$_SESSION['premiumamount']."','".$_SESSION['InsuredAmount']."','','".$row['userid']."')";
					  if(mysql_query($sql))
					  {
							echo "<div class='row center' >
							<div class=' panel-default'>
							<h4 style='color:green;margin-top:100px'>Payment completed Successfully !!</h4>
						</div>";
					  }
					  else
					  { mysql_error();
					  echo "<div class='row center' >
					 <div class=' panel-default'>
					 <h4 style='color:red;margin-top:100px'>Payment failed !!</h4>
					 <h6>Do not refresh the screen !!</h6>
					 </div>
					 </div>"; 
					 }
					 }
				 }else {
					mysql_error();
					 echo "<div class='row center' >
					 <div class=' panel-default'>
					 <h4 style='color:red;margin-top:100px'>Payment failed !!</h4>
					 </div>
					 </div>"; 
				 echo "</div>";
				}
		}
		 else if($_SESSION['itype'] == 'homeinsurance'){
			 	
				$sql = "INSERT INTO `homepolicydetails`(`quoteref`, `pincode`, `buildyear`, `fname`, `lname`, `email`,`dob`, `idtype`, `idno`, `state`, `address`,`photopath`, `policyno`) 
				VALUES('".$_SESSION['QuoteRef']."','".$_SESSION['hpincode']."','".$_SESSION['houseage']."','".$_SESSION['hfname']."','".$_SESSION['hlname']."','".$_SESSION['hemail']."','".$_SESSION['hdob']."','".$_SESSION['hidtype']."','".$_SESSION['hidNo']."','".$_SESSION['state']."','".$_SESSION['hadd']."','images/".$_SESSION['file_name']."','".$_SESSION['buypolicyNo']."')";
				 
				 if(mysql_query($sql))
				 {
					 $userSql = "select * from users where emailid = '".$_SESSION['hemail']."'";
					 $result = mysql_query($userSql);
					 if($row = mysql_fetch_assoc($result)){
						$date=date_create("today");
						date_add($date,date_interval_create_from_date_string($_SESSION['iterm']));
						$sql = "insert into policy (QuoteRef,PolicyNo,EffectFrom,EffectTo,Premium,InsuredSum,addInsured,userid) values ('".$_SESSION['QuoteRef']."','".$_SESSION['buypolicyNo']."',
						'".date("Y-m-d")."','".date_format($date,"Y-m-d")."','".$_SESSION['premiumamount']."','".$_SESSION['constructionCoverage']."','".$_SESSION['contentCoverage']."','".$row['userid']."')";
						if(mysql_query($sql)){
					  echo "<div class='row center' >
					 <div class=' panel-default'>
					 <h4 style='color:green;margin-top:100px'>Payment completed Successfully !!</h4>
				 </div>";
						}else{
							 echo "<div class='row center' >
					 <div class=' panel-default'>
					 <h4 style='color:red;margin-top:100px'>Payment failed !!</h4>
					 <h6>Do not refresh the screen !!</h6>
					 </div>
					 </div>"; 
						}
					 }
					 else
					 {
					 $sql = "insert into users (`fname`,`lname`,`emailid`,`dob`,`password`,`photopath`) values('".$_SESSION['hfname']."','".$_SESSION['hlname']."','".$_SESSION['hemail']."','".$_SESSION['hdob']."','".$_SESSION['tranid']."','images/".$_SESSION['file_name']."')";
					 mysql_query($sql);
					 $sql = "insert into policy (QuoteRef,PolicyNo,EffectFrom,EffectTo,Premium,InsuredSum,addInsured,userid) values ('".$_SESSION['QuoteRef']."','".$_SESSION['buypolicyNo']."',
					'".date("Y-m-d")."','".date_format($date,"Y-m-d")."','".$_SESSION['premiumamount']."','".$_SESSION['InsuredAmount']."','','".mysql_insert_id()."')";
					if(mysql_query($sql)){
					  echo "<div class='row center' >
					 <div class=' panel-default'>
					 <h4 style='color:green;margin-top:100px'>Payment completed Successfully !!</h4>
				 </div>";
				 echo "<span>Note down the transaction id for future reference. You can use your <b>Transaction Id</b> as password to view your policies.</span>";
						}else{
							 echo "<div class='row center' >
					 <div class=' panel-default'>
					 <h4 style='color:red;margin-top:100px'>Payment failed !!</h4>
					 <h6>Do not refresh the screen !!</h6>
					 </div>
					 </div>"; 
						}
					 }
				}
				else {mysql_error();
					 echo "<div class='row center' >
					 <div class=' panel-default'>
					 <h4 style='color:red;margin-top:100px'>Payment failed !!</h4>
					 </div>
					 </div>"; 
					 }
			 
		 }
		 else if($_SESSION['itype'] == 'carinsurance'){
			 
				$sql = "INSERT INTO `carpolicydetails`(`quoteref`, `manufacturer`, `model`, `purchasedate`, `vehicleno`, `vRegistLocation`, `isAccidentCoverage`, 
				`AccCoverageAmount`, `fname`, `lname`, `email`, `dob`, `idtype`, `idno`, `photopath`, `policyno`) 
				VALUES('".$_SESSION['QuoteRef']."','".$_SESSION['imanufacturer']."','".$_SESSION['imodel']."','".$_SESSION['cipurchase']."','".$_SESSION['vno']."',
				'".$_SESSION['vregloc']."','".$_SESSION['AccidentCoverage']."','".$_SESSION['AccCoverageAmount']."','".$_SESSION['cfname']."','".$_SESSION['clname']."',
				'".$_SESSION['cemail']."','".$_SESSION['cdob']."','".$_SESSION['cidtype']."','".$_SESSION['cidNo']."','images/".$_SESSION['file_name']."','".$_SESSION['buypolicyNo']."')";
				 
				  if(mysql_query($sql))
				 {
					 $userSql = "select * from users where emailid = '".$_SESSION['cemail']."'";
					 $result = mysql_query($userSql);
					 if($row = mysql_fetch_assoc($result)){
					 //$date=date_create("today");
					//date_add($date,date_interval_create_from_date_string($_SESSION['citerm']));
					$term = date('Y-m-d',strtotime('today')+(31622400*$_SESSION['citerm']));
					$sql = "insert into policy (QuoteRef,PolicyNo,EffectFrom,EffectTo,Premium,InsuredSum,addInsured,userid) values ('".$_SESSION['QuoteRef']."','".$_SESSION['buypolicyNo']."',
					'".date("Y-m-d")."','".$term."','".$_SESSION['premiumamount']."','".$_SESSION['AccCoverageAmount']."','".$_SESSION['AccidentCoverage']."','".$row['userid']."')";
					 if(mysql_query($sql)){
						   echo "<div class='row center' >
					 <div class=' panel-default'>
					 <h4 style='color:green;margin-top:100px'>Payment completed Successfully !!</h4>
				 </div>";
					 }
					 else{
						 echo "<div class='row center' >
					 <div class=' panel-default'>
					 <h4 style='color:red;margin-top:100px'>Payment failed !!</h4>
					 <h6>Do not refresh the screen !!</h6>
					 </div>
					 </div>"; 
					 }
					 }
					 else
					 {
					 $sql = "insert into users (`fname`,`lname`,`emailid`,`dob`,`password`,`photopath`) values('".$_SESSION['cfname']."','".$_SESSION['clname']."','".$_SESSION['cemail']."','".$_SESSION['cdob']."','".$_SESSION['tranid']."','images/".$_SESSION['file_name']."')";
					 mysql_query($sql);
					 $term = date('Y-m-d',strtotime('today')+(31622400*$_SESSION['citerm']));
					 $sql = "insert into policy (QuoteRef,PolicyNo,EffectFrom,EffectTo,Premium,InsuredSum,addInsured,userid) values ('".$_SESSION['QuoteRef']."','".$_SESSION['buypolicyNo']."',
					'".date("Y-m-d")."','".$term."','".$_SESSION['premiumamount']."','".$_SESSION['InsuredAmount']."','','".mysql_insert_id()."')";
					if(mysql_query($sql)){
						if(mysql_query($sql)){
						   echo "<div class='row center' >
					 <div class=' panel-default'>
					 <h4 style='color:green;margin-top:100px'>Payment completed Successfully !!</h4>
				 </div>";
				 echo "<span>Note down the transaction id for future reference. You can use your <b>Transaction Id</b> as password to view your policies.</span>";
					 }
					 else{
						 echo "<div class='row center' >
					 <div class=' panel-default'>
					 <h4 style='color:red;margin-top:100px'>Payment failed !!</h4>
					 <h5>Do not refresh the screen !!</h5>
					 </div>
					 </div>"; 
					 }
					}
				}
				}
				else {mysql_error();
					 echo "<div class='row center' >
					 <div class=' panel-default'>
					 <h4 style='color:red;margin-top:100px'>Payment failed !!</h4>
					 </div>
					 </div>"; 
					 }
		 }
 }	
 ?>
 </div>
<?php include('footer.php'); ?>