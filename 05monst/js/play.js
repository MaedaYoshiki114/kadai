$("#corection").on("click", function() {
  $(".colle_view").toggle(1000);
});
let konami = 0;
$("body").on("keydown", function(e) {
  if (konami == 0 && e.keyCode == 38) {
    konami++;
  } else if (konami == 1 && e.keyCode == 38) {
    konami++;
  } else if (konami == 2 && e.keyCode == 40) {
    konami++;
  } else if (konami == 3 && e.keyCode == 40) {
    konami++;
  } else if (konami == 4 && e.keyCode == 37) {
    konami++;
  } else if (konami == 5 && e.keyCode == 39) {
    konami++;
  } else if (konami == 6 && e.keyCode == 37) {
    konami++;
  } else if (konami == 7 && e.keyCode == 39) {
    konami++;
  } else if (konami == 8 && e.keyCode == 66) {
    konami++;
  } else if (konami == 9 && e.keyCode == 65) {
    $("#btn_w").html(`<a id="try_btn" href="cms/console.php">チート</a>`);
  }
  console.log(e.keyCode);
});
