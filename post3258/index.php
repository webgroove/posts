<?php
echo '<pre>';
var_dump('random_bytes : ' . genRandomStr());
var_dump('random_int : ' . genRandomStr2());
var_dump('openssl_random_pseudo_bytes : ' . genRandomStr3());
if (function_exists('mcrypt_create_iv')) var_dump('mcrypt_create_iv : ' . genRandomStr4());
var_dump('mt_rand : ' . genRandomStr5());
var_dump('uniqid : ' . genRandomStr6());
var_dump('str_shuffle : ' . genRandomStr7());
var_dump('md5 : ' . genRandomStr8());
exit;

function genRandomStr(int $length = 8): string {
  return bin2hex(random_bytes($length));
}

function genRandomStr2(int $length = 16, string $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'): string {
  $str = '';
  $chars_length = mb_strlen($chars, '8bit') - 1;
  for ($i = 0; $i < $length; ++$i) $str .= $chars[random_int(0, $chars_length)];
  return $str;
}

function genRandomStr3(int $length = 8): string {
  return bin2hex(openssl_random_pseudo_bytes($length));
}

function genRandomStr4(int $length = 8): string {
  return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
}

function genRandomStr5(): string {
  return password_hash(mt_rand(), PASSWORD_DEFAULT);
}

function genRandomStr6(): string {
  return password_hash(uniqid('', true), PASSWORD_DEFAULT);
}

function genRandomStr7(int $length = 16, string $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'): string {
  return substr(str_shuffle($chars), 0, $length);
}

function genRandomStr8(): string {
  return bin2hex(md5(uniqid('', true), true));
}
