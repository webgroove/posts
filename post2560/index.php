<?php
$escape = $_POST['escape'] ?? '';
$no_escape = $_POST['noEscape'] ?? '';

if ($escape) echo h($escape);
if ($no_escape) echo $no_escape;

function h(string $str): string {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
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
    エスケープ処理する：<input type="text" name="escape">
  </p>
  <p>
    エスケープ処理しない：<input type="text" name="noEscape">
  </p>
  <input type="submit" value="送信する">
</form>

</body>
</html>
