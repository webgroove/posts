<?php
$fullwidth_katakana = $_POST['fullwidthKatakana'] ?? '';
$halfwidth_katakana = $_POST['halfwidthKatakana'] ?? '';
$katakana = $_POST['katakana'] ?? '';

if ($fullwidth_katakana) {

  if (checkFullWidthKatakana($fullwidth_katakana)) echo '<p>全角カタカナの入力チェック結果 : OK</p>';
  else echo '<p>全角カタカナの入力チェック結果 : NG</p>';
}

if ($halfwidth_katakana) {

  if (checkHalfWidthKatakana($halfwidth_katakana)) echo '<p>半角カタカナの入力チェック結果 : OK</p>';
  else echo '<p>半角カタカナの入力チェック結果 : NG</p>';
}

if ($katakana) {

  if (checkKatakana($katakana)) echo '<p>カタカナの入力チェック結果 : OK</p>';
  else echo '<p>カタカナの入力チェック結果 : NG</p>';
}

function checkFullWidthKatakana(string $str): int|false {
  return preg_match("/\A[ァ-ヿ]+\z/u", $str);
}

function checkHalfWidthKatakana(string $str): int|false {
  return preg_match("/\A[ｦ-ﾟ]+\z/u", $str);
}

function checkKatakana(string $str): int|false {
  return preg_match("/\A\p{Katakana}+\z/u", $str);
}

?>

<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
</head>
<body>

<hr>
<form method="post">
  <p>
    全角カタカナ：<input type="text" name="fullwidthKatakana">
  </p>
  <p>
    半角カタカナ：<input type="text" name="halfwidthKatakana">
  </p>
  <p>
    カタカナ（Unicode 文字プロパティ）：<input type="text" name="katakana">
  </p>
  <input type="submit" value="送信する">
</form>

</body>
</html>
