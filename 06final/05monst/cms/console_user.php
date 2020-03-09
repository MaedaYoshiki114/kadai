<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ガチャDB</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="css/user.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php
  $view="";
  session_start();
  // 関数呼び出し
  include("../functions.php");
  login_chek();
  // DB
  $pdo = db_connect();
  // kuji抽出
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
      for ($i=1; $i <=8 ; $i++) { 
        if($result["item{$i}"]==1){
          $check[$i]="checked='checked'";
        }else{
          $check[$i]=" ";
        }
      }
      $view .= "<dd class= 'id'    >{$result['id']}</dd>";
      $view .= "<dd class= 'user'><input type='text' name='user_{$count}' value={$result['user']} class='text'></dd>";
      $view .= "<dd class= 'money'><input type='text' name='money_{$count}' value={$result['money']} class='text'></dd>";
      $view .= "<dd class= 'item'><input type='checkbox' name='item1_{$count}' value='1' {$check[1]} class=cb></dd>";
      $view .= "<dd class= 'item'><input type='checkbox' name='item2_{$count}' value='1' {$check[2]} class=cb></dd>";
      $view .= "<dd class= 'item'><input type='checkbox' name='item3_{$count}' value='1' {$check[3]} class=cb></dd>";
      $view .= "<dd class= 'item'><input type='checkbox' name='item4_{$count}' value='1' {$check[4]} class=cb></dd>";
      $view .= "<dd class= 'item'><input type='checkbox' name='item5_{$count}' value='1' {$check[5]} class=cb></dd>";
      $view .= "<dd class= 'item'><input type='checkbox' name='item6_{$count}' value='1' {$check[6]} class=cb></dd>";
      $view .= "<dd class= 'item'><input type='checkbox' name='item7_{$count}' value='1' {$check[7]} class=cb></dd>";
      $view .= "<dd class= 'item'><input type='checkbox' name='item8_{$count}' value='1' {$check[8]} class=cb></dd>";
      $view .= "<dd class= 'get'  ><input type='text' name='get_{$count}' value={$result['get']} class='text'></dd>";
      $view .= "<dd class= 'comp' ><input type='text' name='comp_{$count}' value={$result['comp']} class='text'></dd>";
      $view .= "<dd class= 'del'  ><input type='submit' name='del_{$count}' value='消去'></dd>";
    }
  }
  // データ取得 書き込み
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
    <dt class= "user">ユーザー</dt>
    <dt class= "money">課金額</dt>
    <dt class= "item1 item" >1</dt>
    <dt class= "item2 item" >2</dt>
    <dt class= "item3 item" >3</dt>
    <dt class= "item4 item" >4</dt>
    <dt class= "item5 item" >5</dt>
    <dt class= "item6 item" >6</dt>
    <dt class= "item7 item" >7</dt>
    <dt class= "item8 item" >8</dt>
    <dt class= "get" >取得数</dt>
    <dt class= "comp" >コンプ率</dt>
    <dt class= "del" >消去</dt>
    
    <?=$view?>

    <dd class= 'id'    >NEW</dd>
    <dd class= 'user'><input type='text' name='user_new' class='text'></dd>
    <dd class= 'come'><p>新しいユーザのパスワードは0000です</p></dd>
    <input type="hidden" name="page" value='user_date'>
</form>
  <!-- 戻るボタン -->
  <div id="back"><a href="../index.php">戻る</a></div>
</body>
</html>