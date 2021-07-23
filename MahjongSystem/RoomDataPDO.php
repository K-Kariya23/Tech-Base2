<?php

class RoomPDO{
    private const table='********';
    public function PDO(){
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
   
    public function mkRoom($roomname, $password, $adminpassword){
        // メソッドを呼び出したインスタンスに対してPOD関数を適用
        $pdo = $this->PDO();
        // テーブルの名前を取得
        $table_name = self::table;
        // SQL文を用意
        $sql = $pdo -> prepare("INSERT INTO ".$table_name." (RoomName, Password, AdminPassword) VALUES (:roomname, :password, :adminpassword)");
        // 各変数にセット
        $sql -> bindParam(':roomname', $roomname, PDO::PARAM_STR);
        $sql -> bindParam(':password', $password, PDO::PARAM_STR);
        $sql -> bindParam(':adminpassword', $adminpassword, PDO::PARAM_STR);
        // SQLの実行
        $sql -> execute();
    }
    
    public function GetPassFromName($roomname){
        // メソッドを呼び出したインスタンスに対してPOD関数を適用
        $pdo = $this->PDO();
        // テーブルの名前を取得
        $table_name = self::table;
        // データの習得
        $sql = $pdo->prepare("SELECT Password FROM ".$table_name." WHERE RoomName = :roomname");
        $sql -> bindParam(':roomname', $roomname, PDO::PARAM_STR);
        $sql -> execute();
        $data = $sql->fetch();
        return $data;
    }
    
    public function GetAdPassFromName($roomname){
        // メソッドを呼び出したインスタンスに対してPOD関数を適用
        $pdo = $this->PDO();
        // テーブルの名前を取得
        $table_name = self::table;
        // データの習得
        $sql = $pdo->prepare("SELECT AdminPassword FROM ".$table_name." WHERE RoomName = :roomname");
        $sql -> bindParam(':roomname', $roomname, PDO::PARAM_STR);
        $sql -> execute();
        $data = $sql->fetch();
        return $data;
    }

}



















?>