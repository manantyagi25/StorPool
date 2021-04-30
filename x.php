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
            width:60%;
            height:500px;
            margin-left:20%;
            margin-right: 20%;
            margin-top: 0%;
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

        .popupz2{
            width:40%;
            height:200px;
            padding: 0px;
            position: absolute;
            top:0%;
            left:60%;
            border:none;
            background-color:#ffffff;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.32);
            display:none;
            border-radius: 0px 0px 0px 50px;
            z-index: 2;
        }

        .buttonAdd{
            border:none;
            position: fixed;
            top: 85%;
            left:92%;
            width:5%;
            height:76px;
            margin:0px;
            padding:0px;
            background-color:#ffffff;
            box-shadow: 
                0 -3em 3em rgba(0,0,0,0.1), 
                0 0  0 2px rgb(255,255,255),
                0.3em 0.3em 1em rgba(0,0,0,0.3);
            border-radius: 80px;
        }

        .buttonLog{
            border:none;
            position: fixed;
            top: 2%;
            left:92%;
            width:5%;
            height:76px;
            margin:0px;
            padding:0px;
            background-color:#ffffff;
            box-shadow: 
                0 -3em 3em rgba(0,0,0,0.1), 
                0 0  0 2px rgb(255,255,255),
                0.3em 0.3em 1em rgba(0,0,0,0.3);
            border-radius: 80px;
        }

        .buttonExit{
            border:none;
            width:60%;
            height:30px;
            margin:0px;
            padding:0px;
            background-color:#ffffff;
            float:right;
            margin-top:1%;
            margin-right:0%;

        }

        .buttonExit2{
            border:none;
            width:20%;
            height:30px;
            margin:0px;
            padding:0px;
            background-color:#ffffff;
            float:right;
            margin-top:1%;
            margin-right:0%;

        }

        .buttonExit3{
            border:none;
            width:5%;
            height:30px;
            margin:0px;
            padding:0px;
            background-color:#ffffff;
            float:right;
            margin-top:1%;
            margin-right:0%;

        }

        .buttonExit2 > img{
            width:20%;
        }

        .serverImage {
            width:30%;float: left;
        }

        .allServerDiv{
            width:100%;
            height:800px;
            margin-top: 2%;
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

        function displayDel(iz){
            document.getElementById('deletz').style.display = "block";
            document.getElementById('confirmz').href = "xDel.php?DeleteS="+iz;
            
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
<body style="background-image: url('back8.png');background-size:100% 100%;">

    <div style="width: 100%;height: 90px;margin-left: auto;margin-right: auto;margin-top: 1%;">
        <div style="width: 70%;">
            <h1 style="font-size: 45px;color: white;margin-left: 10%;width: 70%;">Storage Virtualization Control Panel</h1>
        </div>
        <!-- <div style="width: 30%;float: right;border: 2px solid black;">
            <h2 style="font-size: 30px;color: black;margin-right: 5%;">View Transaction Logs</h2>
        </div> -->
    </div>
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
                <div style="width:30px;height:30px;background-color:
                <?php if((int)$rs2['Capacity'] > 0) { echo "#00e600"; } else { echo "red";} ?> ;margin: auto;margin-top:70%;border-radius:100px;"></div>
            </div>
            
            <div style="width:45%;height: 100px;float: left;text-align:left;padding-left:5%">
                <a href="xTransfer.php?serverNo=<?php echo $rs2['ServerNo'] ?>" style="text-decoration: none;">
                    <h2 style="color: black;margin-bottom:3%">Server <?php echo $rs2['ServerNo'] ?></h2>
                    <p style="color: black;margin:0.5%;"><b>Used Storage</b>: <?php echo $rs2['Capacity'] ?>/<?php echo $rs2['Max'] ?> GB</p>
                    <p style="color: black;margin:0.5%;"><b>IP Address: </b><?php echo $rs2['ip'] ?></p>
                </a>
            </div>

            <div style="width:30%;height: 123px;float: left;">
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
                                        '#0040ff',
                                        '#e2e2e2'
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
                <button class="buttonExit" onclick="displayDel(<?php echo $rs2['ServerNo'] ?>)">
                    <img src="trash2.png" style="width:70%;background-color:none">
                </button>
            </div>
        </div>
            <?php }  ?>
        </div>

        <!-- THIS IS FOR ADD -->
        <div id="addz" class="popupz">
            <button class="buttonExit3" onclick="hidePop()">
                <img src="X.png" style="width:60%;background-color:none">
            </button>
            <h2 style="width:100%;text-align: center;">New Server Installation</h2>

            <div style="width:50%;float: left">
                <form action="xAdd.php" method="post" style="padding:20px;margin:20px;font-size: 20px;font-weight: bold;">
                    Enter Total Server Storage<br><br>
                    <input type="text" name="Capacity" style="padding:10px;margin:10px;">GB<br>
                    <br>
                    <input type="submit" name="submit" value="Add Server" style="width:60%;margin-left:2%;background:linear-gradient(to right, #003d99 , #005ce6);;border:none;color:#ffffff;font-size:17px;font-weight: bold;padding:10px">
                </form>
            </div>

            <div style="width:50%;float: left">
                <img src="image2.png">
            </div>
        </div>

        <!-- THIS IS FOR DELETE -->
        <div id="deletz" class="popupz2" >
            
            <p style="background-color:red;padding:20px;margin:0px;color:#ffffff;padding-left:5%;font-size:20px;">Delete Confirmation</p>

            <div style="width:80%;margin:auto;">

                <p style="color: grey">Are you sure you want to delete the server and its contents?</p>

                <div style="width:100%">
                    <a id="confirmz" style="width:wrap;padding:10px;background-color: red; text-decoration:none; color:#ffffff;border:1px solid red;border-radius:5px;float:left" href="">Confirm Delete</a>

                    <button  onclick="hideDel()" style="width:wrap;margin:0px;margin-left:5%;padding:12px;background-color: #ffffff; text-decoration:none; color:grey;border:1px solid grey;border-radius:5px;float:left">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <button class="buttonAdd" onclick="displayPop()" style="background-color: transparent;"><img src="Plus3.png" style="width:100%;"></button>

    <a href="logs.php"><button class="buttonLog" style="background-color: transparent;"><img src="log.png" style="width:80%;"></button></a>

</body>
</html>