<?php
session_start();
include("functions.php");
// DB
$pdo = db_connect();

$user = $_POST["user"];
$pass = $_POST["pass"];

//２．データ登録SQL作成
$sql = "SELECT * FROM user_date WHERE user=:user AND pass=:pass";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user', $user, PDO::PARAM_STR);
$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
$res = $stmt->execute();

//SQL実行時にエラーがある場合
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//３．抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法

//４. 該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["user"]   = $val['user'];
  //Login処理OKの場合select.phpへ遷移
  header("Location: play.php");
}else{
  //Login処理NGの場合login.phpへ遷移
  header("Location: index.php");
}
//処理終了
exit();
?>

