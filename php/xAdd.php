<?php

$dbconnect=mysqli_connect("localhost","root","","vt");

// THIS IS THE CODE FOR ADD SERVER
if(isset($_POST['Capacity'])){
	$randIP = "".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);
	$sql="INSERT INTO `capacity` (`ServerNo`, `Capacity`, `Max`,`ip`) VALUES (NULL, '0', '".$_POST['Capacity']."', '".$randIP."')";
	$query=mysqli_query($dbconnect,$sql);

	//Update the capacity table
	$sql2="SELECT `ServerNo` FROM `capacity`";
	$query2=mysqli_query($dbconnect,$sql2);

	while($rs2=mysqli_fetch_assoc($query2)){
		
		$sql3="SELECT * FROM `storage` WHERE `Storage` = '".$rs2['ServerNo']."'";

		$query3=mysqli_query($dbconnect,$sql3);

		$sum=0;

		while($rs3=mysqli_fetch_assoc($query3)){
			$sum+=(int)$rs3['Capacity'];
		}

		$sql4="UPDATE `capacity` SET `Capacity` =  '".$sum."' WHERE `capacity`.`ServerNo` = '".$rs2['ServerNo']."'";
		$query4=mysqli_query($dbconnect,$sql4);

	}

	$sql6= "SELECT * FROM `capacity` ORDER BY `ServerNo` DESC";
	$query6=mysqli_query($dbconnect,$sql6);
	$rs6=mysqli_fetch_assoc($query6);

	$sql5="INSERT INTO `logs` (`id`, `type`, `fromz`, `toz`, `app`, `datez`) VALUES (NULL, 'ADD', '".$rs6['ServerNo']."', NULL, NULL, CURRENT_TIMESTAMP);";
	$query5=mysqli_query($dbconnect,$sql5);

	header("Location: x.php");
}

?>