<?php
if(isset($_POST['VMID'])){
$dbconnect=mysqli_connect("localhost","root","","vt");

$sql6="SELECT * FROM `storage` WHERE VMID='".$_POST['VMID']."'";
$query6=mysqli_query($dbconnect,$sql6);

if($_POST['serverTo']!="0"){
	$sql7="SELECT * FROM `capacity` WHERE ServerNo='".$_POST['serverTo']."'";
	$query7=mysqli_query($dbconnect,$sql7);
}
else{
	$sql7="SELECT * FROM `capacity`";
	$query7=mysqli_query($dbconnect,$sql7);
}

$rs8=mysqli_fetch_assoc($query7);
$maxi=(int)$rs8['Max'];

$rs9=mysqli_fetch_assoc($query7);
$capi=(int)$rs8['Capacity'];

$add=(int)$_POST['Capacity'];

if(($capi+$add)<$maxi){



	if(!mysqli_num_rows($query6) && mysqli_num_rows($query7)){

		if($_POST['serverTo']!="0"){

			$sql="INSERT INTO `storage` (`ID`, `Storage`, `VMID`, `Server`, `Capacity`) VALUES (NULL, '".$_POST['serverTo']."', '".$_POST['VMID']."', '1', '".$_POST['Capacity']."');";
			$query=mysqli_query($dbconnect,$sql);

			$g="hi";
			header("Location: xTransfer.php?serverNo=".$_POST['serverTo']);

		}

		else{
			$sql6="SELECT min(`Capacity`) AS tot FROM `capacity`";
			$query6=mysqli_query($dbconnect,$sql6);
			$rs6=mysqli_fetch_assoc($query6);

			$sql5="SELECT * FROM `capacity` WHERE Capacity ='".$rs6['tot']."'";
			$query5=mysqli_query($dbconnect,$sql5);
			$rs5=mysqli_fetch_assoc($query5);

			$sql="INSERT INTO `storage` (`ID`, `Storage`, `VMID`, `Server`, `Capacity`) VALUES (NULL, '".$rs5['ServerNo']."', '".$_POST['VMID']."', '1', '".$_POST['Capacity']."');";
			$query=mysqli_query($dbconnect,$sql);
			
			$sql2="INSERT INTO `logs` (`id`, `type`, `fromz`, `toz`, `app`, `datez`) VALUES (NULL, 'APP', '".$_POST['serverTo']."', NULL, '".$_POST['VMID']."', CURRENT_TIMESTAMP);";
			$query2=mysqli_query($dbconnect,$sql2);


			header("Location: xTransfer.php?serverNo=".$_POST['serverTo']);
		}
	}

	else {
		echo "Check Details";
	}
}

else{
	echo "Not Enough Storage";
}

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

	$sql8="INSERT INTO `logs` (`id`, `type`, `fromz`, `toz`, `app`, `datez`) VALUES (NULL, 'APP', '".$_POST['serverTo']."', NULL, '".$_POST['VMID']."', CURRENT_TIMESTAMP);";
		$query8=mysqli_query($dbconnect,$sql8);


}
?>