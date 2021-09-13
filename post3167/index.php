<?php
$to = '';
$subject = 'メールの送信テストです。';

$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if ($email && $message) {

  if (checkEmail($email)) {
    if (sendEmail($email, $to, $subject, $message)) echo 'メールの送信に成功しました。';
    else echo 'メールの送信に失敗しました。';
  } else echo 'メールアドレスが正しくありません。';
}

function sendEmail(string $from, string $to, string $subject, string $message): bool {
  ob_start();
  include __DIR__ . '/mail.tpl';
  $mail_template = ob_get_contents();
  ob_end_clean();

  $search = ['{{メールアドレス}}', '{{お問い合わせ内容}}'];
  $replace = [$from, $message];
  $body = str_replace($search, $replace, $mail_template);

  $headers = [
    'From' => $from,
    'Reply-To' => $from,
  ];

  mb_language('ja');
  mb_internal_encoding('UTF-8');
  return mb_send_mail($to, $subject, $body, $headers);
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
  <p>
    お問い合わせ内容：<textarea name="message"></textarea>
  </p>
  <input type="submit" value="送信する">
</form>

</body>
</html>
