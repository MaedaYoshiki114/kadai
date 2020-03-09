<?php
session_start();
include("functions.php");
login_chek();
// DB
$pdo = db_connect();

$kekka=$_SESSION["kekka"];
if($kekka["rea"]==5){
  $rea = "☆☆☆☆☆";
}else if($kekka["rea"]==4){
  $rea = "☆☆☆☆☆";
}
switch($kekka["rea"]){
  case "1": $rea = "★★★★";break;
  case "2": $rea = "★★★";break;
  case "3": $rea = "★★";break;
  case "4": $rea = "★";break;
  case "5": $rea = "☆";break;
  default: exit;
}

$sql = "SELECT * FROM user_date WHERE user=:user";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user', $_SESSION["user"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status= $stmt->execute();
// エラー
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  $row = $stmt->fetch();
  $uid = $row["id"];
  $furg = "item";

  switch($kekka["id"]){
    case"1" :$furg .=1;  up_fulg($uid,$furg);break;
    case"2" :$furg .=2;  up_fulg($uid,$furg);break;
    case"3" :$furg .=3;  up_fulg($uid,$furg);break;
    case"4" :$furg .=4;  up_fulg($uid,$furg);break;
    case"5" :$furg .=5;  up_fulg($uid,$furg);break;
    case"6" :$furg .=6;  up_fulg($uid,$furg);break;
    case"7" :$furg .=7;  up_fulg($uid,$furg);break;
    case"8" :$furg .=8;  up_fulg($uid,$furg);break;
    case"9" :$furg .=9;  up_fulg($uid,$furg);break;
    case"10":$furg .=10; up_fulg($uid,$furg);break;
    default:exit;
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ガチャ結果</title>
<link rel="stylesheet" href="css/reset.css">
<link href="css/select.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
  <!-- テキスト表示 -->
<h1><?=$kekka["text"]?></h1>

<div class="kekka">
<img src="img/<?=$kekka["imgs"]?>" alt="">
</div>
<dl>
  <dt>図鑑.No</dt>
  <dd id="id"><?=$kekka["id"]?></dd>
  <dt>レア度</dt>
  <dd id="rea"><?=$rea?></dd>
</dl>
<p><a href="play.php">TOPへ戻る</a></p>
  <!-- 戻るボタン -->
  <div id="back"><a href="../index.php">戻る</a></div>
</body>
</html>
