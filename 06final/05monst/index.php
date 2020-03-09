<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ログイン</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php"></a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<!-- ここからinsert.phpにデータを送ります -->
<form method="post" action="login_act.php">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート</legend>
     <label>ユーザID：<input type="text" name="user"></label><br>
     <label>パスワード：<input type="text" name="pass"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
  <!-- 戻るボタン -->
  <div id="back"><a href="../index.php">戻る</a></div>
<!-- Main[End] -->


</body>
</html>
