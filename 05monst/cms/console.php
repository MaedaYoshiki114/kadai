<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ガチャDB</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="css/consore.css">
  <!-- <link rel="stylesheet" href="../css/style.css"> -->
</head>
<body>
  <?php
  // データ取得 書き込み
  $view="";
  session_start();
  // 関数呼び出し
  include("../functions.php");
  login_chek();
  // DB
  $pdo = db_connect();
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
    while( $result = $stmt_1->fetch(PDO::FETCH_ASSOC)){
      $count++;
      $view .= "<dd class= 'id'  >{$count}</dd>";
      $view .= "<dd class= 'name'><input type='text' name='name_{$count}' value={$result['name']} class='in_id inp'></dd>";
      // $view .= "<dd class= 'imgs'><input type='file' name='imgs_{$count}' value{$result['imgs']}  class='cms-item inp' accept='image/*'></dd>";
      $view .= "<dd class= 'text'><input type='text' name='text_{$count}' value={$result['text']} class='in_text inp'></dd>";
      $view .= "<dd class= 'rea' ><input type='text' name='rea_{$count}' value={$result['rea']} class='in_rea inp'></dd>";
      $view .= "<dd class= 'del' ><input type='button' name='del{$count}' value='消去'></dd>";
    }
  }
  ?>
  <form action="consore_kuji.php" method="post" enctype="multipart/form-data">
<!-- 切り替えタブ -->
  <ul>
      <li><a href="console.php">ガチャ</a></li>
      <li><a href="console_user.php">ユーザー</a></li>
      <li><a href="../index.php">EXIT</a></li>
      <li><input type="submit" name="tab" value="送信"></li>
    </ul>
  <dl>
    <!-- ラベル -->
    <dt class= "id"  >ID</dt>
    <dt class= "name">No.</dt>
    <!-- <dt class= "imgs">画像</dt> -->
    <dt class= "text">タイトル</dt>
    <dt class= "rea" >排出率</dt>
    <dt class= "del" >消去</dt>
    <?=$view?>
  </dl>
  <input type="hidden" name="page" value='kuji'>
</form>
  <!-- 戻るボタン -->
  <!-- <div id="back"><a href="../index.php">戻る</a></div> -->
</body>
</html>