<?php
session_start();
include("functions.php");
login_chek();
$pdo = db_connect();


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
  $row = $stmt->fetch();
  $JSONudate=json_encode( $row );
}
// kuji抽出
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
  $get=0;
  $total=$row["total"];
  while( $result = $stmt_1->fetch(PDO::FETCH_ASSOC)){
    $count++;
    $tg=$row["item{$count}"];
    if($tg==1){
      $pass  = "img/";
      $pass .= $result["imgs"];
      $img[] = $pass;
      $get++;
    }
  }
  $uid=$row["id"];
  $comp  = $get / $total * 100;
  $sql_3 = "UPDATE user_date SET comp=$comp WHERE id=$uid";
  $stmt_3 = $pdo->prepare($sql_3);
  $status_3= $stmt_3->execute();
  // エラー
  if($status_3==false){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt_3->errorInfo();
    exit("ErrorQuery:".$error[2]);
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>モーニングストライキ</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/play.css">
  <link rel="stylesheet" href="css/style.css">
</head>


<body>
<div class="bg">
  <div class="top">
    <p id = "corection">コレクション</p>
<dl>
  <!-- ステータス -->
  <div class="status">
    <dt><img src="img/user.png" alt="ユーザ"></dt>
    <dd id ="user"><?=$row["user"]?>  さん</dd>
  </div>
  <div class="status">
    <dt><img src="img/money.png" alt="お金"></dt>
    <dd id ="money"><?=$row["money"]?></dd>
  </div>
</dl>
<!-- コレクション -->
<div class="colle_view" style="display: none;">
  <dl class="comp_w">
    <dt>達成率</dt>
    <dd id = comp><?=$row["comp"]?>%</dd>
  </dl>
  <ul class = comp_imgs>
    <li id = "img0"><img src="<?=$img[0]?>" alt=""></li>
    <li id = "img1"><img src="<?=$img[1]?>" alt=""></li>
    <li id = "img2"><img src="<?=$img[2]?>" alt=""></li>
    <li id = "img3"><img src="<?=$img[3]?>" alt=""></li>
    <li id = "img4"><img src="<?=$img[4]?>" alt=""></li>
    <li id = "img5"><img src="<?=$img[5]?>" alt=""></li>
    <li id = "img6"><img src="<?=$img[6]?>" alt=""></li>
    <li id = "img7"><img src="<?=$img[7]?>" alt=""></li>
  </ul>
</div>
  </div>
  <div class="kuji" style="display: none;">
  <!-- ここにガチャの結果が表示される -->
  </div>
</div>
  <!-- 戻るボタン -->
  <div id="back"><a href="../index.php">戻る</a></div>


  <!-- jsへ受け渡し -->
  <script type="text/javascript">
  var udate  = JSON.parse('<?php echo $JSONudate; ?>');
  </script>
  <!-- 引くボタン -->
<p id="btn_w"><a id="try_btn" href="tyuusen.php">ガチャを引く</a></p>
<!-- js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/play.js"></script>
</body>