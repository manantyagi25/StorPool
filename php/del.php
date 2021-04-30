<?php
    // include("nav.php");
    $dbconnect=mysqli_connect("localhost","root","","vt");
    $sql2="SELECT * FROM `capacity`";
    $query2=mysqli_query($dbconnect,$sql2);

?>

<!DOCTYPE html>
<html>
<head>
	<title>ADD Server</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <script src="Chart.js"></script>
    <script src="jQuery.js"></script>

	<style>
        .serverBlock {
            box-shadow: 
                0 -3em 3em rgba(0,0,0,0.1), 
                0 0  0 2px rgb(255,255,255),
                0.3em 0.3em 1em rgba(0,0,0,0.3);
            width:15%;
            height:350px;
            margin:2%;
            margin-top: 1%;
            margin-bottom: 1%;
            float: left;
            text-align: center;
            }

        .popupz{
        	width:80%;
        	height:700px;
        	margin-left:10%;
        	margin-right:10%;
        	border:1px solid #ffffff; 
        	border-radius:10px;
        	position: absolute;
        	background-color:#ffffff;
        	box-shadow: 
                0 -3em 3em rgba(0,0,0,0.1), 
                0 0  0 2px rgb(255,255,255),
                0.3em 0.3em 1em rgba(0,0,0,0.3);
            display:none;
        }

        .buttonAdd{
        	border:none;
        	
        	width:5%;
        	height:80px;
        	margin:0px;
        	padding:0px;
        	background-color:green;
            box-shadow: 50px 50px 5px black;
            border-radius: 1000px;
        }

        .buttonExit{
        	border:none;
        	width:4%;
        	height:30px;
        	margin:0px;
        	padding:0px;
        	background-color:#ffffff;
        	float:right;
        	margin-top:1%;
        	margin-right:0%;

        }

        .serverImage {
        	width:30%;float: left;
        }

        .allServerDiv{
        	width:100%;
        	height:800px
        }

        .allServerDiv-child{
        	width:95%;
        	margin:auto;
        }

        .serverInfo{
        	width:70%;
            height:300px;
        	float: left;
        }

        body{
            margin:0px;
            font-family: 'Ubuntu', sans-serif;
        }

    </style>

    <script type="text/javascript">
    	
    	function displayPop(){
    		document.getElementById('addz').style.display = "block";
    	}

    	function hidePop(){
    		document.getElementById('addz').style.display = "none";
    	}

    	function displayDel(){
    		document.getElementById('deletz').style.display = "block";
    	}

    	function hideDel(){
    		document.getElementById('deletz').style.display = "none";
    	}

    	function displayMod(){
    		document.getElementById('modz').style.display = "block";
    	}

    	function hideMod(){
    		document.getElementById('modz').style.display = "none";
    	}
    </script>
</head>

<!-- <body background="back.png"> -->
<!-- <body style="background-image: linear-gradient(#4568dc, #b06ab3);"> -->
<body style="background-image: url('back1.jpg');background-size:100% 100%">
    <div class="allServerDiv">
    	<!-- THIS IS FOR SHOWING ALL SERVERS -->
    	<div class="allServerDiv-child">
    		<?php while($rs2=mysqli_fetch_assoc($query2)){ ?>
    			<div style="background-color:#ffffff;width: 45%;height: 120px;text-align: center;float:left;margin: 1%;box-shadow: 
                0 -3em 3em rgba(0,0,0,0.1), 
                0 0  0 2px rgb(255,255,255),
                0.3em 0.3em 1em rgba(0,0,0,0.3);
            ">
            <div style="background-color:#f2f2f2;width:10%;height: 100px;float: left;height:120px">
                <div style="width:30px;height:30px;background-color:#00e600;margin: auto;margin-top:70%;border-radius:100px;"></div>
            </div>
            
            <div style="width:45%;height: 100px;float: left;text-align:left;padding-left:5%">
                <a href="xTransfer.php?serverNo=<?php echo $rs2['ServerNo'] ?>" style="text-decoration: none;">
                    <h2 style="color: black;margin-bottom:3%">SERVER <?php echo $rs2['ServerNo'] ?></h2>
                    <p style="color: grey;margin:0.5%;">CAPACITY: 20/100 GB</p>
                    <p style="color: grey;margin:0.5%;">IP ADDRESSS:172.168.1.16</p>
                </a>
            </div>

            <div style="width:30%;height: 100px;float: left;">
                <canvas id="<?php echo $rs2['ServerNo'] ?>" style="margin-top: 10%;width:90%;height:90%">
                            <script>
                                var ctx = document.getElementById("<?php echo $rs2['ServerNo'] ?>");
                                var myChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: ['Used', 'Remaining'],
                                    datasets: [{
                                      label: 'Storage Space',
                                      data: [<?php echo $rs2['Capacity'] ?>, <?php echo (((int)$rs2['Max'])-((int)$rs2['Capacity'])) ?>],
                                      backgroundColor: [
                                        // '#00ffff',
                                        // '#1f1f7a',
                                        '#FBBC05',
                                        '#34B7F1'
                                      ],
                                      borderWidth: 1
                                    }]
                                  },
                                  options: {
                                    cutoutPercentage: 80,
                                    responsive: false,
                                    circumference: Math.PI,
                                    rotation:Math.PI,
                                    title: {
                                        display: true,
                                        text: 'Memory Usage',
                                        fontColor: 'black',
                                        position: 'bottom'
                                    },

                                    legend:{
                                        display: false
                                    }
                                    }
                                });
                            </script>
                        </canvas>
            </div>

            <div style="width:10%;height: 100px;float: left;">
                <a href="xDel.php?DeleteS=<?php echo $rs2['ServerNo'] ?>">
                    <img src="DeleteT.png" style="float:right;width:40%;margin-left: 2%;">
                </a>
            </div>
        </div>
    		<?php }	 ?>
    	</div>

    	<!-- THIS IS FOR ADD -->
    	<div id="addz" class="popupz">
    		<button class="buttonExit" onclick="hidePop()"><img src="Add.png" style="width:60%;"></button>
    		<p style="width:94.7%;background-color:#00b8e6;border:1px solid #00b8e6;border-radius:10px;margin-top:0px;padding:20px;font-size:20px;font-weight:bold;color:white">SERVER INFORMATION</p>
    		<form action="xAdd.php" method="post" style="padding:20px;margin:20px;">

    			Enter Max Capacity<br><input type="text" name="Capacity" style="padding:10px;margin:10px;">GB<br>
    			
    			<input type="submit" name="submit" style="margin:10px;">
    		</form>
    	</div>

    	<!-- THIS IS FOR DELETE -->
    	<div id="deletz" class="popupz">
    		<button class="buttonExit" onclick="hideDel()"><img src="Add.png" style="width:60%;"></button>
    		<p style="width:94.7%;background-color:#00b8e6;border:1px solid #00b8e6;border-radius:10px;margin-top:0px;padding:20px;font-size:20px;font-weight:bold;color:white">DELETE SERVER</p>
    		<form action="X.php" method="post" style="padding:20px;margin:20px;">
    			Enter Storage To Delete<br><input type="text" name="DeleteS" style="padding:10px;margin:10px;"><br>
    			<input type="submit" name="submit" style="margin:10px;">
    		</form>
    	</div>

    </div>

    <div style="width: 100px;height: 100px;background-color: green;position: fixed;
            top: 85%;
            left:92%;">
        
    </div>
    <button class="buttonAdd" onclick="displayPop()" ><img src="Plus2.png" style="width:100%;"></button>
</body>
</html>