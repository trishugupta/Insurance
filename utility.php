<?php
session_start();
include('db.php');

    if(isset($_GET['manufacturer'])){
        $manu = $_GET['manufacturer'];
		if($manu != "0"){
			$carmodelsql = "select modelno from carrisk where manufacturer = '".$manu."'";
			echo $carmodelsql;
			$result = mysql_query($carmodelsql);
			$returndata = "";
			while($row = mysql_fetch_assoc($result)){
			$returndata .= "<option value='".$row['modelno']."'>".$row['modelno']."</option>";
			}
		echo $returndata;
		}
		else echo "0";
    }
	else echo "NA";
?>