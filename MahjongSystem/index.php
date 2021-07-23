<?php
session_start();
require_once('FUNCTION.php');
require_once('RoomDataPDO.php');
require_once('GameDataPDO.php');
$roompdo = new RoomPDO();
$gamepdo = new GamePDO();
//$roomname=$_GET['name'];
if (!isset($_SESSION['Room'])) logout();
$roomname=$_SESSION['Room'];

$ranking=MakeRanking($roomname) ;
$nameData=MakeRankingName($ranking);
$pointData=MakeRankingPoint($ranking);
?>

<html>
    <head>
        <title>Mahjong System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="./style.css" rel="stylesheet">
    </head>
    <body class="body">
        <div class="main">
            <!-- navbar -->
            <div class="navbar row">
                <div class="col-6">
                    <h2><?php echo $_SESSION['Room'] ?></h2>
                </div>
                <div class="col-2">
                    <a class="navbar-a" href=<?php echo "./index.php"?>>Home</a>
                </div>
                <div class="col-2">
                    <a class="navbar-a" href="./login.php">Logout</a>
                </div>
                <div class="col-2">
                    <a class="navbar-a" href=<?php echo "./EditRoom/adminlogin.php" ?>>Admin</a>
                </div>
            </div>
            <!-- Title -->
            <div class="title">
               <h1>TOP RANKER</h1>
            </div>
            <div class="crud topranker">
                <div style="position:relative; left:10px;">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
                    <canvas id="myChart"></canvas>
                    <script>
                    var ctx = document.getElementById("myChart");
                    var myChart = new Chart(ctx, {
                        type: 'horizontalBar',
                        data: {
                            labels: ["<?php echo $nameData[0] ?>", "<?php echo $nameData[1] ?>", "<?php echo $nameData[2] ?>", "<?php echo $nameData[3] ?>", "<?php echo $nameData[4] ?>"],
                            datasets: [{
                                label: 'POINT',
                                data: [Number("<?php echo $pointData[0] ?>"),Number("<?php echo $pointData[1] ?>"),Number("<?php echo $pointData[2] ?>"),Number("<?php echo $pointData[3] ?>"),Number("<?php echo $pointData[4] ?>")],
                                backgroundColor: [
                                    'rgba(250, 80, 80, 0.8)',
                                    'rgba(243, 120, 95, 0.8)',
                                    'rgba(246, 159, 142, 0.8)',
                                    'rgba(50, 50, 50, 0.8)',
                                    'rgba(90, 90, 90, 0.8)'
                                ],
                                borderColor: [
                                    'rgba(250, 80, 80, 1)',
                                    'rgba(243, 120, 95, 1)',
                                    'rgba(246, 159, 142, 1)',
                                    'rgba(50, 50, 50, 1)',
                                    'rgba(90, 90, 90, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });
                    </script>
                </div>
            </div>
            <!-- Title -->
            <div class="title">
               <h1>RECENT GAME</h1>
            </div>
            <div class="crud recentgame">
                <?php $data=GetAllGameData($roomname) ?>
                <?php $count=0 ?>
                <?php foreach ($data as $key=>$value): ?>
                    <div class="row">
                        <div class="col-3 label2">
                            <p><?php echo "GAME: 0".(count($data)-$count) ?></p>
                        </div>
                        <div class="col-1">
                            <p></p>
                        </div>
                        <div class="col-8">
                            <p><?php echo $value ?></p>
                        </div>
                    </div>
                    <?php $count++ ?>
                <?php endforeach ?>
            </div>
            <!-- Title -->
            <div class="title">
               <h1>ALL PLAYER DATA</h1>
            </div>
            <div class="crud recentgame">
                <?php $count=0 ?>
                <?php foreach ($ranking as $key=>$value): ?>
                    <div class="row">
                        <div class="col-4 label2">
                            <p><?php echo $key ?></p>
                        </div>
                        <div class="col-2">
                            <p></p>
                        </div>
                        <div class="col-6">
                            <p><strong><?php echo $value ?></strong> pt</p>
                        </div>
                    </div>
                    <?php $count++ ?>
                <?php endforeach ?>
            </div>
        </div>
    </body>
</html>











