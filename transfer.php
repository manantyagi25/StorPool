<style type="text/css">
	body{
		margin:0px; 
	}
	a{
		color:#00b8e6;
		text-decoration: none;
	}
	
</style>
<?php
include("nav.php");
?>
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


}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Server</title>
</head>
<body>
	<div style="width:50%;float:left;margin:25px;border:1px solid #00b8e6;border-radius:10px;height:750px;background-color:#ffffff">
		<p style="width:95.8%;background-color:#00b8e6;border:1px solid #00b8e6;border-radius:10px;margin-top:0px;padding:20px;font-size:20px;font-weight:bold;color:white">SERVERS</p>
<?php
			$dbconnect=mysqli_connect("localhost","root","","vt");
			if(isset($_POST['serverFrom'])){
				$sql="SELECT * FROM `storage` WHERE Storage='".$_POST['serverTo']."'";
			}
			else{
				$sql="SELECT * FROM `storage`";
			}
			$query=mysqli_query($dbconnect,$sql);
			?>

			<table style="width:95%;height:80%;margin-left:20px;border-spacing:0px" border="1px">
					<th>
						<td style="text-align:center">Storage</td>
						<td style="text-align:center">VM</td>
						<td style="text-align:center">Capacity</td>
					</th>
					
				<?php	

				while($rs=mysqli_fetch_assoc($query)){
				?>
				<tr>
					<td>.</td>
					<td rowspan="1" style="text-align:center"><?php echo $rs['Storage']?></td>
					<td rowspan="1" style="text-align:center"><?php echo $rs['VMID']?></td>
					<td rowspan="1" style="text-align:center"><?php echo $rs['Capacity']?></td>			
				</tr>
					<?php
				}
				
		?>
			</table>


	</div>
<!-- box-shadow:5px 3px 10px grey; -->

	<div style="width:40%;height:750px;float:left;border:1px solid #00b8e6; border-radius:10px;background-color:#ffffff;margin-top:25px">
		<p style="width:94.7%;background-color:#00b8e6;border:1px solid #00b8e6;border-radius:10px;margin-top:0px;padding:20px;font-size:20px;font-weight:bold;color:white">STORAGE INFORMATION</p>
		
		<form action="transfer.php" method="post">

			App Name<input type="text" name="VMID"><br>
			Storage no. (From)<input type="number" name="serverFrom"><br>
			Storage no. (TO)<input type="number" name="serverTo">
			
			<input type="submit" name="submit">
			
		</form>
	</div>

</body>
</html>