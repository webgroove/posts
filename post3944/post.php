<?php
$test = $_POST['test'] ?? '';

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

<?= h($test) ?>

<hr>
<form method="post">
  <p>
    POST メソッド：<input type="text" name="test">
  </p>
  <button>送信する</button>
</form>

</body>
</html>