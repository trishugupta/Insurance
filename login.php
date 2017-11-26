<?php
 include('header.php');
 
if (isset($_SESSION['Name'])) {
	if($_SESSION["RoleId"] == 1)
		header('Location:adminpanel.php');
	else if($_SESSION["RoleId"] == 2)
		header('Location:myaccount.php');
}

 include('db.php');
?>
  <div class="container">
  <h3 class="page-header">Login</h3>
  <ul class="nav nav-tabs">
					<li class="active">
						<a data-toggle="tab" href="#userlogin">Customer</a>
					</li>
					<li>
						<a data-toggle="tab" href="#adminlogin">Admin</a>
					</li>
</ul>
<div class="tab-content">
		<div id="userlogin" class="tab-pane fade in active">
  <div class="card" style="padding:30px">
  <form  method="POST" action="	">
    <div class="form-group">
      <label class="control-label" for="pno">Policy No :</label>
        <input type="text" class="form-control" id="policyNo" placeholder="Enter Policy No" name="pno" value="<?php if(isset($_POST['login']) && $_POST['pno']!='') echo $_POST['pno']; ?>">
    </div>
    <div class="form-group">
      <label class="control-label" for="dob">Date of Birth :</label>
        <input type="date" class="form-control" id="dob" name="dob" value="<?php if(isset($_POST['login']) && $_POST['dob']!=''){echo $_POST['dob'];}else echo date('Y-m-d'); ?>">
    </div>
	<?php
	if (isset($_POST['login'])) {
		$dob = date('Y-m-d', strtotime($_POST['dob']));
		$sql = "select * from policy p join users u on p.userid = u.userid where p.PolicyNo = '".$_POST['pno']."' and u.dob = '".$dob."'";
		$result = mysql_query($sql);
	
		if (empty($_POST['pwd'])) {
			if ($row = mysql_fetch_assoc($result)) {
				if ($row['password'] != '') {
					
					echo "<div class='form-group' style='display:block'>
					<label class='control-label' for='pwd'>Password :</label>
					<input type='password' class='form-control' id='pwd' placeholder='Enter Password' name='pwd'>
					</div>";
				} else {
					?>
					<div class="form-group">
					<label class="control-label" style="color:red" for="maiden">Security Check </label>
						<input type="text" class="form-control" id="maiden" placeholder="Enter your mother's maiden name" name="maiden" />
					</div>
					<div class="form-group" style="display:block">
					<label class="control-label" for="spwd">Set a password :</label>
					<input type="password" class="form-control" id="spwd" placeholder="Enter Password" name="spwd">
					</div>
					<div class="form-group" style="display:block">
					<label class="control-label" for="cpwd">Confirm password :</label>
					<input type="password" class="form-control" id="cpwd" placeholder="Confirm Password" name="cpwd">
					</div>
					<?php
				}
			} else {
				echo "<span style='color:red'>Sorry No data found please buy a policy.</span><br/><br/>";
			}
		} else {
			while ($row = mysql_fetch_assoc($result)) {
				if ($row['password'] == $_POST['pwd']) {
					$_SESSION["PolicyNo"] = $row['PolicyNo'];
					$_SESSION["Name"] = $row['fname']." ".$row['lname'];
					$_SESSION["RoleId"] = $row['roleid'];
					$_SESSION["userid"] = $row['userid'];

					if ($row['roleid'] == "2") {
						header("Location: ./myaccount.php"); /* Redirect browser */
					} else if ($row['roleid'] == "1") {
						header("Location: ./adminpanel.php"); /* Redirect browser */
					}
				}
			}
		}
	}
	?>
    <div class="form-group">        
      <div class="">
        <button type="submit" name="login" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
  <?php 
	if(isset($_POST['login'])){
		//
	}
  ?>
  </div>
</div>
<div id="adminlogin" class="tab-pane fade">
  <div class="card" style="padding:30px">
<form  method="POST" action="">
    <div class="form-group">
      <label class="control-label" for="amail">Email Id :</label>
        <input type="email" class="form-control" id="amail" placeholder="Enter Email Id" name="amail" />
    </div>
    <div class="form-group">
      <label class="control-label" for="apwd">Password :</label>
        <input type="password" class="form-control" id="apwd" placeholder="Enter Password" name="apwd" />
    </div>
	    <div class="form-group">        
      <div class="">
        <button type="submit" name="adminlogin" class="btn btn-default">Log In</button>
      </div>
    </div>
  </form>
  <?php
	if(isset($_POST['adminlogin'])){
		$sql = "SELECT * FROM `users` where emailid='".$_POST['amail']."' and password = '".$_POST['apwd']."' and roleid = 1";
		$result = mysql_query($sql);
		if($row = mysql_fetch_assoc($result)){
			$_SESSION["Name"] = $row['fname']." ".$row['lname'];
			$_SESSION["RoleId"] = $row['roleid'];
			$_SESSION["userid"] = $row['userid'];
			
			$currentdatetime = date('Y-m-d H:i:s');
			$sql = "UPDATE `users` SET `lastlogin`='".$currentdatetime."' WHERE emailid='".$_POST['amail']."' and password = '".$_POST['apwd']."' and roleid = 1";
			mysql_query($sql);
			
			if ($_SESSION["RoleId"] == "2") {
						header("Location: ./myaccount.php"); /* Redirect browser */
				} else if ($row['roleid'] == "1") {
						header("Location: ./adminpanel.php"); /* Redirect browser */
			}
		}
	}
  ?>
</div>
</div>

<?php include('footer.php'); ?>
