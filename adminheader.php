<?php
session_start();
$username = "";
if(isset($_SESSION['Name']) && $_SESSION["RoleId"] == 1)
	$username = $_SESSION['Name'];
else
	header('Location:login.php');
 ?>
<html lang="en">
	<head>
		<title>Insurance Company</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="icon"  type="image/png" href="images\favicon.png"/>
		
		<script src="js/jquery-3.2.1.min.js"></script>
		
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		
		<!--Import Google Icon Font-->
		<link href="css/icon.css" rel="stylesheet" />
		<link href="css/layout.css" rel="stylesheet" />
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"/>
		
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  />
		<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
		
		<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
		
		<!--<script type="text/javascript" src="pickadate/lib/picker.js"></script>
		<script type="text/javascript" src="pickadate/lib/picker.date.js"></script>-->
		
		<style>
		body {
			padding-top: 50px;
			padding-bottom:50px;
		}
		</style>
	</head>							
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"/>
				<span class="icon-bar"/>
				<span class="icon-bar"/>
				<span class="icon-bar"/>                        
			</button>
			<a class="navbar-brand active" href="index.php">Trishu Insurance</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li class="active">
					<a href="adminpanel.php">Home</a>
				</li>
				<li>
					<a href="riskfactor.php">Risk Factors</a>
				</li>
				<li>
					<a href="policies.php">Policies</a>
				</li>
				<li>
					<a href="claims.php">Claims</a>
				</li>
				<li>
					<a href="feedback.php">Feedbacks &amp; Queries</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right" style="padding-right:10px;">
			 <?php 
				if (!empty($username)) {
					echo "<li><a href='myaccount.php'>
					<span class='glyphicon glyphicon-user'/> ".$username."</a></li>
					<li><a href='logout.php'>
					<span class='glyphicon glyphicon-log-in'/> LogOut</a></li>";
				} else {
					echo "<li><a href='login.php'>
					<span class='glyphicon glyphicon-log-in'/> Login</a></li>";
				}
			?>
			</ul>
		</div>
	</nav>