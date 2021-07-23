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
                <li><a href=<?php "./EditRoom/adminlogin.php" ?>>Admin</a></li>
            </ul>
        </div>
        <!-- Admin login のページであることを明記 -->
        <p>your Room Name is <?php echo $roomname ?></p>
        <p>this page is admin login form</p>
        <!-- login from -->
        <form action="" method="post">
          <label>Password</label><br>
          <input type="password" name="adminpassword" value="" placeholder="Enter Your Password">
          <input type="submit" value="submit">
        </form>
        <?php if(array_key_exists("adminpassword", $_POST)): ?>
            <p>ログインを実行します</p>
            <?php Adminlogin($roomname, $_POST["adminpassword"]) ?>
            <p>ログインに失敗しました</p>
        <?php endif ?>
        <div>
    </body>
</html>










