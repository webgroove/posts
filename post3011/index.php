<?php
$postal_code = $_POST['postalCode'] ?? '';

if ($postal_code) {

  if (checkPostalCode($postal_code)) echo '<p>郵便番号の入力チェック結果 : OK</p>';
  else echo '<p>郵便番号の入力チェック結果 : NG</p>';
}

function checkPostalCode(string $str): int|false {
  return preg_match("/\A\d{3}-?\d{4}\z/", $str);
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
    郵便番号：<input type="tel" name="postalCode">
  </p>
  <input type="submit" value="送信する">
</form>

</body>
</html>
