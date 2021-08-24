<?php
$cn = $_POST['convertNewline'] ?? '';
$rn = $_POST['removeNewline'] ?? '';

if ($cn || $rn) {
  $cn_after = convertNewline($cn);
  $rn_after = removeNewline($rn);

  echo '<p>改行変換 : ', $cn_after, ' / 変換前16進表現 : ', bin2hex($cn), '/ 変換後16進表現 : ', bin2hex($cn_after), '</p>';
  echo '<p>改行削除 : ', $rn_after, ' / 削除前16進表現 : ', bin2hex($rn), '/ 削除後16進表現 : ', bin2hex($rn_after), '</p>';
}

function convertNewline(string $str): string {
  return str_replace(["\r\n", "\r"], "\n", $str);
}

function removeNewline(string $str): string {
  return str_replace(["\r\n", "\r", "\n"], '', $str);
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
    改行変換：<textarea name="convertNewline"></textarea>
  </p>
  <p>
    改行削除：<textarea name="removeNewline"></textarea>
  </p>
  <input type="submit" value="送信する">
</form>

</body>
</html>
