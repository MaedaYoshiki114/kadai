<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>php課題</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
  <h1>じゃんけん</h1>
  <!-- 手札（敵） -->
  <ul class = "en_tefuda tefuda">
    <li id = en_tefuda0><img src="img/ura.jpg" alt=""></li>
    <li id = en_tefuda1><img src="img/ura.jpg" alt=""></li>
    <li id = en_tefuda2><img src="img/ura.jpg" alt=""></li>
    <li id = en_tefuda3><img src="img/ura.jpg" alt=""></li>
    <li id = en_tefuda4><img src="img/ura.jpg" alt=""></li>
    <li id = en_tefuda5><img src="img/ura.jpg" alt=""></li>
  </ul>
  
    <?php
    // 変数宣言
    session_start();
    $my_setlog =$_SESSION["my_setlog"];
    $en_setlog =$_SESSION["en_setlog"];
    $en_tefuda =$_SESSION["en_tefuda"];
    $count =$_SESSION["count"];
    $kati =$_SESSION["kati"];
    $make =$_SESSION["make"];
    $my=null;
    $my_sute=null;
    $en_sute=null;
    $reset=null;
    $en_set=null;
    $kekka=null;

    // 自分の使った札を記憶させる
    if (isset($_POST["set"])) {
      $my = htmlspecialchars($_POST["set"], ENT_QUOTES, "UTF-8");
      switch ($my) {
          case "0":   $my_setlog[] = $my;break;
          case "1":   $my_setlog[] = $my;break;
          case "2":   $my_setlog[] = $my;break;
          case "3":   $my_setlog[] = $my;break;
          case "4":   $my_setlog[] = $my;break;
          case "5":   $my_setlog[] = $my;break;
          default:    exit;
      }
      if ($my <= 1) {
        $my_set = "rock";
      } else if ($my <= 3) {
        $my_set = "scissors";
      } else if ($my <= 5) {
        $my_set = "paper";
      }
  }

  // 相手の抽選
  if($my!=null){
    $en=rand(0,$count);
    $en_set=$en_tefuda[$en];
    $split = array_splice($en_tefuda, $en, 1);
    $en_setlog[] = $split;
    $count--;
      // じゃんけん
    if($my_set==$en_set){
      $kekka="aiko";
    }else if(($my_set=="rock"&&$en_set=="scissors")
    ||($my_set=="scissors"&&$en_set=="rock")
    ||($my_set=="paper"&&$en_set=="scissors")){
      $kekka="make";
      $make++;
    }else if($my_set=="rock"&&$en_set=="paper"
    ||($my_set=="scissors"&&$en_set=="paper")
    ||($my_set=="paper"&&$en_set=="rock")){
      $kekka="kati";
      $kati++;
    }
  }

  // リセット処理
  if (isset($_POST["reset"])) {
    $reset = htmlspecialchars($_POST["reset"], ENT_QUOTES, "UTF-8");
    if($reset=="リセット"){
      $my_setlog=[];
      $en_setlog=[];
      $_POST["reset"]=null;
      $en_tefuda=["rock","rock","scissors","scissors","paper","paper"];
      $count=4;
      $make=0;
      $kati=0;
    }
  }
  $_SESSION["my_setlog"]=$my_setlog;
  $_SESSION["en_setlog"]=$en_setlog;
  $_SESSION["en_tefuda"]=$en_tefuda;
  $_SESSION["count"]=$count;
  $_SESSION["kati"]=$kati;
  $_SESSION["make"]=$make;
    // 中央画面の表示

    echo  '<div class="center">';
    // 捨て札（敵）
    echo    '<div class="en_sute sute"><p>捨て札<br>相手</p></div>';
    echo    '<div class="battle_w">';
    // 勝敗スコア
    echo      '<dl class="seiseki">';
    echo        '<dt>勝ち</dt>';
    echo        "<dd id = 'kati'>${kati}</dd>";
    echo        '<dt>負け</dt>';
    echo        "<dd id = 'make'>${make}</dd>";
    echo      '</dl>';
    // 盤面
    echo      '<div class="tag"><p>相手</p><p>自分</p></div>';
    echo      '<ul class = "battle">';
    echo        '<li id = "bat_en"><img src="img/ura.jpg" alt=""></li>';
    echo        '<li id = "bat_my"><img src="img/ura.jpg" alt=""></li>';
    echo      '</ul>';
    echo    '</div>';
    // 捨て札（自）
    echo    '<div class="my_sute sute"><p>捨て札<br>自分</p></div>';
    echo  '</div>';

    // json変換
    if($my!=null){
      $JSONmy_setlog=json_encode( $my_setlog );
      $JSONen_setlog=json_encode( $en_setlog );
      $JSONen=json_encode( $en );
      $JSONen_tefuda=json_encode( $en_tefuda );
      $JSONmy=json_encode( $my );
      $JSONmy_sute=json_encode( $my_sute );
      $JSONen_sute=json_encode( $en_sute );
      $JSONen_set=json_encode( $en_set );
      $JSONreset=json_encode( $reset );
      $JSONkekka=json_encode( $kekka );
  }
    ?>
    <!-- 手札（自） -->
    <form method="POST" action="" class = "my_tefuda tefuda">
      <input id = "my_tefuda0" class = "rock" type="submit" value="0" name="set">
      <input id = "my_tefuda1" class = "rock" type="submit" value="1" name="set">
      <input id = "my_tefuda2" class = "scissors" type="submit" value="2" name="set">
      <input id = "my_tefuda3" class = "scissors" type="submit" value="3" name="set">
      <input id = "my_tefuda4" class = "paper" type="submit" value="4" name="set">
      <input id = "my_tefuda5" class = "paper" type="submit" value="5" name="set">
    </form>
    <!-- リセットボタン（デバッグ） -->
    <form method="POST" action="">
      <input id = "reset" type="submit" value="リセット" name="reset">
    </form>
  <!-- 戻るボタン -->
  <div id="back"><a href="../index.php">戻る</a></div>
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- jsへ受け渡し -->
<script type="text/javascript">
  var my_setlog  = JSON.parse('<?php echo $JSONmy_setlog; ?>');
  var en_setlog  = JSON.parse('<?php echo $JSONen_setlog; ?>');
  var en  = JSON.parse('<?php echo $JSONen; ?>');
  var en_tefuda  = JSON.parse('<?php echo $JSONen_tefuda; ?>');
  var my  = JSON.parse('<?php echo $JSONmy; ?>');
  var my_sute  = JSON.parse('<?php echo $JSONmy_sute; ?>');
  var en_sute  = JSON.parse('<?php echo $JSONen_sute; ?>');
  var en_set  = JSON.parse('<?php echo $JSONen_set; ?>');
  var reset  = JSON.parse('<?php echo $JSONreset; ?>');
  var kekka  = JSON.parse('<?php echo $JSONkekka; ?>');
</script>

    <!-- js -->
    <script src='js/app.js'></script>
  </body>
</html>
