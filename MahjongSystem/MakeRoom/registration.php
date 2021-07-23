<?php

require_once('../FUNCTION.php');
require_once('../RoomDataPDO.php');
$pdo = new RoomPDO()

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
                <li><a href="../login.php">Login</a></li>
                <li><a href="#">Register</a></li>
            </ul>
        </div>
        <form action="#" method="post">
          <label>RoomName</label><br>
          <input type="text" name="roomname" value="" placeholder="Enter Your Room"><br>
          <label>Password</label><br>
          <input type="password" name="password" value="" maxlength="8" placeholder="Enter Your Password"><br>
          <label>AdminPassword</label><br>
          <input type="password" name="adminpassword" value="" maxlength="8" placeholder="Enter Your Password"><br>
          <input type="submit" value="submit">
        </form>
        <?php if(array_key_exists("roomname", $_POST)): ?>
            <?php $pdo -> mkRoom($_POST['roomname'],$_POST['password'],$_POST['adminpassword']) ?>
            <?php echo 'Roomが作成されました'?>
        <?php endif ?>
        <div>
            <h3>新規登録</h3>
            <a href="#">click here</a>
        </div>
    </body>
</html>











