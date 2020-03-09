$(function() {
  // この中に書く

  let jk;
  let con = 0;

  // クリックされた手札を消す
  for (let i = 0; i < 6; i++) {
    if ($.inArray(`${i}`, my_setlog) >= 0) {
      $(`#my_tefuda${i}`).hide();
      $(`#en_tefuda${con}`).hide();
      con++;
    }
    // クリックされた手札を盤面に出す
    if (my == i) {
      if (i <= 1) {
        jk = "rock";
      } else if (i <= 3) {
        jk = "scissors";
      } else if (i <= 5) {
        jk = "paper";
      }
      $("#bat_my").html(`<img src="img/${jk}.jpg" alt="">`);
    }
  }
  switch (en_set) {
    case "rock":
      $("#bat_en").html(`<img src="img/rock.jpg" alt="">`);
      break;
    case "scissors":
      $("#bat_en").html(`<img src="img/scissors.jpg" alt="">`);
      break;
    case "paper":
      $("#bat_en").html(`<img src="img/paper.jpg" alt="">`);
      break;
  }
  if (1 < con) {
    let tg = con - 2;
    if (en_setlog[tg] == "rock") {
      $(".en_sute").html(`<img src="img/rock.jpg" alt="">`);
    } else if (en_setlog[tg] == "scissors") {
      $(".en_sute").html(`<img src="img/scissors.jpg" alt="">`);
    } else if (en_setlog[tg] == "paper") {
      $(".en_sute").html(`<img src="img/paper.jpg" alt="">`);
    }
    if (my_setlog[tg] <= 1) {
      jk = "rock";
    } else if (my_setlog[tg] <= 3) {
      jk = "scissors";
    } else if (my_setlog[tg] <= 5) {
      jk = "paper";
    }
    $(".my_sute").html(`<img src="img/${jk}.jpg" alt="">`);
  }
  // この下は消さない
});
