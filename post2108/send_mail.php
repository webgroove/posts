<?php
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/functions.php';

session_start();

$confirm_flag = $_POST['confirmFlag'] ?? false;
$send_flag = $_POST['sendFlag'] ?? false;

if ($confirm_flag) {
  $err_msgs = [];
  $csrf_token = '';

  $last_name = h($_POST['lastName'] ?? '');
  $first_name = h($_POST['firstName'] ?? '');
  $last_name_ruby = h($_POST['lastNameRuby'] ?? '');
  $first_name_ruby = h($_POST['firstNameRuby'] ?? '');
  $job = h($_POST['job'] ?? '');
  $postal_code = h($_POST['postalCode'] ?? '');
  $street_address = h($_POST['streetAddress'] ?? '');
  $tel = h($_POST['tel'] ?? '');
  $email = removeLineBreak(h($_POST['email'] ?? ''));
  $reinput_email = removeLineBreak(h($_POST['reinputEmail'] ?? ''));
  $objectives = $_POST['objectives'] ?? [];
  $objectives = array_map('h', $objectives);
  $attachment = $_FILES['attachment'] ?? '';
  $desired_date = h($_POST['desiredDate'] ?? '');
  $inquiry = h($_POST['inquiry'] ?? '');

  if (!$last_name) $err_msgs['last_name'] = LAST_NAME_ERR_1;
  elseif (!checkCharLimit($last_name, 30)) $err_msgs['last_name'] = LAST_NAME_ERR_2;

  if (!$first_name) $err_msgs['first_name'] = FIRST_NAME_ERR_1;
  elseif (!checkCharLimit($first_name, 30)) $err_msgs['first_name'] = FIRST_NAME_ERR_2;

  if (!$last_name_ruby) $err_msgs['last_name_ruby'] = LAST_NAME_RUBY_ERR_1;
  elseif (!checkCharLimit($last_name_ruby, 60)) $err_msgs['last_name_ruby'] = LAST_NAME_RUBY_ERR_2;
  elseif (!checkKatakana($last_name_ruby)) $err_msgs['last_name_ruby'] = LAST_NAME_RUBY_ERR_3;

  if (!$first_name_ruby) $err_msgs['first_name_ruby'] = FIRST_NAME_RUBY_ERR_1;
  elseif (!checkCharLimit($first_name_ruby, 60)) $err_msgs['first_name_ruby'] = FIRST_NAME_RUBY_ERR_2;
  elseif (!checkKatakana($first_name_ruby)) $err_msgs['first_name_ruby'] = FIRST_NAME_RUBY_ERR_3;

  if (!checkCharLimit($job, 60)) $err_msgs['job'] = JOB_ERR_1;

  if (!$postal_code) $err_msgs['postal_code'] = POSTAL_CODE_ERR_1;
  elseif (!checkPostalCode($postal_code)) $err_msgs['postal_code'] = POSTAL_CODE_ERR_2;

  if (!checkCharLimit($street_address, 200)) $err_msgs['street_address'] = STREET_ADDRESS_ERR_1;

  if (!checkCharLimit($tel, 21)) $err_msgs['tel'] = TEL_ERR_1;
  elseif (!checkTel($tel)) $err_msgs['tel'] = TEL_ERR_2;

  if (!$email) $err_msgs['email'] = EMAIL_ERR_1;
  elseif (!checkCharLimit($email, 254)) $err_msgs['email'] = EMAIL_ERR_2;
  elseif (!checkEmail($email)) $err_msgs['email'] = EMAIL_ERR_3;

  if (!$reinput_email) $err_msgs['reinput_email'] = EMAIL_REINPUT_ERR_1;
  elseif (!checkCharLimit($reinput_email, 254)) $err_msgs['reinput_email'] = EMAIL_REINPUT_ERR_2;
  elseif ($reinput_email !== $email) $err_msgs['reinput_email'] = EMAIL_REINPUT_ERR_3;

  if (!checkCharLimit($desired_date, 100)) $err_msgs['desired_date'] = DESIRED_DATE_ERR_1;

  if (!$inquiry) $err_msgs['inquiry'] = INQUIRY_ERR_1;
  elseif (!checkCharLimit($inquiry, 1000)) $err_msgs['inquiry'] = INQUIRY_ERR_2;

  $download_link = '';
  if ($attachment['error'] === UPLOAD_ERR_OK) {
    if (!$extension = array_search(mime_content_type($attachment['tmp_name']), ACCEPT_MIME_TYPES, true)) $err_msgs['attachment'] = ATTACHMENT_ERR_7;
    elseif (!is_uploaded_file($attachment['tmp_name'])) $err_msgs['attachment'] = ATTACHMENT_ERR_8;
    else {
      $filename = genToken() . '.' . $extension;
      move_uploaded_file($attachment['tmp_name'], UPLOAD_DIR . $filename);
      chmod(UPLOAD_DIR . $filename, 0644);
      $download_link = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/download.php?fn=' . $filename . '&mt=' . ACCEPT_MIME_TYPES[$extension];
    }
  } elseif ($attachment['error'] !== UPLOAD_ERR_NO_FILE) $err_msgs['attachment'] = uploadErrCodeToMessage($attachment['error']);

  if (!$err_msgs) {
    $csrf_token = genToken();

    $_SESSION['csrf_token'] = $csrf_token;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name_ruby'] = $last_name_ruby;
    $_SESSION['first_name_ruby'] = $first_name_ruby;
    $_SESSION['job'] = $job;
    $_SESSION['postal_code'] = $postal_code;
    $_SESSION['street_address'] = $street_address;
    $_SESSION['tel'] = $tel;
    $_SESSION['email'] = $email;
    $_SESSION['objectives'] = $objectives;
    $_SESSION['filename'] = h($attachment['name'] ?? '');
    $_SESSION['download_link'] = $download_link;
    $_SESSION['desired_date'] = $desired_date;
    $_SESSION['inquiry'] = $inquiry;
  }

  header('Content-type: application/json');
  echo json_encode([
    'err_msgs' => join("\n", $err_msgs),
    'csrf_token' => $csrf_token
  ]);

} elseif ($send_flag && $_SESSION['csrf_token'] === $_POST['csrfToken']) {

  mb_language('ja');
  mb_internal_encoding('UTF-8');

  $last_name = $_SESSION['last_name'] ?? '';
  $first_name = $_SESSION['first_name'] ?? '';
  $last_name_ruby = $_SESSION['last_name_ruby'] ?? '';
  $first_name_ruby = $_SESSION['first_name_ruby'] ?? '';
  $job = $_SESSION['job'] ?? '';
  $postal_code = $_SESSION['postal_code'] ?? '';
  $street_address = $_SESSION['street_address'] ?? '';
  $tel = $_SESSION['tel'] ?? '';
  $email = $_SESSION['email'] ?? '';
  $objectives = implode(', ', $_SESSION['objectives'] ?? []);
  $filename = $_SESSION['filename'] ?? '';
  $download_link = $_SESSION['download_link'] ?? '';
  $desired_hire_time = $_SESSION['desired_date'] ?? '';
  $inquiry = $_SESSION['inquiry'] ?? '';

  date_default_timezone_set('Asia/Tokyo');
  $date = date("Y-m-d H:i");

  $search = [
    '$日時$',
    '$姓$',
    '$名$',
    '$セイ$',
    '$メイ$',
    '$職業$',
    '$郵便番号$',
    '$住所$',
    '$電話番号$',
    '$メールアドレス$',
    '$応募職種$',
    '$添付資料名$',
    '$添付資料のダウンロードリンク$',
    '$勤務開始希望時期$',
    '$お問い合わせ内容$',
  ];
  $replace = [
    $date,
    $last_name,
    $first_name,
    $last_name_ruby,
    $first_name_ruby,
    $job,
    $postal_code,
    $street_address,
    $tel,
    $email,
    $objectives,
    $filename,
    $download_link,
    $desired_hire_time,
    $inquiry,
  ];
  $mail_template = file_get_contents(__DIR__ . '/mail_template.php');
  $body = str_replace($search, $replace, $mail_template);

  $inquirer = mb_encode_mimeheader($last_name . ' ' . $first_name) . ' <' . $email . '>';
  $headers = [
    'MIME-Version' => '1.0',
    'Content-Transfer-Encoding' => '7bit',
    'Content-Type' => 'text/plain',
    'From' => $inquirer,
    'Sender' => $inquirer,
    'Reply-To' => ADMIN_MAIL_TO,
    'X-Priority' => '3',
  ];

  mb_send_mail(ADMIN_MAIL_TO, SUBJECT, $body, $headers);

  $auto_reply_search = [
    '$日時$',
    '$姓$',
    '$名$',
    '$セイ$',
    '$メイ$',
    '$職業$',
    '$郵便番号$',
    '$住所$',
    '$電話番号$',
    '$メールアドレス$',
    '$応募職種$',
    '$添付資料名$',
    '$勤務開始希望時期$',
    '$お問い合わせ内容$',
  ];
  $auto_reply_replace = [
    $date,
    $last_name,
    $first_name,
    $last_name_ruby,
    $first_name_ruby,
    $job,
    $postal_code,
    $street_address,
    $tel,
    $email,
    $objectives,
    $filename,
    $desired_hire_time,
    $inquiry,
  ];
  $auto_reply_mail_template = file_get_contents(__DIR__ . '/auto_reply_mail_template.php');
  $auto_reply_body = str_replace($auto_reply_search, $auto_reply_replace, $auto_reply_mail_template);

  $auto_reply_sender = mb_encode_mimeheader(COMPANY_NAME) . ' <' . ADMIN_MAIL_TO . '>';

  $auto_reply_headers = [
    'MIME-Version' => '1.0',
    'Content-Transfer-Encoding' => '7bit',
    'Content-Type' => 'text/plain',
    'From' => $auto_reply_sender,
    'Sender' => $auto_reply_sender,
    'Reply-To' => $email,
    'Organization' => COMPANY_NAME,
    'X-Priority' => '3',
  ];

  mb_send_mail($email, AUTO_REPLY_SUBJECT, $auto_reply_body, $auto_reply_headers);

  session_destroy();
}
