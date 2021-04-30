<?php

$dbconnect=mysqli_connect("localhost","root","","vt");
$sql = "SELECT * FROM `logs` ORDER BY `id` DESC";
$query = mysqli_query($dbconnect,$sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Storage Transaction Logs</title>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
<style>
	table {
	  font-family: Ubuntu-Medium, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	td, th {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
	}

	tr:nth-child(even) {
	  background-color: #dddddd;
	}
</style>
</head>
<body>

	<h2 style="text-align: center;font-family: Ubuntu, sans-serif;font-size: 40px;">Transaction Logs</h2>
	<br>
	<div style="width: 100%;">
		<table style="width: 70%;margin: auto;">
		  <tr>
		    <th style="text-align: center;font-family: Ubuntu, sans-serif;">Date and Time</th>
		    <th style="text-align: center;font-family: Ubuntu, sans-serif;">Action Recorded</th>
		  </tr>
		  <?php
		  	while($rs2=mysqli_fetch_assoc($query)){
		  	?>
		  <tr>
		    <td style="text-align: center;font-family: Ubuntu, sans-serif;"><?php echo $rs2['datez']; ?></td>
		    <td style="font-family: Ubuntu, sans-serif;"><?php 
		    	if($rs2['type'] == "ADD"){
		    		echo "New <span style='text-decoration:underline'> Server ".$rs2['fromz']."</span> added to the network";
		    	}
		    	elseif($rs2['type'] == "DELETE"){
		    		echo "<span style='text-decoration:underline'>Server ".$rs2['fromz']."</span> deleted from the network";
		    	}
		    	elseif($rs2['type'] == "APP"){
		    		echo "New application <span style='text-decoration:underline'>".$rs2['app']."</span> added to server ".$rs2['fromz'];
		    	}
		    	elseif($rs2['type'] == "TRANSFER"){
		    		echo "<span style='text-decoration:underline'> Application ".$rs2['app']." </span> transfered from Server ".$rs2['fromz']." to Server ".$rs2['toz'];
		    	}
		     ?></td>
		  </tr>
		  <?php
		}
		?>
			<div style="text-align: center;"> 
				<a href="x.php">
					<button style="width:4%;position:absolute;top:0.5%;left:0.5%;border:none;background-color:#ffffff;box-shadow: 2px 2px 2px 2px grey;border-radius: 20px;">
		                <img src="backNew2.jpg" style="width:100%;background-color:none;">
		            </button>
				</a>
			</div>
		</table>
	</div>
</body>
</html>
