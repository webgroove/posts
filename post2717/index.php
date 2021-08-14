<?php
$name_ruby = $_POST['name'] ?? '';

if ($name_ruby) {

  if (!checkKanji($name_ruby)) echo '<p>漢字を入力してください。</p>';
}

function checkKanji(string $str): int|false {
  return preg_match("/\A[々〇〻\x{3400}-\x{9FFC}\x{F900}-\x{FAD9}\x{20000}-\x{3134A}]+\z/u", $str);
}

?>

<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
</head>
<body>

<form method="post">
  お名前（漢字）：<input type="text" name="name">
  <input type="submit" value="送信する">
</form>

</body>
</html>
