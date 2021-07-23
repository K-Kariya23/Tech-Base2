<?php

require_once('../FUNCTION.php');
require_once('../RoomDataPDO.php');
require_once('./PHPMailer/MailFUNCTION.php')

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
          <label>Mail</label><br>
          <input type="text" name="mail" value="" placeholder="Enter Your Email Address"><br>
          <input type="submit" value="submit">
        </form>
        <?php if(array_key_exists("mail", $_POST)): ?>
            <?php Email($_POST['mail']) ?>
        <?php endif ?>
    </body>
</html>












