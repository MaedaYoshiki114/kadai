<?php
session_start();
$count=0;
$sum=0;
$_SESSION["kekka"]=0;
// 関数呼び出し
include("functions.php");
// DB
$pdo = db_connect();

$sql_1 = "SELECT * FROM kuji ORDER BY rea DESC";
$stmt_1 = $pdo->prepare($sql_1);
$status_1 = $stmt_1->execute();
// エラー
if($status_1==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt_1->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  // 実行文
  // レア度全体を集める
  while( $result = $stmt_1->fetch(PDO::FETCH_ASSOC)){
    $count++;
    $kuji_rea[$count] = $result["rea"];
    $kuji_id[$count] = $result["id"];
    $sum = $sum + $result["rea"];
  }
  // 抽選する
  $tyuusen = mt_rand(1,$sum);
  for ($i=1; ($i <= $count); $i++) { 
    if($tyuusen<=$kuji_rea[$i]){
      $sql_2 = "SELECT * FROM kuji WHERE id=:id";
      $stmt_2 = $pdo->prepare($sql_2);
      $stmt_2->bindValue(':id', $kuji_id[$i], PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $status_2 = $stmt_2->execute();
      // エラー
      if($status_2==false){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt_2->errorInfo();
        exit("ErrorQuery:".$error[2]);
      }else{
        // 値を送る
        $_SESSION["kekka"] = $stmt_2->fetch();
      }
    break;
    }else{
      $tyuusen=$tyuusen-$kuji_rea[$i];
    }
  }
// ユーザデータ抽出
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
  $row   = $stmt->fetch();
  $uid   = $row["id"];
  $furg  = "item";
  $money = $row["money"];
  $kekka = $_SESSION["kekka"];

  switch($kekka["id"]){
    case"1" :$furg .=1;  up_fulg($uid,$furg); break;
    case"2" :$furg .=2;  up_fulg($uid,$furg); break;
    case"3" :$furg .=3;  up_fulg($uid,$furg); break;
    case"4" :$furg .=4;  up_fulg($uid,$furg); break;
    case"5" :$furg .=5;  up_fulg($uid,$furg); break;
    case"6" :$furg .=6;  up_fulg($uid,$furg); break;
    case"7" :$furg .=7;  up_fulg($uid,$furg); break;
    case"8" :$furg .=8;  up_fulg($uid,$furg); break;
    case"9" :$furg .=9;  up_fulg($uid,$furg); break;
    case"10":$furg .=10; up_fulg($uid,$furg); break;
    default:exit;
  }
}
    $money = $money+120;
  $sql_3 = "UPDATE user_date SET total=$count,money=$money WHERE id=$uid";
  $stmt_3 = $pdo->prepare($sql_3);
  $status_3= $stmt_3->execute();
  // エラー
  if($status_3==false){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt_3->errorInfo();
    exit("ErrorQuery:".$error[2]);
  }else{
    $row = $stmt_3->fetch();
    
  }
}
header("Location: select.php");
?>

