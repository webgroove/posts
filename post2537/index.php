<?php
$inquiry = $_POST['inquiry'] ?? '';
$msg = '';

if (!checkCharCount($inquiry, 200)) $msg = 'お問い合わせ内容は200文字以内です。';

function checkCharCount(string $str, int $count): bool {
  return  mb_strlen($str) <= $count;
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
<p><?= $msg ?></p>

</body>
</html>