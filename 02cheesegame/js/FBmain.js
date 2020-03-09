// Firebase準備
// Your web app's Firebase configuration
var firebaseConfig = {
  apiKey: "AIzaSyB-cUrncOISmq5w102yNkLE6tWY-gnmO4w",
  authDomain: "cheese-game.firebaseapp.com",
  databaseURL: "https://cheese-game.firebaseio.com",
  projectId: "cheese-game",
  storageBucket: "cheese-game.appspot.com",
  messagingSenderId: "773789785106",
  appId: "1:773789785106:web:1aa92bab2414cd62fb0ccb"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
// Firebase準備終了

//準備 変数宣言
let chek = 0;
let rd = 1;
let scr = 0;
let scr_rea = 0;
let scr_nezu = 0;
let scr_tizu = 0;
let life = 2;
let clear = 0;
let tg_t1;
let tg_c;
var json_r_d;
var json_save;
var rank_date;
let tefuda = [null, null, null, null, null];
let kago = [
  "tizu",
  "tizu",
  "tizu",
  "tizu",
  "tizu",
  "tizu",
  "tizu",
  "tizu",
  "tizu",
  "tizu",
  "tizu",
  "tizu"
];
// var rank_date = [
//   { rd: "1", scr: "0" },
//   { rd: "1", scr: "0" },
//   { rd: "1", scr: "0" },
//   { rd: "1", scr: "0" },
//   { rd: "1", scr: "0" }
// ];
// // オブジェクトをJSONに変換
// json_r_d = JSON.stringify(rank_date);
// const newPostRef = firebase.database().ref(); // 受信
// newPostRef.set({ json_r_d: json_r_d });

//ランキングデータ取得
// fb
// if (rank_date == null) {
//   const newPostRef = firebase.database().ref(); // 受信
//   newPostRef.on("value", function(data) {
//     json_r_d = data.val(); //FBからランキングデータ取得
//     rank_date = JSON.parse(json_r_d); //JSON変換
//   });
// } else {
// FBにデータがなかったら初期値を保存
// if (json_r_d == null) {
//   //ランキングデータ保存
//   var rank_date = [
//     { rd: "1", scr: "0" },
//     { rd: "1", scr: "0" },
//     { rd: "1", scr: "0" },
//     { rd: "1", scr: "0" },
//     { rd: "1", scr: "0" }
//   ];
//   // オブジェクトをJSONに変換
//   json_r_d = JSON.stringify(rank_date);
//   newPostRef.set({ json_r_d: json_r_d });
// }
// 途中セーブ
var save = {
  rd_n: rd,
  scr_n: scr,
  life: life
};

if (localStorage.getItem("json_save")) {
  //データ取得
  json_save = localStorage.getItem("json_save");
  save = JSON.parse(json_save);
  rd = save["rd_n"];
  scr = save["scr_n"];
  life = save["life"];
  $(".rd_s").html(rd);
  $(".scr_s").html(scr);

  // ライフ表示
  if (life == 0) {
    $(".life").html('<img src="img/life0.png" />');
  } else if (life == 1) {
    $(".life").html('<img src="img/life1.png" />');
  } else if (life == 2) {
    $(".life").html('<img src="img/life2.png" />');
  } else if (life == 3) {
    $(".life").html('<img src="img/life3.png" />');
  } else if (life == 4) {
    $(".life").html('<img src="img/life4.png" />');
  }
}

// 関数 ランキング表示
// rk_tg_aはクラスの名前 rk_tg_bは順位
// function runking(rk_tg_a, rk_tg_b) {
//   let rk_tg3 = rk_tg_b + 1;
//   let rk_tg1 = "." + rk_tg_a + " .rd_" + rk_tg3 + "_s";
//   let rk_tg2 = "." + rk_tg_a + " .scr_" + rk_tg3 + "_s";
//   $(rk_tg1).html(rank_date[rk_tg_b].rd);
//   $(rk_tg2).html(rank_date[rk_tg_b].scr);
// }

if (localStorage.getItem("rd")) {
  rd = localStorage.getItem("rd");
  $(".rd").html(rd);
}

// 準備 関数用意
// マス割り当て
//roopは変更する枚数 yakuは変更する役の名前
function tyuusen(roop, yaku) {
  //変更する枚数分繰り返す
  for (let i = 0; i < roop; i++) {
    chek = 1; //チェックをリセット
    //ランダム
    let kuji = Math.floor(Math.random() * 12);
    //チェックが入るまで繰り返す
    while (chek) {
      //ランダムの場所が初期値なら
      if (kago[kuji] == "tizu") {
        kago[kuji] = yaku;
        chek = 0;
      } else if (kuji < 12) {
        kuji++;
      } else {
        kuji = 0;
      }
    }
  }
}
function view(tv) {
  tg_t1 = "#T" + tv;
  if (tefuda[tv] == "tizu") {
    $(tg_t1).slideUp(10);
    $(tg_t1).html('<img src="img/tizu.png">');
    $(tg_t1).slideDown(500);
  } else if (tefuda[tv] == "rea") {
    $(tg_t1).slideUp(10);
    $(tg_t1).html('<img src="img/rea.png" />');
    $(tg_t1).slideDown(500);
  } else if (tefuda[tv] == "nezu") {
    $(tg_t1).slideUp(10);
    $(tg_t1).html('<img src="img/nezu.png" />');
    $(tg_t1).slideDown(500);
  }
}
//関数 スコア計算
function scr_ch(scr_tg) {
  if (tefuda[scr_tg] == "tizu") {
    scr = scr + 10;
    scr_tizu++;
    $(".scr_s").html(scr);
    $(".tizu_p").html(scr_tizu * 10);
  } else if (tefuda[scr_tg] == "rea") {
    scr = scr + 30;
    scr_rea++;
    $(".scr_s").html(scr);
    $(".rea_p").html(scr_rea * 30);
    if (scr_rea == 4) {
      $(".comp").html(50);
    }
  } else if (tefuda[scr_tg] == "nezu") {
    scr_nezu++;
  }
}

// 準備 ネズミとレア割り当て
tyuusen(3, "nezu"); //ネズミを3枚配置
tyuusen(4, "rea"); //レアを4枚配置

// // 準備 ランキング１～5表示
// for (let rk_roop = 0; rk_roop <= 4; rk_roop++) {
//   runking("rk", rk_roop);
// }
// for (let rk_roop = 0; rk_roop <= 4; rk_roop++) {
//   runking("rk_g", rk_roop);
// }
//めくる
let count = 0;
// 12箇所のマスを見るようにカウントアップしながら繰り返す
for (let tg_roop = 0; tg_roop < 12; tg_roop++) {
  let tg_a = "#A" + tg_roop; // IDに変換
  let cb = "#B" + tg_roop; // IDに変換
  $(tg_a).on("click", function() {
    // クリックされたら
    let y = kago[tg_roop]; //クリックされた場所の役を取得
    if (y === "tizu") {
      $(tg_a).slideUp(10); //元の画像を消す
      $(tg_a).html('<img src="img/tizu.png">'); //tizuの画像に切り替え
      $(tg_a).slideDown(500); //tizuの画像表示
      $(cb).show(); //クリックブロック発動
      tefuda[count] = "tizu";
      count++;
      scr_ch(count - 1);
    } else if (y === "rea") {
      $(tg_a).slideUp(10);
      $(tg_a).html('<img src="img/rea.png" />');
      $(tg_a).slideDown(500);
      $(cb).show(); //クリックブロック発動
      tefuda[count] = "rea";
      count++;
      scr_ch(count - 1);
    } else if (y == "nezu") {
      $(tg_a).slideUp(10);
      $(tg_a).html('<img src="img/nezu.png" />');
      $(tg_a).slideDown(500);
      $(cb).show(); //クリックブロック発動
      tefuda[count] = "nezu";
      life--;
      count++;
      scr_ch(count - 1);
    }
    // 手札表示+スコア計算
    if (count == 1) {
      view(0);
    } else if (count == 2) {
      view(1);
    } else if (count == 3) {
      view(2);
    } else if (count == 4) {
      view(3);
    } else if (count == 5) {
      view(4);
    }
    // ランキング比較
    // let = chek_1 = 0;
    // for (let rk_roop = 0; rk_roop <= 4; rk_roop++) {
    //   console.log("ランキング", rank_date[rk_roop].scr);
    //   if (rank_date[rk_roop].scr < scr && chek_1 == 0) {
    //     rank_date[rk_roop].rd = rd;
    //     rank_date[rk_roop].scr = scr;

    //     let rk_tg3 = rk_roop + 1;
    //     let rk_tg1 = ".rd_" + rk_tg3 + "_s";
    //     let rk_tg2 = ".scr_" + rk_tg3 + "_s";
    //     $(rk_tg1).html(rank_date[rk_roop].rd);
    //     $(rk_tg2).html(rank_date[rk_roop].scr);
    //     chek_1 = 1;
    //   }
    // }

    //5枚目まで埋まったら
    if (tefuda[4] != null && 1 <= life) {
      clear = 1;
      save["rd_n"] = rd + 1;
      save["scr_n"] = scr;
      save["life"] = life;
      // 途中セーブ
      json_save = JSON.stringify(save);
      localStorage.setItem("json_save", json_save);
      // ランキング送信
      json_r_d = JSON.stringify(rank_date);
      // newPostRef.set({ json_r_d: json_r_d });

      $(".cb").hide(); //クリックブロック非表示
      $(".res").fadeIn(2000);
      if (scr_nezu == 0) {
        scr = scr + 20;
        $(".scr_s").html(scr);
        $(".miss").html(20);
      }
    }
    //スコア計算
    //レアが4枚そろったら+50点
    if (4 <= scr_rea) {
      scr = scr + 50;
      $(".scr_s").html(scr);
    }
    if (life == 0) {
      $(".life").html('<img src="img/life0.png" />');
    } else if (life == 1) {
      $(".life").html('<img src="img/life1.png" />');
    } else if (life == 2) {
      $(".life").html('<img src="img/life2.png" />');
    } else if (life == 3) {
      $(".life").html('<img src="img/life3.png" />');
    } else if (life == 4) {
      $(".life").html('<img src="img/life4.png" />');
    }
    if (life == 0) {
      $(".cb").hide(); //クリックブロック非表示
      $(".gameover").fadeIn(2000);
      save["rd_n"] = 1;
      save["scr_n"] = 0;
      save["life"] = 2;
      json_save = JSON.stringify(save);
      localStorage.setItem("json_save", json_save);
      // ランキング送信
      json_r_d = JSON.stringify(rank_date);
      // newPostRef.set({ json_r_d: json_r_d });
    }
  });
}
$(".next_btn").on("click", function() {
  document.location.reload();
});
$("#ru_btn").on("click", function() {
  $(".ru").fadeIn(1000);
});
$("#reset_btn").on("click", function() {
  save["rd_n"] = 1;
  save["scr_n"] = 0;
  save["life"] = 2;
  json_save = JSON.stringify(save);
  localStorage.setItem("json_save", json_save);
  // ページをreloadする
  document.location.reload();
});
$("#ru1").click(function() {
  $(".ru p:not(:animated)").animate(
    {
      marginLeft: "-1000px"
    },
    400
  );
});
$("#ru2").click(function() {
  $(".ru p:not(:animated)").animate(
    {
      marginLeft: "0"
    },
    400
  );
});
$(".ru_next_btn").on("click", function() {
  $(".ru").hide(1000);
});
// };
// }
