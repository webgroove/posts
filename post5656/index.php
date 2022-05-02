<?php
$url = $_POST['url'] ?? '';

if ($url) {

  if (checkUrl($url)) echo '<p>URL の入力チェック結果 : OK</p>';
  else echo '<p>URL の入力チェック結果 : NG</p>';
}

function checkUrl(string $url): bool {
  return filter_var($url, FILTER_VALIDATE_URL) !== false && preg_match('#\Ahttps?://#', $url);
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
    URL：<input type="url" name="url">
  </p>
  <input type="submit" value="送信する">
</form>

</body>
</html>
