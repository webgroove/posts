<?php
function h(string $str): string {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function removeLineBreak(string $str): string {
  return str_replace(["\r\n", "\r", "\n"], '', $str);
}

function genToken(): string {
  return bin2hex(random_bytes(16));
}

function checkCharLimit(string $str, int $word_count): bool {
  return $word_count >= mb_strlen($str);
}

function checkKatakana(string $str): bool {
  return !!preg_match("/^[ァ-ヶー]+$/u", $str);
}

function checkTel(string $str): bool {
  return !!preg_match("/^0\d{1,4}-\d{1,4}-\d{3,4}\z/", $str);
}

function checkPostalCode(string $str): bool {
  return !!preg_match("/^\d{3}\-\d{4}$/", $str);
}

function checkEmail(string $email): bool {
  return !checkRfc822($email) || checkDomain($email);
}

function checkRfc822(string $email): bool {
  return !!filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_FLAG_EMAIL_UNICODE);
}

function checkDomain(string $email): bool {
  $email = explode('@', $email);
  $domain = array_pop($email);
  return checkdnsrr($domain) || checkdnsrr($domain, 'A') || checkdnsrr($domain, 'AAAA');
}

function uploadErrCodeToMessage(int $err_code): string {
  $message = '';

  switch ($err_code) {
    case UPLOAD_ERR_INI_SIZE:
    case UPLOAD_ERR_FORM_SIZE:
      $message = ATTACHMENT_ERR_1;
      break;
    case UPLOAD_ERR_PARTIAL:
      $message = ATTACHMENT_ERR_2;
      break;
    case UPLOAD_ERR_NO_TMP_DIR:
      $message = ATTACHMENT_ERR_3;
      break;
    case UPLOAD_ERR_CANT_WRITE:
      $message = ATTACHMENT_ERR_4;
      break;
    case UPLOAD_ERR_EXTENSION:
      $message = ATTACHMENT_ERR_5;
      break;
    default:
      $message = ATTACHMENT_ERR_6;
      break;
  }
  return $message;
}
