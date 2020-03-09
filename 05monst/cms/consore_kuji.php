<?php
// kuji
session_start();
// 関数呼び出し
include("../functions.php");
login_chek();
// DB
$pdo = db_connect();
$page=$_POST["page"];
// kuji抽出
if($page=='kuji'){
  $sql_1 = "SELECT * FROM kuji";
  $stmt_1 = $pdo->prepare($sql_1);
  $status_1= $stmt_1->execute();
  // エラー
  if($status_1==false){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt_1->errorInfo();
    exit("ErrorQuery:".$error[2]);
  }else{
    $count=0;
    while( $result = $stmt_1->fetch(PDO::FETCH_ASSOC)){
      $count++;
      // データ受け取り
      $new_name=$_POST["name_{$count}"];
      // $new_imgs=$_POST["imgs_{$count}"];
      $new_text=$_POST["text_{$count}"];
      $new_rea=$_POST["rea_{$count}"];
      if(isset($_POST["del_{$count}"])){
        $del=1;
      }else {
        $del=0;
      }
      // データ修正
      if($new_name!=$result["name"]){
        up_date('kuji',$count,'name',$new_name);
      // }else if($new_imgs!=$result["imgs"]){
      // up_date('kuji',$count,'imgs',$new_imgs);
      }else if($new_text!=$result["text"]){
        up_date('kuji',$count,'text',$new_text);
      }else if($new_rea!=$result["rea"]){
        up_date('kuji',$count,'rea',$new_rea);
      }else if($del==1){
        delete('kuji',$count);
      }
    }
  }
}else if($page=='user_date'){
  // ユーザーデータ抽出
  $sql_1 = "SELECT * FROM user_date";
  $stmt_1 = $pdo->prepare($sql_1);
  $status_1= $stmt_1->execute();
  // エラー
  if($status_1==false){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt_1->errorInfo();
    exit("ErrorQuery:".$error[2]);
  }else{
    $count=0;
    while( $result = $stmt_1->fetch(PDO::FETCH_ASSOC)){
      $count++;
      // データ受け取り
      for ($i=1; $i <=8 ; $i++) { 
        if(isset($_POST["item{$i}_{$count}"])){$new_item[$i]=1;}
        else{$new_item[$i]=0;}
      }
      $new_user=$_POST["user_{$count}"];
      $new_money=$_POST["money_{$count}"];
      $new_get=$_POST["get_{$count}"];
      $new_comp=$_POST["comp_{$count}"];
      if(isset($_POST["del_{$count}"])){
        $del=1;
      }else {
        $del=0;
      }
      // データ修正
      if($new_user!=$result["user"]){
        up_date('user_date',$count,'user',$new_user);
      }else if($new_money!=$result["money"]){
        up_date('user_date',$count,'money',$new_money);
      }else if($new_get!=$result["get"]){
        up_date('user_date',$count,'get',$new_get);
      }else if($new_comp!=$result["comp"]){
        up_date('user_date',$count,'comp',$new_comp);
      }
      // フラグアップデート
      for ($i=1; $i <=8 ; $i++) { 
        if($new_item[$i]!=$result["item{$i}"]){
          up_date('user_date',$count,"item{$i}",$new_item[$i]);
        }
      }
      // 消去
      if($del==1){
        delete('user_date',$count);
      }
    }
  }
  if(isset($_POST["user_new"])){
    $sql_2 = "INSERT INTO user_date(user)VALUES(:user)";
    $stmt_2 = $pdo->prepare($sql_2);
    $stmt_2->bindValue(':user', $_POST["user_new"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $status_2 = $stmt_2->execute();

    //４．データ登録処理後
    if($status_2==false){
      //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
      $error = $stmt_2->errorInfo();
      exit("QueryError:".$error[2]);
    }
  }
}
header("Location: console.php");
exit();
?>