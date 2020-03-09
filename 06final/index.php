<?php
$count2=0;
  if(isset($_POST["word"])){
    $word=$_POST["word"];
  }else{
    $word="";
  }
  if(isset($_POST["tag"])){
    $tag_ss=$_POST["tag"];
    $pieces = explode("(", $tag_ss);
    $tag_s=$pieces[0];
  }else{
    $tag_s="all";
  }
  if(isset($_POST["sort"])){
    $sort=$_POST["sort"];
  }else{
    $sort="up_new";
  }
// DB接続
try {
  $pdo = new PDO('mysql:dbname=final;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}
// セレクトにタグ一覧を表示させる
$sql = "SELECT * FROM gallery";
$stmt = $pdo->prepare($sql);
$status= $stmt->execute();
while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
  for ($i=1; $i <= 8; $i++) { 
    if(isset($result["tag{$i}"])){
      $tag[]=$result["tag{$i}"];
    }
  }
}
$tag_view="";
$tag_count = array_count_values($tag);
foreach($tag_count as $key => $value){
  $tag_list="$key({$value})";
  $tag_view.="<option value='{$key}'>{$tag_list}</option>";
}
// タグ全て更新が新しい順
if($tag_s=="all" && $sort=="up_new"){
  $sql = "SELECT * FROM gallery WHERE (text LIKE'%$word%') ORDER BY up_day DESC";
  $stmt = $pdo->prepare($sql);
  $status= $stmt->execute();
}
// タグ全て更新が古い順
else if($tag_s=="all" && $sort=="up_old"){
  $sql = "SELECT * FROM gallery WHERE (text LIKE'%$word%') ORDER BY up_day ASC";
  $stmt = $pdo->prepare($sql);
  $status= $stmt->execute();
}
// タグ全て配信が新しい順
else if($tag_s=="all" && $sort=="fast_new"){
  $sql = "SELECT * FROM gallery WHERE (text LIKE'%$word%') ORDER BY fast_day DESC";
  $stmt = $pdo->prepare($sql);
  $status= $stmt->execute();
}
// タグ全て配信が古い順
else if($tag_s=="all" && $sort=="fast_old"){
  $sql = "SELECT * FROM gallery WHERE (text LIKE'%$word%') ORDER BY fast_day ASC";
  $stmt = $pdo->prepare($sql);
  $status= $stmt->execute();
}
// タグ指定更新が新しい順
else if($sort=="up_new"){
  $sql = "SELECT * FROM gallery WHERE (text LIKE'%$word%') AND
  ((tag1='$tag_s')OR(tag2='$tag_s')OR(tag3='$tag_s')OR(tag4='$tag_s')OR
  (tag4='$tag_s')OR(tag5='$tag_s')OR(tag6='$tag_s')OR(tag7='$tag_s')OR(tag8='$tag_s'))
  ORDER BY up_day DESC";
  $stmt = $pdo->prepare($sql);
  $status= $stmt->execute();
}
// タグ指定更新が古い順
else if($sort=="up_old"){
  $sql = "SELECT * FROM gallery WHERE (text LIKE'%$word%') AND
  ((tag1='$tag_s')OR(tag2='$tag_s')OR(tag3='$tag_s')OR(tag4='$tag_s')OR
  (tag4='$tag_s')OR(tag5='$tag_s')OR(tag6='$tag_s')OR(tag7='$tag_s')OR(tag8='$tag_s'))
  ORDER BY up_day ASC";
  $stmt = $pdo->prepare($sql);
  $status= $stmt->execute();
}
// タグ指定配信が新しい順
else if($sort=="fast_new"){
  $sql = "SELECT * FROM gallery WHERE (text LIKE'%$word%') AND
  ((tag1='$tag_s')OR(tag2='$tag_s')OR(tag3='$tag_s')OR(tag4='$tag_s')OR
  (tag4='$tag_s')OR(tag5='$tag_s')OR(tag6='$tag_s')OR(tag7='$tag_s')OR(tag8='$tag_s'))
  ORDER BY fast_day DESC";
  $stmt = $pdo->prepare($sql);
  $status= $stmt->execute();
}
// タグ指定配信が古い順
else if($sort=="fast_old"){
  $sql = "SELECT * FROM gallery WHERE (text LIKE'%$word%') AND
  ((tag1='$tag_s')OR(tag2='$tag_s')OR(tag3='$tag_s')OR(tag4='$tag_s')OR
  (tag4='$tag_s')OR(tag5='$tag_s')OR(tag6='$tag_s')OR(tag7='$tag_s')OR(tag8='$tag_s'))
  ORDER BY fast_day ASC";
  $stmt = $pdo->prepare($sql);
  $status= $stmt->execute();
}
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  $count=0;
  $gallery_view="";
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $count++;
    $gallery_view.="<div class='gallery'>";
    $gallery_view.="<h3>{$result['name']}</h3>";
    $gallery_view.="<ul class='tag'>";
    for ($i=1; $i <= 8; $i++) { 
      if(isset($result["tag{$i}"])){
        $count2++;
        $tag_tg=$result["tag{$i}"];
        $gallery_view.="<form method='post' name='form{$count2}' action='index.php'>";
        $gallery_view.="<input type='hidden' name='tag' value='{$tag_tg}'>";
        $gallery_view.="<input type='hidden' name='word' value=''>";
        $gallery_view.="<input type='hidden' name='sort' value='up_new'>";
        $gallery_view.="<li><a href='javascript:form{$count2}.submit()'>{$tag_tg}</a></li>";
        $gallery_view.="</form>";
      }
    }
    $gallery_view.="</ul>";
    $gallery_view.="<div class='img_text'>";
    $gallery_view.="<img src='img/{$result['img']}' alt='チーズ集めの画像'>";
    $gallery_view.="<div class='text'>";
    $gallery_view.="<div class='day'>";
    $gallery_view.="<p class = 'release_day'>配信日：{$result['fast_day']}</p>";
    $gallery_view.="<p class = 'up_day'>最終更新日：{$result['up_day']}</p>";
    $gallery_view.="</div>";
    $gallery_view.="<p class = 'text'>{$result['text']}</p>";
    $gallery_view.="</div>";
    $gallery_view.="</div>";
    $gallery_view.="<p class='link_btn'><a href='{$result['file']}'>このページへ移動</a></p>";
    $gallery_view.="</div>";
  }
}
$total=$count;
if($word==""&&$tag_s=="all"){
  $word_view="すべて";
}else{
  $word_view=$word;
  $word_view.=" ";
  $word_view.=$tag_s;
}
?>
<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>前田祥志樹Gallery</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/gallery.css">
</head>
<body>
  <h1>Gallery</h1>
  <form action="index.php" method="post">
    <dl id="search">
      <dt>キーワード</dt>
      <dd><input type="search" name="word" id="word"></dd>
      <dt>タグ</dt>
      <dd>
        <select name="tag" id="tag">
        <!-- 選択肢 -->
        <option value="all">すべて</option>
        <?=$tag_view?>
      </select>
      </dd>
      <dt>並び替え</dt>
      <dd>
        <select name="sort" id="sort">
        <!-- 選択肢 -->
        <option value="up_new">更新が新しい順</option>
        <option value="up_old">更新が古い順</option>
        <option value="fast_new">配信が新しい順</option>
        <option value="fast_old">配信が古い順</option>
        </select>
      </dd>
      <dd id="send"><input type="submit" value="検索"></dd>
    </dl>
  </form>

  <h2><?=$word_view?>の検索結果(<?=$total?>件)</h2>
  <?=$gallery_view?>

</body>
</html>