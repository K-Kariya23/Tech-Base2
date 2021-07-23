<?php
session_start();
require_once('FUNCTION.php');
require_once('RoomDataPDO.php');
$pdo = new RoomPDO();
unset($_SESSION['Room']);
?>

<html>
    <head>
        <title>Mahjong System</title>
        <link href="./style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body class="body">
        <div class="main">
            <!-- navbar -->
            <div class="navbar">
                <h2>Mahjong System</h2>
                <a class="navbar-a" href="./MakeRoom/provisional.php">| Make New Room</a>
            </div>
            <!-- Title -->
            <div class="title">
               <h1>LOGIN</h1>
            </div>
            <!-- login from -->
            <div class="form-container container">
                <form action="" method="post">
                    <div class="form-input row">
                        <div class="col-4 label1">
                            <label>RoomName</label>
                        </div>
                        <div class="col-1 label3"></div>
                        <div class="col-7">
                            <input type="text" class="form-control input" name="roomname" value="" placeholder="Enter Your Password">
                        </div>
                    </div>
                    <div class="form-input row">
                        <div class="col-4 label2">
                            <label>Password</label>
                        </div>
                        <div class="col-1 label3"></div>
                        <div class="col-7">
                            <input type="password" class="form-control input" name="password" value="" placeholder="Enter Your Password">
                        </div>
                    </div>
                    <input class="form-btn-submit" type="submit" value="ENTER">
                </form>
            </div>
            <?php if(array_key_exists("password", $_POST)): ?>
                <p>ログインを実行します</p>
                <?php login($_POST["roomname"], $_POST["password"]) ?>
                <p>ログインに失敗しました</p>
            <?php endif ?>
        </div>
    </body>
</html>











