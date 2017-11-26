<?php

$dbHost = 'localhost:3306';
$dbUser = 'root';
$dbPass = '';
$dbName = "insurance";
$sql = '';

$conn = mysql_connect($dbHost,$dbUser,$dbPass);

If(!$conn){
	die('Connection failure');
}

		mysql_select_db($dbName);

?>