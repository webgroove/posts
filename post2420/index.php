<?php
const MAX_FILE_SIZE = 1000000; // 1メガバイト
const ACCEPT_MIME_TYPES = [
  'zip' => 'application/zip',
  'rar' => 'application/x-rar-compressed',
];

const UPLOAD_DIR = './uploads/';
const UPLOAD_ERR_OK_MSG = 'ファイルが正常にアップロードされました。';
const UPLOAD_ERR_MSG_1 = 'ファイルのサイズが大きすぎます。';
const UPLOAD_ERR_MSG_2 = 'ファイルの拡張子が不正です。';
const UPLOAD_ERR_MSG_3 = '有効なファイルではありません。';
const UPLOAD_ERR_MSG_4 = 'ファイルの一部が保存されませんでした。';
const UPLOAD_ERR_MSG_5 = 'ファイルが選択されていません。';
const UPLOAD_ERR_MSG_6 = 'テンポラリフォルダがありません。';
const UPLOAD_ERR_MSG_7 = 'ディスクへの書き込みに失敗しました。';
const UPLOAD_ERR_MSG_8 = 'ファイルのアップロードを拡張モジュールが中止しました。';
const UPLOAD_ERR_MSG_9 = 'アップロード中に予期せぬエラーが発生しました。';

$file = $_FILES['upfile'] ?? null;
$file_tmp_name = $file['tmp_name'] ?? null;
$file_upload_err = $file['error'] ?? null;
$file_size = $file['size'] ?? null;
$file_upload_msg = '';

if ($file) {
  if ($file_upload_err === UPLOAD_ERR_OK) {

    if ($file_size > MAX_FILE_SIZE) $file_upload_msg = UPLOAD_ERR_MSG_1;
    elseif (!$file_extension = array_search(mime_content_type($file_tmp_name), ACCEPT_MIME_TYPES, true)) $file_upload_msg = UPLOAD_ERR_MSG_2;
    else {

      $file_name = bin2hex(random_bytes(16)) . '.' . $file_extension;
      if (move_uploaded_file($file_tmp_name, UPLOAD_DIR . $file_name)) {
        chmod(UPLOAD_DIR . $file_name, 0644);
        $file_upload_msg = UPLOAD_ERR_OK_MSG;
      } else $file_upload_msg = UPLOAD_ERR_MSG_3;
    }
  } else {

    switch ($file_upload_err) {
      case UPLOAD_ERR_INI_SIZE:
      case UPLOAD_ERR_FORM_SIZE:
        $file_upload_msg = UPLOAD_ERR_MSG_1;
        break;
      case UPLOAD_ERR_PARTIAL:
        $file_upload_msg = UPLOAD_ERR_MSG_4;
        break;
      case UPLOAD_ERR_NO_FILE:
        $file_upload_msg = UPLOAD_ERR_MSG_5;
        break;
      case UPLOAD_ERR_NO_TMP_DIR:
        $file_upload_msg = UPLOAD_ERR_MSG_6;
        break;
      case UPLOAD_ERR_CANT_WRITE:
        $file_upload_msg = UPLOAD_ERR_MSG_7;
        break;
      case UPLOAD_ERR_EXTENSION:
        $file_upload_msg = UPLOAD_ERR_MSG_8;
        break;
      default:
        $file_upload_msg = UPLOAD_ERR_MSG_9;
        break;
    }
  }
}

?>

<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
</head>
<body>

<form enctype="multipart/form-data" method="post">
  <input type="file" name="upfile" accept=".zip, .rar">
  <input type="submit" value="送信する">
</form>
<p><?= $file_upload_msg ?></p>

</body>
</html>