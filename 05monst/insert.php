<?php
//1. POSTデータ取得
include("functions.php");
//まず前のphpからデーターを受け取る（この受け取ったデータをもとにbindValueと結びつけるため）
$user = $_POST["user"];
$pass = $_POST["pass"];

//2. DB接続します xxxにDB名を入力する
//ここから作成したDBに接続をしてデータを登録します xxxxに作成したデータベース名を書きます
$pdo = db_connect();


//３．データ登録SQL作成 //ここにカラム名を入力する
//xxx_table(テーブル名)はテーブル名を入力します
$stmt = $pdo->prepare("INSERT INTO user_date(id, user, pass )
VALUES(NULL, :user,:pass)");
$stmt->bindValue(':user', $user, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト 書くときにLocation: in この:　のあとは半角スペースがいるので注意！！
  header("Location: play.php");
  exit;

}
?>
