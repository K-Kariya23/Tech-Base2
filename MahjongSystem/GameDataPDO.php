<?php

class GamePDO{
    private const table='********';
    public function GamePDO(){
        // DB接続設定
        $dsn = "********";
        $user = "********";
        $password = "********";
        try{
            $pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        }catch(Exception $e){
          echo 'error' .$e->getMesseage;
          die();
        }
        //エラーを表示してくれる。
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        return $pdo;
    }
    
    public function GetDataLen(){
        // メソッドを呼び出したインスタンスに対してPOD関数を適用
        $pdo = $this->GamePDO();
        // テーブルの名前を取得
        $table_name = self::table;
        // 入力されたテーブルから長さを取得する
        $sql = "SELECT COUNT(*) FROM ".$table_name;
        $res = $pdo->query($sql);
        $count = $res->fetchColumn();
        return $count;
    }
    
    public function GetMaxID($roomname){
        // メソッドを呼び出したインスタンスに対してPOD関数を適用
        $pdo = $this->GamePDO();
        // テーブルの名前を取得
        $table_name = self::table;
        // データの習得
        $sql = $pdo->prepare("SELECT id FROM ".$table_name." WHERE Room = :roomname");
        $sql -> bindParam(':roomname', $roomname, PDO::PARAM_STR);
        $sql -> execute();
        $data = $sql->fetchAll();
        $max_id=0;  //初期値
        $id=0;      // 初期値
        foreach ($data as $key=>$value){
            $id=$value["id"];
            if ($id > $max_id){
                $max_id=$id;
            }
        }
        return $max_id; //最大のIDをreturn
    }
    
    public function mkGame($roomname ,$player1name, $player1point, $player2name, $player2point, $player3name, $player3point, $player4name){
        echo '関数を実行します';
        //Player4のpointを計算
        $player4point=100000-intval($player1point)-intval($player2point)-intval($player3point);
        echo $player4point;
        // メソッドを呼び出したインスタンスに対してPOD関数を適用
        $pdo = $this->GamePDO();
        // テーブルの名前を取得
        $table_name = self::table;
        // uniqueidを作成
        $length=$this->GetMaxID($roomname);
        $uniqueid=$roomname.strval($length+1);
        // SQL文を用意
        $sql = $pdo -> prepare("INSERT INTO ".$table_name." (Room, Uniqueid ,Player1name, Player1point, Player2name, Player2point, Player3name, Player3point, Player4name, Player4point) VALUES (:roomname, :uniqueid ,:player1name, :player1point,:player2name, :player2point, :player3name, :player3point, :player4name, :player4point)");
        // 各変数にセット
        $sql -> bindParam(':roomname', $roomname, PDO::PARAM_STR);
        $sql -> bindParam(':uniqueid', $uniqueid, PDO::PARAM_STR);
        $sql -> bindParam(':player1name', $player1name, PDO::PARAM_STR);
        $sql -> bindParam(':player1point', $player1point, PDO::PARAM_INT);
        $sql -> bindParam(':player2name', $player2name, PDO::PARAM_STR);
        $sql -> bindParam(':player2point', $player2point, PDO::PARAM_INT);
        $sql -> bindParam(':player3name', $player3name, PDO::PARAM_STR);
        $sql -> bindParam(':player3point', $player3point, PDO::PARAM_INT);
        $sql -> bindParam(':player4name', $player4name, PDO::PARAM_STR);
        $sql -> bindParam(':player4point', $player4point, PDO::PARAM_INT);
        // SQLの実行
        $sql -> execute();
    }

    public function GetDataAdmin($roomname){
        // メソッドを呼び出したインスタンスに対してPOD関数を適用
        $pdo = $this->GamePDO();
        // テーブルの名前を取得
        $table_name = self::table;
        // データの習得
        $sql = $pdo->prepare("SELECT Uniqueid Player1name, Player1point, Player2name, Player2point, Player3name, Player3point, Player4name, Player4point FROM ".$table_name." WHERE Room = :roomname");
        $sql -> bindParam(':roomname', $roomname, PDO::PARAM_STR);
        $sql -> execute();
        $data = $sql->fetchAll();
        return $data;
    }
    
    public function GetData($roomname){
        // メソッドを呼び出したインスタンスに対してPOD関数を適用
        $pdo = $this->GamePDO();
        // テーブルの名前を取得
        $table_name = self::table;
        // データの習得
        $sql = $pdo->prepare("SELECT Player1name, Player1point, Player2name, Player2point, Player3name, Player3point, Player4name, Player4point FROM ".$table_name." WHERE Room = :roomname");
        $sql -> bindParam(':roomname', $roomname, PDO::PARAM_STR);
        $sql -> execute();
        $data = $sql->fetchAll();
        return $data;
    }
    
    public function delGame($uniqueid, $roomname){
        // メソッドを呼び出したインスタンスに対してPOD関数を適用
        $pdo = $this->GamePDO();
        // テーブルの名前を取得
        $table_name = self::table;
        // データの習得
        $sql = $pdo->prepare("DELETE FROM ".$table_name." WHERE Uniqueid = :uniqueid AND Room = :room");
        $sql -> bindParam(':uniqueid', $uniqueid, PDO::PARAM_STR);
        $sql -> bindParam(':room', $roomname, PDO::PARAM_STR);
        // $sql -> bindParam(':table', $table_name, PDO::PARAM_STR);
        $sql -> execute();
    }
    public function upGame($uniqueid, $roomname, $player1name, $player1point, $player2name, $player2point, $player3name, $player3point, $player4name){
        //Player4のpointを計算
        $player4point=100000-intval($player1point)-intval($player2point)-intval($player3point);
        // メソッドを呼び出したインスタンスに対してPOD関数を適用
        $pdo = $this->GamePDO();
        // テーブルの名前を取得
        $table_name = self::table;
        $sql = $pdo->prepare("UPDATE ".$table_name." SET Player1name= :player1name, Player1point= :player1point, Player2name= :player2name, Player2point= :player2point, Player3name= :player3name, Player3point= :player3point, Player4name= :player4name, Player4point= :player4point WHERE Uniqueid = :uniqueid AND Room = :roomname");
        // 各変数にセット
        $sql -> bindParam(':uniqueid', $uniqueid, PDO::PARAM_STR);
        $sql -> bindParam(':roomname', $roomname, PDO::PARAM_STR);
        $sql -> bindParam(':player1name', $player1name, PDO::PARAM_STR);
        $sql -> bindParam(':player1point', $player1point, PDO::PARAM_INT);
        $sql -> bindParam(':player2name', $player2name, PDO::PARAM_STR);
        $sql -> bindParam(':player2point', $player2point, PDO::PARAM_INT);
        $sql -> bindParam(':player3name', $player3name, PDO::PARAM_STR);
        $sql -> bindParam(':player3point', $player3point, PDO::PARAM_INT);
        $sql -> bindParam(':player4name', $player4name, PDO::PARAM_STR);
        $sql -> bindParam(':player4point', $player4point, PDO::PARAM_INT);
        // SQLの実行
        $sql -> execute();
    }
}


















?>