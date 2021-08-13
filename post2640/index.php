<?php
$name_ruby = $_POST['name_ruby'] ?? '';

if ($name_ruby) {

  if (!checkHiragana($name_ruby)) echo '<p>ひらがなを入力してください。</p>';
}

function checkHiragana(string $str): int|false {
  return preg_match("/\A[ぁ-ゖー]+\z/u", $str);
}

?>

<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
</head>
<body>

<form method="post">
  お名前（ひらがな）：<input type="text" name="name_ruby">
  <input type="submit" value="送信する">
</form>

</body>
</html>
