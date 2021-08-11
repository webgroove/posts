<?php
$inquiry = $_POST['inquiry'] ?? '';

$inquiry = h($inquiry);

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

<form method="post">
  お問い合わせ内容：<textarea name="inquiry"></textarea>
  <input type="submit" value="送信する">
</form>
<p><?= $inquiry ?></p>

</body>
</html>