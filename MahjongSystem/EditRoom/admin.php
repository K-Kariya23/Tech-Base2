<?php
session_start();
require_once('../FUNCTION.php');
require_once('../RoomDataPDO.php');
$pdo = new RoomPDO();
//$roomname=$_GET['name'];
$roomname=$_SESSION['Room'];
?>

<html>
    <head>
        <title>Mahjong System</title>
    </head>
    <body>
        <h1>Mahjong System</h1>
        <p>make your cirle's SNS</p>
        <div class='nav-bar'>
            <ul>
                <li><a href=<?php echo "../index.php"?>>Home</a></li>
                <li><a href="../login.php">Logout</a></li>
                <li><a href=<?php "./adminlogin.php" ?>>Admin</a></li>
            </ul>
        </div>
        <!-- Admin login のページであることを明記 -->
        <p>your Room Name is <?php echo $roomname ?></p>
        <p>this page is admin page</p>
        <div>
            <h3>MENU</h3>
            <p>Select the function you want to use</p>
            <ul>
                <li><a href=<?php echo "./player.php"?>>Player</a></li>
                <li><a href=<?php echo "./game.php"?>>Game</a></li>
            </ul>
        </div>
    </body>
</html>




























