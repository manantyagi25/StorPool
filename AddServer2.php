<?php
include("nav.php");

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
<!DOCTYPE html>
<html>
<head>
	<title>Add Server</title>

	<style>
        .serverBlock {
            box-shadow: 
                0 -3em 3em rgba(0,0,0,0.1), 
                0 0  0 2px rgb(255,255,255),
                0.3em 0.3em 1em rgba(0,0,0,0.3);
            width:40%;
            height:190px;
            margin:2%;
            margin-top: 1%;
            margin-bottom: 1%;
            float: left;
            }
        </style>
</head>
<body style="width:100%;">
	<div style="width: 80%;">
		<?php

			$dbconnect=mysqli_connect("localhost","root","","vt");
			$sql2="SELECT * FROM `capacity`";
			$query2=mysqli_query($dbconnect,$sql2);
		
			while($rs2=mysqli_fetch_assoc($query2)){
				?>
<!-- 				<a href="Capacity.php?StorageNo=<?php echo $rs2['ServerNo'] ?>">
 -->					
					<div class="serverBlock">
		                <div style="width:30%;float: left;">
		                    <img src="server.png" width="70%">
		                </div>

		                <div style="width:70%;float: left;">
		                    <h3>NAME: SERVER <?php echo $rs2['ServerNo'] ?></h3>
		                    <h3>CAPACITY: 1/10GB</h3>
		                    <div style="width: 99%;">
		                        <img src="Delete.png" style="float:right;width:10%;margin-left: 2%;">
		                        <img src="Modify.png" style="float:right;width:10%">
		                    </div>
		                </div>
		            </div>
<!-- 				</a>
 -->					<?php
				}

		 ?>

	</div>

	<!-- <div style="width:40%;height:750px;float:left;border:1px solid #00b8e6; border-radius:10px;background-color:#ffffff;margin-top:25px">
		<p style="width:94.7%;background-color:#00b8e6;border:1px solid #00b8e6;border-radius:10px;margin-top:0px;padding:20px;font-size:20px;font-weight:bold;color:white">SERVER INFORMATION</p>
		
		<form action="AddServer.php" method="post" style="padding:20px;margin:20px;">

			Enter Max Capacity<br><input type="text" name="Capacity" style="padding:10px;margin:10px;">GB<br>
			
			<input type="submit" name="submit" style="margin:10px;">
	
		</form>
	</div>
 -->
</body>
</html>