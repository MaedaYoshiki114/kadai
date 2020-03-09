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
let rd = 1;
let scr = 0;
var json_r_d;
var json_save;
var rank_date;

var rank_date = [
  { rd: "1", scr: "0" },
  { rd: "1", scr: "0" },
  { rd: "1", scr: "0" },
  { rd: "1", scr: "0" },
  { rd: "1", scr: "0" }
];
// オブジェクトをJSONに変換
json_r_d = JSON.stringify(rank_date);
const newPostRef = firebase.database().ref(); // 受信
newPostRef.set({ json_r_d: json_r_d });

newPostRef.on("value", function(data) {
  json_r_d = data.val(); //FBからランキングデータ取得
  rank_date = JSON.parse(json_r_d); //JSON変換
  Console.log(rank_date);
});
