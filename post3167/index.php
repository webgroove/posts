<?php
$to = 'test@example.com';
$subject = 'メールの送信テストです。';

$from = $_POST['from'] ?? '';
$message = $_POST['message'] ?? '';

if ($from && $message) {

  if (sendEmail($from, $to, $subject, $message)) echo 'メールの送信に成功しました。';
  else echo 'メールの送信に失敗しました。';
}

function sendEmail(string $from, string $to, string $subject, string $message): bool {
  mb_language('ja');
  mb_internal_encoding('UTF-8');

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
  return mb_send_mail($to, $subject, $body, $headers);
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
    メールアドレス：<input type="text" name="from">
  </p>
  <p>
    お問い合わせ内容：<textarea name="message"></textarea>
  </p>
  <input type="submit" value="送信する">
</form>

</body>
</html>
