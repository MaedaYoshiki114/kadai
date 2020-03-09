<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>information</h1>

  <form action="" method="post">
  <input type="button" value="法人" id = "sw">
  <dl>
    <dt>会社名</dt>
    <dd><input type="text" name="" id=""></dd>
    <dt>部署</dt>
    <dd><input type="text" name="" id=""></dd>
    <dt>氏名</dt>
    <dd><input type="text" name="" id=""></dd>
    <dt>フリガナ</dt>
    <dd><input type="text" name="" id=""></dd>
    <dt>電話</dt>
    <dd><input type="tel" name="" id=""></dd>
    <dt>Email</dt>
    <dd><input type="email" name="" id=""></dd>
    <dt>カテゴリ</dt>
    <dd>
    <label for="kigyou">
      <input
        type="checkbox"
        name="douki1"
        id="kigyou"
        value="起業をしたい"
      />起業をしたい
    </label>

    <label for="tensyoku">
      <input
        type="checkbox"
        name="douki2"
        id="tensyoku"
        value="採用"
      />採用
    </label>

    <label for="keikenn">
      <input
        type="checkbox"
        name="douki3"
        id="keikenn"
        value="仕事依頼"
      />仕事依頼
    </label>

    <label for="manabu">
      <input
        type="checkbox"
        name="douki4"
        id="manabu"
        value="その他"
      />その他
    </label>
    </dd>
    <dt>内容</dt>
    <dd>
    <textarea
    name="detaile"
    id=""
    cols="30"
    rows="10"
    class="form-p"
  ></textarea>
    </dd>
  </dl>
  </form>
</body>
</html>