<?php
$kanji_1 = $_POST['kanji1'] ?? '';
$kanji_2 = $_POST['kanji2'] ?? '';
$kanji_3 = $_POST['kanji3'] ?? '';

if ($kanji_1) {

  if (!checkKanji($kanji_1)) echo '<p>漢字の入力チェック結果 : NG</p>';
  else echo '<p>漢字の入力チェック結果 : OK</p>';
}

if ($kanji_2) {

  if (!checkKanji2($kanji_2)) echo '<p>漢字（ブロック毎）の入力チェック結果 : NG</p>';
  else echo '<p>漢字（ブロック毎）の入力チェック結果 : OK</p>';
}

if ($kanji_3) {

  if (!checkKanji3($kanji_3)) echo '<p>漢字（Unicode 文字プロパティ）の入力チェック結果 : NG</p>';
  else echo '<p>漢字（Unicode 文字プロパティ）の入力チェック結果 : OK</p>';
}

function checkKanji(string $str): int|false {
  return preg_match("/\A[々〇〻\x{3400}-\x{9FFC}\x{F900}-\x{FAD9}\x{20000}-\x{3134A}]+\z/u", $str);
}

function checkKanji2(string $str): int|false {
  return preg_match("/\A[々〇〻\x{3400}-\x{4DBF}\x{4E00}-\x{9FFC}\x{F900}-\x{FAD9}\x{20000}-\x{2A6DD}\x{2A700}-\x{2B734}\x{2B740}-\x{2B81D}\x{2B820}-\x{2CEA1}\x{2CEB0}-\x{2EBE0}x{2F800}-\x{2FA1F}\x{30000}-\x{3134A}]+\z/u", $str);
}

function checkKanji3(string $str): int|false {
  return preg_match("/\A[\p{Han}]+\z/u", $str);
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
    漢字：<input type="text" name="kanji1">
  </p>
  <p>
    漢字（ブロック毎）：<input type="text" name="kanji2">
  </p>
  <p>
    漢字（Unicode 文字プロパティ）：<input type="text" name="kanji3">
  </p>
  <input type="submit" value="送信する">
</form>

</body>
</html>
