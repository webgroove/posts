<?php
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/functions.php';

session_start();

$confirm_flag = $_POST['confirmFlag'] ?? false;
$send_flag = $_POST['sendFlag'] ?? false;

if ($confirm_flag) {
  $email = $_POST['email'] ?? '';
  $message = $_POST['message'] ?? '';
  $err_msgs = [];

  if (!$email) $err_msgs[] = EMAIL_ERR_1;
  elseif (!checkEmail($email)) $err_msgs[] = EMAIL_ERR_2;

  if (!$message) $err_msgs[] = MESSAGE_ERR_1;
  elseif (!checkCharCount($message, 1000)) $err_msgs[] = MESSAGE_ERR_2;

  if (!$err_msgs) {
    $_SESSION['email'] = $email;
    $_SESSION['message'] = $message;
    $_SESSION['csrf_token'] = genToken();
  }

  header('Content-type: application/json');
  echo json_encode([
    'email' => h($email),
    'message' => h($message),
    'err_msg' => join("\n", $err_msgs),
    'csrf_token' => $_SESSION['csrf_token'] ?? '',
  ]);

} elseif ($send_flag && $_SESSION['csrf_token'] === $_POST['csrfToken']) {
  $email = $_SESSION['email'] ?? '';
  $message = $_SESSION['message'] ?? '';
  $err_msg = '';

  $mail_template_path = __DIR__ . '/mail.tpl';
  $search = ['{{メールアドレス}}', '{{アンケート内容}}'];
  $replace = [$email, $message];

  if (!sendEmail($email, ADMIN_EMAIL, SUBJECT, $mail_template_path, $search, $replace))
    $err_msg = SEND_EMAIL_ERR;

  session_destroy();

  header('Content-type: application/json');
  echo json_encode(['err_msg' => $err_msg]);
}
