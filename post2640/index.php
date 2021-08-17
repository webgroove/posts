<?php
$hiragana = $_POST['hiragana'] ?? '';
$hiragana_2 = $_POST['hiragana2'] ?? '';

if ($hiragana) {

  if (checkHiragana($hiragana)) echo '<p>ひらがなの入力チェック結果 : OK</p>';
  else echo '<p>ひらがなの入力チェック結果 : NG</p>';
}

if ($hiragana_2) {

  if (checkHiragana2($hiragana_2)) echo '<p>ひらがな（Unicode 文字プロパティ）の入力チェック結果 : OK</p>';
  else echo '<p>ひらがな（Unicode 文字プロパティ）の入力チェック結果 : NG</p>';
}

function checkHiragana(string $str): int|false {
  return preg_match("/\A[ぁ-ゟー]+\z/u", $str);
}

function checkHiragana2(string $str): int|false {
  return preg_match("/\A\p{Hiragana}+\z/u", $str);
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
    ひらがな：<input type="text" name="hiragana">
  </p>
  <p>
    ひらがな（Unicode 文字プロパティ）：<input type="text" name="hiragana2">
  </p>
  <input type="submit" value="送信する">
</form>

</body>
</html>
