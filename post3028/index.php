<?php
$email = $_POST['email'] ?? '';

if ($email) {

  if (checkEmail($email)) echo '<p>メールアドレスの入力チェック結果 : OK</p>';
  else echo '<p>メールアドレスの入力チェック結果 : NG</p>';
}

function checkEmail(string $email): bool {
  $array = explode('@', $email);
  $domain_part = array_pop($array);

  return filter_var($email, FILTER_VALIDATE_EMAIL) !== false &&
    (checkdnsrr($domain_part) || checkdnsrr($domain_part, 'A') || checkdnsrr($domain_part, 'AAAA'));
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
    メールアドレス：<input type="text" name="email">
  </p>
  <input type="submit" value="送信する">
</form>

</body>
</html>
