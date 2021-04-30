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

if(isset($_POST['Capacity'])){
	$dbconnect=mysqli_connect("localhost","root","","vt");

	
	$sql="INSERT INTO `capacity` (`ServerNo`, `Capacity`, `Max`) VALUES (NULL, '0', '".$_POST['Capacity']."')";
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

		$query=mysqli_query($dbconnect,$sql4);
	}


}

?>

</form>
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
			$sql2="SELECT * FROM `capacity`";
			$query2=mysqli_query($dbconnect,$sql2);
		
			while($rs2=mysqli_fetch_assoc($query2)){
				?>
				<a href="Capacity.php?StorageNo=<?php echo $rs2['ServerNo'] ?>">
					<div style="width:25%;margin:20px;border:1px solid #00b8e6;border-radius:20px;float:left;">
						<img src="server.jpg" style="width:99.5%;border:1px solid #ffffff;border-radius:20px;">
						<p style="margin-left:15%;text-align:center;"> Storage <?php echo $rs2['ServerNo'] ?></p>
					</div>
				</a>
					<?php
				}

		 ?>

	</div>
<!-- box-shadow:5px 3px 10px grey; -->

	<div style="width:40%;height:750px;float:left;border:1px solid #00b8e6; border-radius:10px;background-color:#ffffff;margin-top:25px">
		<p style="width:94.7%;background-color:#00b8e6;border:1px solid #00b8e6;border-radius:10px;margin-top:0px;padding:20px;font-size:20px;font-weight:bold;color:white">SERVER INFORMATION</p>
		
		<form action="AddServer.php" method="post" style="padding:20px;margin:20px;">

			Enter Max Capacity<br><input type="text" name="Capacity" style="padding:10px;margin:10px;">GB<br>
			
			<input type="submit" name="submit" style="margin:10px;">
	
		</form>
	</div>

</body>
</html>