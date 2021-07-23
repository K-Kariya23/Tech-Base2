<?php
require_once('RoomDataPDO.php');
require_once('PlayerDataPDO.php');
require_once('GameDataPDO.php');

function login($roomname, $password){
    $pdo = new RoomPDO();
    //echo $password;
    $Tpassword=$pdo -> GetPassFromName($roomname);
    //echo $Tpassword[0];
    if ($Tpassword[0] == $password){
        session_start();
        $_SESSION['Room'] = $roomname;
        header('Location: index.php');
    }else{
        return 0;
    }
}
function logout(){
    header('Location: login.php');
}

function Adminlogin($roomname, $password){
    $pdo = new RoomPDO();
    //echo $password;
    $Tpassword=$pdo -> GetAdPassFromName($roomname);
    //echo $Tpassword[0];
    if ($Tpassword[0] == $password){
        header('Location: admin.php');
    }else{
        return 0;
    }
}

function GetAllGameDataAdmin($roomname){
    $pdo = new GamePDO(); // データベースに接続する
    $data=$pdo -> GetDataAdmin($roomname); // Class GamePDO のクラス内関数を利用してデータを受け取る
    $Arr=array();
    $Count=0;
    $i=0;
    for ($i; $i<count($data); $i++){
        $arr='Game '.strval(count($data)-$i).': ';
        $count=0;
        $datai=$data[$i];
        //echo var_dump($datai);
        foreach ($datai as $key=>$value){
            if ($count % 2 == 0){
                $arr=$arr.$value.' ';
            }
            $count+=1;
        }
        $Count+=1;
        $Arr[$Count]=$arr;
    }
    return $Arr;
}

function GetAllGameData($roomname){
    $pdo = new GamePDO(); // データベースに接続する
    $data=$pdo -> GetData($roomname); // Class GamePDO のクラス内関数を利用してデータを受け取る
    $Arr=array();
    $Count=0;
    $i=0;
    for ($i; $i<count($data); $i++){
        $arr='';
        $count=0;
        $datai=$data[$i];
        //echo var_dump($datai);
        foreach ($datai as $key=>$value){
            if ($count % 2 == 0){
                $arr=$arr.$value.' ';
            }
            $count+=1;
        }
        $Count+=1;
        $Arr[$Count]=$arr;
    }
    return $Arr;
}

function MakeRanking($roomname){
    $Ppdo = new PlayerPDO(); //データベースに接続
    $Gpdo = new GamePDO();   //今回はゲームの情報とプレイヤーの情報を両方使うのでオブジェクトを分ける
    $pdata=$Ppdo->GetRoomData($roomname); //プレイヤーの名前を全検索し配列を作成
    $players=array();
    foreach ($pdata as $key => $value){
        $players[]=$value["Name"];
    }
    //echo var_dump($players);
    $gdata=$Gpdo->GetData($roomname); //ゲームのデータを全検索し配列を作成(UniqueIDは使わない)
    $summary=array();
    //echo var_dump($gdata);
    foreach ($players as $key => $value){                     //全プレイヤーを検索
        $point=0;
        foreach ($gdata as $k => $v){ //ゲームに対象がいるか確認
            if ($v["Player1name"] == $value){
                $point+=$v["Player1point"]; //Player1pointを追加
            } elseif ($v["Player2name"] == $value){
                $point+=$v["Player2point"]; //Player2pointを追加
            } elseif ($v["Player3name"] == $value){
                $point+=$v["Player3point"]; //Player3pointを追加
            } elseif ($v["Player4name"] == $value){
                $point+=$v["Player4point"]; //Player4pointを追加
            }
        }
        $summary+=array($value=>$point);
    }
    //echo var_dump($summary);
    arsort($summary);
    echo var_dump($summary);
    return $summary;
}

function MakeRankingName($summary){
    $nameData=array();
    foreach ($summary as $key=>$value){
        //echo $key;
        $nameData[]=$key;
    }
    return $nameData;
}

function MakeRankingPoint($summary){
    $pointData=array();
    foreach ($summary as $key=>$value){
        $pointData[]=$value;
    }
    return $pointData;
}









?>