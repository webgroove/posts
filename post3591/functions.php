<?php
function h(string $str): string {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function genToken(int $length = 16): string {
  return bin2hex(random_bytes($length));
}

function checkCharCount(string $str, int $count): bool {
  return  mb_strlen($str) <= $count;
}

function checkEmail(string $email): bool {
  $array = explode('@', $email);
  $domain_part = array_pop($array);

  return filter_var($email, FILTER_VALIDATE_EMAIL) !== false &&
    (checkdnsrr($domain_part) || checkdnsrr($domain_part, 'A') || checkdnsrr($domain_part, 'AAAA'));
}

function sendEmail(string $from, string $to, string $subject, string $mail_template_path, array $search, array $replace): bool {
  ob_start();
  include $mail_template_path;
  $mail_template = ob_get_contents();
  ob_end_clean();

  $body = str_replace($search, $replace, $mail_template);

  $headers = [
    'From' => $from,
    'Reply-To' => $from,
  ];

  mb_language('ja');
  mb_internal_encoding('UTF-8');
  return mb_send_mail($to, $subject, $body, $headers);
}
