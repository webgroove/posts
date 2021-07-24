<?php
const COMPANY_NAME = '';
const ADMIN_MAIL_TO = '';
const UPLOAD_DIR = './uploads/';

const SUBJECT = 'ホームページよりお問い合わせがありました。';
const AUTO_REPLY_SUBJECT = 'お問い合わせありがとうございます。';

const OBJECTIVES = [
  '経理担当',
  '採掘担当',
  '建築担当',
  'インターン',
];

const MAX_FILE_SIZE = 200000;
const ACCEPT_FILE_EXTENSION = '.txt, .pdf, .ppt, .pptx, .xls, .xlsx, .zip, .rar';
const ACCEPT_MIME_TYPES = [
  'txt' => 'text/plain',
  'pdf' => 'application/pdf',
  'ppt' => 'application/vnd.ms-powerpoint',
  'xls' => 'application/vnd.ms-excel',
  'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
  'zip' => 'application/zip',
  'rar' => 'application/x-rar-compressed',
];

// エラーメッセージ一覧
const LAST_NAME_ERR_1 = '「姓」が未入力です。';
const LAST_NAME_ERR_2 = '「姓」は30文字以内です。';

const FIRST_NAME_ERR_1 = '「名」が未入力です。';
const FIRST_NAME_ERR_2 = '「名」は30文字以内です。';

const LAST_NAME_RUBY_ERR_1 = '「姓（フリガナ）」が未入力です。';
const LAST_NAME_RUBY_ERR_2 = '「姓（フリガナ）」は60文字以内です。';
const LAST_NAME_RUBY_ERR_3 = '「姓（フリガナ）」はカタカナで入力してください。';

const FIRST_NAME_RUBY_ERR_1 = '「名（フリガナ）」が未入力です。';
const FIRST_NAME_RUBY_ERR_2 = '「名（フリガナ）」は60文字以内です。';
const FIRST_NAME_RUBY_ERR_3 = '「名（フリガナ）」はカタカナで入力してください。。';

const JOB_ERR_1 = '「ご職業」は60文字以内です。';

const POSTAL_CODE_ERR_1 = '「郵便番号」が未入力です。';
const POSTAL_CODE_ERR_2 = '「郵便番号」はハイフン（-）と半角数字で入力してください。';

const STREET_ADDRESS_ERR_1 = '「ご住所」は200文字以内です。';

const TEL_ERR_1 = '「電話番号（半角）」は21文字以内です。';
const TEL_ERR_2 = '「電話番号（半角）」はハイフン（-）と半角数字で入力してください。';

const EMAIL_ERR_1 = '「メールアドレス（半角）」が未入力です。';
const EMAIL_ERR_2 = '「メールアドレス（半角）」は254文字以内です。';
const EMAIL_ERR_3 = '「メールアドレス（半角）」が正しくありません。';

const EMAIL_REINPUT_ERR_1 = '「メールアドレス再入力」が未入力です。';
const EMAIL_REINPUT_ERR_2 = '「メールアドレス再入力」は254文字以内です。';
const EMAIL_REINPUT_ERR_3 = '「メールアドレス再入力」が「メールアドレス（半角）」と一致しません。';

const ATTACHMENT_ERR_1 = '「添付資料」のファイルサイズが大きすぎます。';
const ATTACHMENT_ERR_2 = '「添付資料」のファイルが一部保存されませんでした。';
const ATTACHMENT_ERR_3 = '「添付資料」のテンポラリフォルダがありません。';
const ATTACHMENT_ERR_4 = '「添付資料」のディスクへの書き込みに失敗しました。';
const ATTACHMENT_ERR_5 = '「添付資料」のアップロードを拡張モジュールが中止しました。';
const ATTACHMENT_ERR_6 = '「添付資料」のアップロード中に予期せぬエラーが発生しました。';
const ATTACHMENT_ERR_7 = '「添付資料」のファイル形式が不正です。';
const ATTACHMENT_ERR_8 = '「添付資料」の保存時にエラーが発生しました。';

const DESIRED_DATE_ERR_1 = '「勤務開始希望時期」は100文字以内です。';

const INQUIRY_ERR_1 = '「お問い合わせ内容」が未入力です。';
const INQUIRY_ERR_2 = '「お問い合わせ内容」は1000文字以内です。';
