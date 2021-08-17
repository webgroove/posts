<?php
$land_line = $_POST['landline'] ?? '';
$phone_number = $_POST['phoneNumber'] ?? '';
$freephone_number = $_POST['freephoneNumber'] ?? '';
$phone_number_2 = $_POST['phoneNumber2'] ?? '';
$phone_number_3 = $_POST['phoneNumber3'] ?? '';

if ($land_line) {

  if (!checkLandline($land_line)) echo '<p>固定電話番号の入力チェック結果 : NG</p>';
  else echo '<p>固定電話番号の入力チェック結果 : OK</p>';
}

if ($phone_number) {

  if (!checkPhoneNumber($phone_number)) echo '<p>携帯電話番号の入力チェック結果 : NG</p>';
  else echo '<p>携帯電話番号の入力チェック結果 : OK</p>';
}

if ($freephone_number) {

  if (!checkFreephoneNumber($freephone_number)) echo '<p>フリーダイヤルの入力チェック結果 : NG</p>';
  else echo '<p>フリーダイヤルの入力チェック結果 : OK</p>';
}

if ($phone_number_2) {

  if (!checkPhoneNumber2($phone_number_2)) echo '<p>固定電話番号 + 携帯電話番号の入力チェック結果 : NG</p>';
  else echo '<p>固定電話番号 + 携帯電話番号の入力チェック結果 : OK</p>';
}

if ($phone_number_3) {

  if (!checkPhoneNumber3($phone_number_3)) echo '<p>固定電話番号 + 携帯電話番号 + フリーダイヤルの入力チェック結果 : NG</p>';
  else echo '<p>固定電話番号 + 携帯電話番号 + フリーダイヤルの入力チェック結果 : OK</p>';
}

function checkLandline(string $str): int|false {
  return preg_match("/\A0(\d{1}[-(]?\d{4}|\d{2}[-(]?\d{3}|\d{3}[-(]?\d{2}|\d{4}[-(]?\d{1})[-)]?\d{4}\z/", $str);
}

function checkPhoneNumber(string $str): int|false {
  return preg_match("/\A0[5789]0[-(]?\d{4}[-)]?\d{4}\z/", $str);
}

function checkFreephoneNumber(string $str): int|false {
  return preg_match("/\A0((12|99|18|57)0[-(]?\d{3}[-)]?\d{3}|800[-(]?\d{3}[-)]?\d{4})\z/", $str);
}

function checkPhoneNumber2(string $str): int|false {
  return preg_match("/\A0(\d{1}[-(]?\d{4}|\d{2}[-(]?\d{3}|\d{3}[-(]?\d{2}|\d{4}[-(]?\d{1}|[5789]0[-(]?\d{4})[-)]?\d{4}\z/", $str);
}

function checkPhoneNumber3(string $str): int|false {
  return preg_match("/\A0((\d{1}[-(]?\d{4}|\d{2}[-(]?\d{3}|\d{3}[-(]?\d{2}|\d{4}[-(]?\d{1}|[5789]0[-(]?\d{4}|800[-(]?\d{3})[-)]?\d{4}|(12|99|18|57)0[-(]?\d{3}[-)]?\d{3})\z/", $str);
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
    固定電話番号：<input type="tel" name="landline" placeholder="03-1234-5678">
  </p>
  <p>
    携帯電話番号：<input type="tel" name="phoneNumber" placeholder="080-1234-5678">
  </p>
  <p>
    フリーダイヤル：<input type="tel" name="freephoneNumber" placeholder="0120-123-456">
  </p>
  <p>
    固定電話番号 + 携帯電話番号：<input type="tel" name="phoneNumber2">
  </p>
  <p>
    固定電話番号 + 携帯電話番号 + フリーダイヤル：<input type="tel" name="phoneNumber3">
  </p>
  <input type="submit" value="送信する">
</form>

</body>
</html>
