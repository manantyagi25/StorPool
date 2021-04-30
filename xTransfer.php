<?php

$dbconnect=mysqli_connect("localhost","root","","vt");

$sql="SELECT * FROM `storage` WHERE Storage='".$_GET['serverNo']."'";
$query=mysqli_query($dbconnect,$sql);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Transfer</title>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">

	<style type="text/css">

		.appDiv{
			width: 90%;
			padding:3%;
			margin:auto;
			margin-bottom:2%;
			background-color:#ffffff;
			border-radius: 5px;
			height:40px;
			box-shadow: 1px 1px 1px 1px #b2b2b2;
			border-radius: 5px;
		}

		.appDivNone{
			width: 90%;
			padding:3%;
			margin:auto;
			margin-bottom:2%;
			background-color:#ffffff;
			border-radius: 5px;
			height:40px;
			text-align: center;
		}

		.app-parent{
			
			background-color:#e6e6e6;
			box-shadow: 
                0 -3em 3em rgba(0,0,0,0.1), 
                0 0  0 2px rgb(255,255,255),
                0.3em 0.3em 1em rgba(0,0,0,0.3);
            padding-top:7%;
            padding-bottom:7%;
            z-index: 1;

		}

		.appSuperParent{
			width: 30%;
			height:500px;
			float: left;
			margin: 1%;
		}

		.main-app{
			width:90%;margin: auto;
		}

		.darker {
		  position: fixed;
		  top: 15%;
		  left: -85%;
		  width: 150%;
		  height: 150%;
		  background: linear-gradient(to right, #003d99, #e600ac);
		  -webkit-transform: rotate(30deg);
		          transform: rotate(30deg);

		}

		

		body {
			font-family: 'Ubuntu', sans-serif;
			margin:0px;
		}

		h5 {
			margin: 8px;
			margin-left: 0px;
		}

		h4{
			margin-top:6%;
		}

		input{
			width:100%;
			padding:5px;
		}

	</style>
</head>
<body>

	
	<div style="width:100%;background-color:none;height:600px;margin-top:2%">

		<div class="main-app">

				<div class="appSuperParent">
					<h4>View Applications on Storage</h4>
					<div class="app-parent" >
						<?php 
						if((mysqli_num_rows($query) > 0)){
							while($rs=mysqli_fetch_assoc($query)){ ?>
								<div class="appDiv">
									<div style="width:20%;float:left"><img src="appRound.png" style="width:60%;margin-left: 2%;"></div>
									<div style="width:60%;float:left;"><h4><?php echo $rs['VMID'] ?></h4></div>
									<div style="width:20%;float:right;text-align: right;font-size: 14px;"><?php echo $rs['Capacity'] ?> GB</div>
								</div>
						<?php } 
						}

						else{?>
							<div class="appDivNone">
									<p style="color: grey;font-size: 20px;margin-top: 2%;">Nothing to Show</p>
								</div>
							</div>
								<?php
						}
						?>
					</div>
				</div>
				

				<div class="appSuperParent" >
					<h4>Add New Application</h4>
					<div class="app-parent" style="background-color: #f2f2f2" >
						<form action="xA.php" method="post" style="padding:20px;margin:20px;">

							<h5>App Name</h5><input type="text" name="VMID"><br><br>
							<input type="hidden" name="serverTo" value="<?php echo $_GET['serverNo'] ?>"><br><br>
							<h5>Application Size (GB)</h5><input type="number" name="Capacity"><br><br><br><br>
							
							<input type="submit" name="submit" value = "Add Application" style="margin-left:2%;
							background:linear-gradient(to right, #003d99 , #005ce6);
							border:none;color:#ffffff;font-size:17px;font-weight: bold;padding:10px">
					
						</form>
					</div>
				</div>

				<div class="appSuperParent" >
					<h4>Transfer Application</h4>
					<div class="app-parent" style="background-color: #f2f2f2" >

						<form action="xT.php" method="post" style="padding:20px;margin:20px;">

							<h5>App Name</h5><input type="text" name="VMID"><br><br>
							<input type="hidden" name="serverFrom" value="<?php echo $_GET['serverNo'] ?>"><br><br>
							<h5>Destination Server Number</h5><input type="number" name="serverTo">
							<br><br><br><br>
							<input type="submit" name="submit" value = "Transfer Application" style="margin-left:2%;background:linear-gradient(to right, #003d99 , #005ce6);border:none;color:#ffffff;font-size:17px;font-weight: bold;padding:10px">
							
						</form>

					</div>
				</div>
		</div>
	</div>

	<div style="text-align: center;"> 
		<a href="x.php">
			<button style="width:4.5%;position:absolute;top:0.5%;left:0.5%;border:none;background-color:#ffffff;box-shadow: 2px 2px 2px 2px grey;border-radius: 20px;">
                <img src="backNew2.jpg" style="width:100%;background-color:none;">
            </button>
		</a>
	</div>

	<div class="darker" style="z-index: -1">
		
	</div>
</body>
</html>