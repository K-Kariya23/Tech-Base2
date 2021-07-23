<?php
session_start();
require_once('../FUNCTION.php');
require_once('../GameDataPDO.php');
$pdo = new GamePDO();
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
        <!-- Edit Game のページであることを明記 -->
        <p>your Room Name is <?php echo $roomname ?></p>
        <p>this page is Edit Game page</p>
        <a href=<?php echo "./admin.php"?>> Return Admin page</a>
        <div>
            <h3>MENU</h3>
            <p>Select the function you want to use</p>
            <div class="CRUD">
                <h5>REGISTER PLAYER</h5>
                <form action="#" method="post">
                  <label>Player1Name</label><br>
                  <input type="text" name="player1name" value="" placeholder="Enter Your Name"><br>
                  <label>Player1Point</label><br>
                  <input type="text" name="player1point" value="" placeholder="Enter Your Name"><br>
                  <label>Player2Name</label><br>
                  <input type="text" name="player2name" value="" placeholder="Enter Your Name"><br>
                  <label>Player2Point</label><br>
                  <input type="text" name="player2point" value="" placeholder="Enter Your Name"><br>
                  <label>Player3Name</label><br>
                  <input type="text" name="player3name" value="" placeholder="Enter Your Name"><br>
                  <label>Player3Point</label><br>
                  <input type="text" name="player3point" value="" placeholder="Enter Your Name"><br>
                  <label>Player4Name</label><br>
                  <input type="text" name="player4name" value="" placeholder="Enter Your Name"><br>
                  <input type="submit" value="submit">
                </form>
                <?php if(array_key_exists("player1name", $_POST)): ?>
                    <?php
                        $pdo -> mkGame($roomname, $_POST["player1name"], $_POST["player1point"], $_POST["player2name"], $_POST["player2point"], $_POST["player3name"], $_POST["player3point"], $_POST["player4name"]); 
                        echo 'Gameが作成されました';
                    ?>
                <?php endif ?>
            </div>
            <div class="CRUD">
                <h5>DELETE Game</h5>
                <form action="#" method="post">
                  <label>UniqueID</label><br>
                  <input type="text" name="duniqueid" value="" placeholder="Enter Uniqueid"><br>
                  <input type="submit" value="submit">
                </form>
                <?php if(array_key_exists("duniqueid", $_POST)): ?>
                    <?php
                        $pdo -> delGame($_POST["duniqueid"], $roomname); 
                        echo 'Game:'.$_POST["duniqueid"].'が削除されました';
                    ?>
                <?php endif ?>
            </div>
            <div class="CRUD">
                <h5>EDIT Game</h5>
                <form action="#" method="post">
                  <label>UniqueID</label><br>
                  <input type="text" name="euniqueid" value="" placeholder="Enter Uniqueid"><br>
                  <input type="submit" value="submit">
                </form>
                <?php if(array_key_exists("euniqueid", $_POST)): ?>
                    <?php
                    echo '編集を開始します';
                    ?>
                    <form action="#" method="post">
                      <label>UniqueID</label><br>
                      <input type="text" name="Euniqueid" value="<?php echo $_POST["euniqueid"] ?>" placeholder="Enter Uniqueid"><br>
                      <label>Player1Name</label><br>
                      <input type="text" name="eplayer1name" value="" placeholder="Enter Your Name"><br>
                      <label>Player1Point</label><br>
                      <input type="text" name="eplayer1point" value="" placeholder="Enter Your Name"><br>
                      <label>Player2Name</label><br>
                      <input type="text" name="eplayer2name" value="" placeholder="Enter Your Name"><br>
                      <label>Player2Point</label><br>
                      <input type="text" name="eplayer2point" value="" placeholder="Enter Your Name"><br>
                      <label>Player3Name</label><br>
                      <input type="text" name="eplayer3name" value="" placeholder="Enter Your Name"><br>
                      <label>Player3Point</label><br>
                      <input type="text" name="eplayer3point" value="" placeholder="Enter Your Name"><br>
                      <label>Player4Name</label><br>
                      <input type="text" name="eplayer4name" value="" placeholder="Enter Your Name"><br>
                      <input type="submit" value="submit">
                    </form>
                <?php endif ?>
                <?php if(array_key_exists("eplayer1name", $_POST)): ?>
                    <?php
                    $pdo -> upGame($_POST["Euniqueid"], $roomname, $_POST["eplayer1name"], $_POST["eplayer1point"], $_POST["eplayer2name"]); 
                    echo 'Gameが編集されました';
                    ?>
                <?php endif ?>
            </div>
            <div class="CRUD">
                <h5>GAME LIST</h5>
                <ul>
                    <?php $data=GetAllGameDataAdmin($roomname) ?>
                    <?php foreach ($data as $key=>$value): ?>
                        <li><?php echo $value ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </body>
</html>




























