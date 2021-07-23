<?php

class PlayerPDO{
    private const table='********';
    public function PlayerPDO(){
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
        $pdo = $this->PlayerPDO();
        // テーブルの名前を取得
        $table_name = self::table;
        // 入力されたテーブルから長さを取得する
        $sql = "SELECT COUNT(*) FROM ".$table_name;
        $res = $pdo->query($sql);
        $count = $res->fetchColumn();
        return $count;
    }
    
    public function GetAllData(){
        // メソッドを呼び出したインスタンスに対してPOD関数を適用
        $pdo = $this->PlayerPDO();
        // テーブルの名前を取得
        $table_name = self::table;
        // データの習得
        $sql = "SELECT Name FROM ".$table_name;
        $res = $pdo->query($sql);
        $data = $res->fetchAll();
        return $data;
    }
    
    public function GetRoomData($roomname){
        // メソッドを呼び出したインスタンスに対してPOD関数を適用
        $pdo = $this->PlayerPDO();
        // テーブルの名前を取得
        $table_name = self::table;
        // データの習得
        $sql = $pdo -> prepare("SELECT Name FROM ".$table_name." WHERE Room= :roomname");
        $sql -> bindParam(':roomname', $roomname, PDO::PARAM_STR);
        $sql -> execute();
        $data = $sql->fetchAll();
        return $data;
    }
   
    public function mkPlayer($playername, $roomname){
        // メソッドを呼び出したインスタンスに対してPOD関数を適用
        $pdo = $this->PlayerPDO();
        // テーブルの名前を取得
        $table_name = self::table;
        // SQL文を用意
        $sql = $pdo -> prepare("INSERT INTO ".$table_name." (Name, Room) VALUES (:playername, :roomname)");
        // 各変数にセット
        $sql -> bindParam(':playername', $playername, PDO::PARAM_STR);
        $sql -> bindParam(':roomname', $roomname, PDO::PARAM_STR);
        // SQLの実行
        $sql -> execute();
    }
    
    public function delPlayer($playername, $roomname){
        // メソッドを呼び出したインスタンスに対してPOD関数を適用
        $pdo = $this->PlayerPDO();
        // テーブルの名前を取得
        $table_name = self::table;
        // データの習得
        $sql = $pdo->prepare("DELETE FROM ".$table_name." WHERE Name = :name AND Room = :room");
        $sql -> bindParam(':name', $playername, PDO::PARAM_STR);
        $sql -> bindParam(':room', $roomname, PDO::PARAM_STR);
        // $sql -> bindParam(':table', $table_name, PDO::PARAM_STR);
        $sql -> execute();
    }

}

//$pdo=new PlayerPDO();
//$roomname='Novice';
//$data=$pdo->GetRoomData($roomname);
//echo var_dump($data);
















?>