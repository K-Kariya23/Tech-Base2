<?php
session_start();
require_once('../FUNCTION.php');
require_once('../PlayerDataPDO.php');
$pdo = new PlayerPDO();
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
        <p>this page is Edit Player page</p>
        <a href=<?php echo "./admin.php"?>> Return Admin page</a>
        <div>
            <h3>MENU</h3>
            <p>Select the function you want to use</p>
            <div class="CRUD">
                <h5>REGISTER PLAYER</h5>
                <form action="#" method="post">
                  <label>PlayerName</label><br>
                  <input type="text" name="playername" value="" placeholder="Enter Your Name"><br>
                  <input type="submit" value="submit">
                </form>
                <?php if(array_key_exists("playername", $_POST)): ?>
                    <?php
                        $pdo -> mkPlayer($_POST["playername"], $roomname); 
                        echo 'Player: '.$_POST["playername"].'が作成されました';
                    ?>
                <?php endif ?>
            </div>
            <div class="CRUD">
                <h5>DELETE PLAYER</h5>
                <form action="#" method="post">
                  <label>PlayerName</label><br>
                  <input type="text" name="dplayername" value="" placeholder="Enter Player Name"><br>
                  <input type="submit" value="submit">
                </form>
                <?php if(array_key_exists("dplayername", $_POST)): ?>
                    <?php
                        $pdo -> delPlayer($_POST["dplayername"], $roomname); 
                        echo 'Player'.$_POST["dplayername"].'が削除されました';
                    ?>
                <?php endif ?>
            </div>
            <div class="CRUD">
                <h5>PLAYER LIST</h5>
                <ul>
                    <?php foreach ($pdo -> GetRoomData($roomname) as $key => $value): ?>
                        <li><?php echo $value[0] ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </body>
</html>




























