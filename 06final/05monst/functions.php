<?php
//共通で使うものを別ファイルにしておきましょう。
// DBに接続
function db_connect(){
  try {
    $pdo = new PDO('mysql:dbname=monsto;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
  return $pdo;
}
// ログイン
function login_chek(){
  if( !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
    echo "ログインエラー","<br>";
    exit();
  }else{
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
  }
}
// アップデート
function up_fulg($uid,$flug){
  try {
    $pdo = new PDO('mysql:dbname=monsto;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
  $sql = "UPDATE user_date SET $flug='1' WHERE id=$uid";
    $stmt = $pdo->prepare($sql);
    // $stmt->bindValue(':user', $row["id"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    // $stmt->bindValue(':flug', $flug, PDO::PARAM_STR);
    $status= $stmt->execute();
    if($status==false){
      //execute（SQL実行時にエラーがある場合）
      $error = $stmt->errorInfo();
      exit("ErrorQuery:".$error[2]);
    }
  }

  function up_date($table,$id,$tg,$new){
    try {
      $pdo = new PDO('mysql:dbname=monsto;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
      exit('DbConnectError:'.$e->getMessage());
    }
    if($table=="kuji" && $tg=="name"){
      $sql = "UPDATE kuji SET name=:new WHERE id=:id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    // }else if($table=="kuji" && $tg=="imgs"){
    //   $sql = "UPDATE kuji SET imgs=:new WHERE id=:id";
    //   $stmt = $pdo->prepare($sql);
    //   $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
    //   $stmt->bindValue(':tg', $tg, PDO::PARAM_STR);
    //   $stmt->bindValue(':new', $new, PDO::PARAM_STR);
    //   $status= $stmt->execute();
    //   if($status==false){
    //     //execute（SQL実行時にエラーがある場合）
    //     $error = $stmt->errorInfo();
    //     exit("ErrorQuery:".$error[2]);
    //   }
    }else if($table=="kuji" && $tg=="text"){
      $sql = "UPDATE kuji SET text=:new WHERE id=:id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    }else if($table=="kuji" && $tg=="rea"){
      $sql = "UPDATE kuji SET rea=:new WHERE id=:id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    }else if($table=="user_date"&&$tg=="user"){
      $sql = 'UPDATE user_date SET user=:new WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    }else if($table=="user_date"&&$tg=="money"){
      $sql = 'UPDATE user_date SET money=:new WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    }else if($table=="user_date"&&$tg=="item1"){
      $sql = 'UPDATE user_date SET item1=:new WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
      //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    }else if($table=="user_date"&&$tg=="item2"){
      $sql = 'UPDATE user_date SET item2=:new WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    }else if($table=="user_date"&&$tg=="item3"){
      $sql = 'UPDATE user_date SET item3=:new WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    }else if($table=="user_date"&&$tg=="item4"){
      $sql = 'UPDATE user_date SET item4=:new WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    }else if($table=="user_date"&&$tg=="item5"){
      $sql = 'UPDATE user_date SET item5=:new WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    }else if($table=="user_date"&&$tg=="item6"){
      $sql = 'UPDATE user_date SET item6=:new WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    }else if($table=="user_date"&&$tg=="item7"){
      $sql = 'UPDATE user_date SET item7=:new WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    }else if($table=="user_date"&&$tg=="item8"){
      $sql = 'UPDATE user_date SET item8=:new WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    }else if($table=="user_date"&&$tg=="get"){
      $sql = 'UPDATE user_date SET get=:new WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    }else if($table=="user_date"&&$tg=="comp"){
      $sql = 'UPDATE user_date SET comp=:new WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':new', $new, PDO::PARAM_STR);
      $status= $stmt->execute();
      if($status==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }
    }
  }

function delete($table,$id){
  try {
    $pdo = new PDO('mysql:dbname=monsto;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
  if($table==kuji){
    $sql = 'DELETE FROM kuji WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);    //更新したいidを渡す
    $status = $stmt->execute();
    //４．データ登録処理後
    if($status==false){
      //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
      $error = $stmt->errorInfo();
      exit("QueryError:".$error[2]);
    }
  }else if($table==user_date){
    $sql = 'DELETE FROM user_date WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);    //更新したいidを渡す
    $status = $stmt->execute();
    //４．データ登録処理後
    if($status==false){
      //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
      $error = $stmt->errorInfo();
      exit("QueryError:".$error[2]);
    }
  }
}
?>