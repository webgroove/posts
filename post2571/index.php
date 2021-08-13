<?php
$name_ruby = $_POST['name_ruby'] ?? '';

if ($name_ruby) {

  if (!checkFullWidthKatakana($name_ruby)) echo '<p>全角カタカナを入力してください。</p>';
  if (!checkHalfWidthKatakana($name_ruby)) echo '<p>半角カタカナを入力してください。</p>';
  if (!checkKatakana($name_ruby)) echo '<p>カタカナを入力してください。</p>';
}

function checkFullWidthKatakana(string $str): int|false {
  return preg_match("/\A[ァ-ヴー]+\z/u", $str);
}

function checkHalfWidthKatakana(string $str): int|false {
  return preg_match("/\A[ｦ-ﾟ]+\z/u", $str);
}

function checkKatakana(string $str): int|false {
  return preg_match("/\A[ァ-ヴｦ-ﾟー]+\z/u", $str);
}

?>

<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
</head>
<body>

<form method="post">
  お名前（フリガナ）：<input type="text" name="name_ruby">
  <input type="submit" value="送信する">
</form>

</body>
</html>
