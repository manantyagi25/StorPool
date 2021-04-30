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
<br>
<br>
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

}
?>



	<div style="width:50%;float:left;margin:25px;border:1px solid #00b8e6;border-radius:10px;height:750px;background-color:#ffffff">
		<p style="width:95.8%;background-color:#00b8e6;border:1px solid #00b8e6;border-radius:10px;margin-top:0px;padding:20px;font-size:20px;font-weight:bold;color:white">SERVERS</p>
<?php
			$dbconnect=mysqli_connect("localhost","root","","vt");
			if(isset($_POST['serverTo']) && $_POST['serverTo']!=0){
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
		<p style="width:94.7%;background-color:#00b8e6;border:1px solid #00b8e6;border-radius:10px;margin-top:0px;padding:20px;font-size:20px;font-weight:bold;color:white">SERVER INFORMATION</p>

		<form action="AddtoStorage.php" method="post" style="padding:20px;margin:20px;">
			App Name<input type="text" name="VMID"><br>
			Storage no.(TO)<input type="number" name="serverTo" value="0"><br>
			Capacity<input type="number" name="Capacity">GB<br>
			<input type="submit" name="submit">
		</form>
	</div>