<?php

if(isset($_POST['VMID'])){

$dbconnect=mysqli_connect("localhost","root","","vt");

$sql6="SELECT * FROM `storage` WHERE VMID='".$_POST['VMID']."' AND Storage='".$_POST['serverFrom']."'";
$query6=mysqli_query($dbconnect,$sql6);

$sql7="SELECT * FROM `capacity` WHERE ServerNo='".$_POST['serverTo']."'";
$query7=mysqli_query($dbconnect,$sql7);

if(mysqli_num_rows($query6) && $_POST['serverFrom'] && mysqli_num_rows($query7)){

$sql="UPDATE `storage` SET `Storage` = '".$_POST['serverTo']."' WHERE `storage`.`VMID` = '".$_POST['VMID']."' ";//transfer data to another Storage
$query=mysqli_query($dbconnect,$sql);
}

else{
	echo "Please recheck data entered";
}


//Update capactiy table
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

	$query=mysqli_query($dbconnect,$sql4);

	echo "success";
}
	$sql8="INSERT INTO `logs` (`id`, `type`, `fromz`, `toz`, `app`, `datez`) VALUES (NULL, 'TRANSFER', '".$_POST['serverFrom']."', '".$_POST['serverTo']."', '".$_POST['VMID']."', CURRENT_TIMESTAMP);";
	$query8=mysqli_query($dbconnect,$sql8);

	header("Location: xTransfer.php?serverNo=".$_POST['serverFrom']);
}
?>