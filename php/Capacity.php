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
					$sql2="SELECT * FROM `capacity` WHERE ServerNo='".$_GET['StorageNo']."'";
					$query2=mysqli_query($dbconnect,$sql2);
					$rs2=mysqli_fetch_assoc($query2);
					$diff=(int)$rs2['Max']-(int)$rs2['Capacity'];
     
    $dataPoints = array(
    	
    	array("label"=> "Free", "y"=> $diff ),
    	array("label"=> "Used", "y"=> (int)$rs2['Capacity'])
    );
    	
    ?>

<!DOCTYPE html>
<html>
<head>
	<title>Add a Server</title>

	<script>
    window.onload = function () {
     
    var chart = new CanvasJS.Chart("chartContainer", {
    	animationEnabled: true,
    	exportEnabled: true,
    	title:{
    		text: "System Capacity"
    	},
    	subtitles: [{
    		text: "Memory Utilized"
    	}],
    	data: [{
    		type: "pie",
    		showInLegend: "true",
    		legendText: "{label}",
    		indexLabelFontSize: 16,
    		indexLabel: "{label} - #percent%",
    		yValueFormatString: "฿#,##0",
    		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    	}]
    });
    chart.render();
     
    }
    </script>
</head>
<body style="font-family:Calibri;background-color:#e6faff">	
	<div>
		
	</div>
	
	<div style="width:50%;float:left;margin:25px;border:1px solid #00b8e6;border-radius:10px;height:750px;background-color:#ffffff">
		<p style="width:95.8%;background-color:#00b8e6;border:1px solid #00b8e6;border-radius:10px;margin-top:0px;padding:20px;font-size:20px;font-weight:bold;color:white">SERVER INFORMATION</p>
		<div style="width:100%;height:300px;margin:25px;">
			<div style="float:left;">
				<img src="server.jpg" style="width:60%;">
				<p style="margin-left:15%;font-size:20px;font-weight:bold;">VNEX3100</p>
			</div>
			<div style="float:left;margin:25px">
				
				<p>Name : Storage <?php echo $_GET['StorageNo'] ?></P>
				<p>Allocated Space : <?php echo $rs2['Capacity'] ?>GB</p>
				<p>Max Capactiy : <?php echo $rs2['Max'] ?>GB</p>
				<p>Software Version : 24.0.1</p>
			</div>
		</div>

		<div id="chartContainer" style="width:80%;height:300px;;text-decoration:none;margin:25px">
			
    		<script src="canvasJ.js"></script>
		</div>

	</div>
<!-- box-shadow:5px 3px 10px grey; -->

	<div style="width:40%;height:750px;float:left;border:1px solid #00b8e6; border-radius:10px;background-color:#ffffff;margin-top:25px">
		<p style="width:94.7%;background-color:#00b8e6;border:1px solid #00b8e6;border-radius:10px;margin-top:0px;padding:20px;font-size:20px;font-weight:bold;color:white">SERVER INFORMATION</p>
		<?php
			$sql="SELECT * FROM `storage` WHERE Storage='".$_GET['StorageNo']."'";
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

</body>
</html>