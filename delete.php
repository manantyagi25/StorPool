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
	$dbconnect=mysqli_connect("localhost","root","","vt");


if(isset($_POST['DeleteS'])){
	$sql="SELECT * FROM `storage` WHERE Storage='".$_POST['DeleteS']."'";
	$query=mysqli_query($dbconnect,$sql);

	while($rs=mysqli_fetch_assoc($query)){
			$sql2="DELETE FROM `storage` WHERE Storage='".$_POST['DeleteS']."'";
			$query2=mysqli_query($dbconnect,$sql2);

	}
	$sql3="DELETE FROM `capacity` WHERE ServerNo='".$_POST['DeleteS']."'";
	$query3=mysqli_query($dbconnect,$sql3);

	echo "Success";

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
		
		<form action="delete.php" method="post" style="padding:20px;margin:20px;">

			Enter Storage To Delete<br><input type="text" name="DeleteS" style="padding:10px;margin:10px;"><br>
			
			<input type="submit" name="submit" style="margin:10px;">

		</form>
	</div>

</body>
</html>