
<?php

// THIS IS THE CODE FOR DELETE SERVER
if(isset($_GET['DeleteS'])){
	$dbconnect=mysqli_connect("localhost","root","","vt");
	$sql="SELECT * FROM `storage` WHERE Storage='".$_GET['DeleteS']."'";
	$query=mysqli_query($dbconnect,$sql);

	while($rs=mysqli_fetch_assoc($query)){
			$sql2="DELETE FROM `storage` WHERE Storage='".$_GET['DeleteS']."'";
			$query2=mysqli_query($dbconnect,$sql2);

	}
	$sql3="DELETE FROM `capacity` WHERE ServerNo='".$_GET['DeleteS']."'";
	$query3=mysqli_query($dbconnect,$sql3);

	$sql4="INSERT INTO `logs` (`id`, `type`, `fromz`, `toz`, `app`, `datez`) VALUES (NULL, 'DELETE', '".$_GET['DeleteS']."', NULL, NULL, CURRENT_TIMESTAMP);";
	$query4=mysqli_query($dbconnect,$sql4);

	echo "Success";
	header("Location: x.php");

}

?>