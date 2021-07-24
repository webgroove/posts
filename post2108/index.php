<?php
require_once __DIR__ . '/constants.php';

header('X-Frame-Options: DENY');
?>

<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link href="style.css" rel="stylesheet">
<script src="send_mail.js" defer></script>
</head>
<body>

<h1>お問い合わせ</h1>
<form id="form" enctype="multipart/form-data">
  <table>
    <tr>
      <th>お名前<span class="required"></span></th>
      <td>
        <div>
          <input type="text" id="lastName" name="lastName" placeholder="姓">
          <input type="text" id="firstName" name="firstName" placeholder="名">
        </div>
      </td>
    </tr>
    <tr>
      <th>お名前（フリガナ）<span class="required"></span></th>
      <td>
        <div>
          <input type="text" id="lastNameRuby" name="lastNameRuby" placeholder="セイ"> 
          <input type="text" id="firstNameRuby" name="firstNameRuby" placeholder="メイ">
        </div>
      </td>
    </tr>
    <tr>
      <th>ご職業</th>
      <td>
        <input type="text" id="job" name="job">
      </td>
    </tr>
    <tr>
      <th>郵便番号（半角）<span class="required"></span></th>
      <td>
        <input type="text" id="postalCode" name="postalCode" placeholder="例）000-0000">
      </td>
    </tr>
    <tr>
      <th>ご住所</th>
      <td>
        <input type="text" id="streetAddress" name="streetAddress">
      </td>
    </tr>
    <tr>
      <th>電話番号（半角）</th>
      <td>
        <input type="tel" id="tel" name="tel" placeholder="例）000-0000-0000">
      </td>
    </tr>
    <tr>
      <th>メールアドレス（半角）<span class="required"></span></th>
      <td>
        <input type="email" id="email" name="email">
      </td>
    </tr>
    <tr>
      <th>メールアドレス再入力<span class="required"></span></th>
      <td>
        <input type="email" id="reinputEmail" name="reinputEmail">
      </td>
    </tr>
    <tr>
      <th>応募職種（複数選択可）</th>
      <td>
        <ul>
          <?php foreach (OBJECTIVES as $index => $objective): ?>
            <li>
              <input type="checkbox" id="objective<?= $index ?>" name="objectives[]" class="objective" value="<?= $objective ?>">
              <label for="objective<?= $index ?>"><?= $objective ?></label>
            </li>
          <?php endforeach; ?>
        </ul>
      </td>
    </tr>
    <tr>
      <th>添付資料</th>
      <td>
        <label for="attachment">
          <input type="hidden" name="MAX_FILE_SIZE" value="<?= MAX_FILE_SIZE ?>"/>
          <input type="file" id="attachment" name="attachment" accept="<?= ACCEPT_FILE_EXTENSION ?>">
        </label>
      </td>
    </tr>
    <tr>
      <th>勤務開始希望日</th>
      <td>
        <input type="text" id="desiredDate" name="desiredDate">
      </td>
    </tr>
    <tr>
      <th>お問い合わせ内容<span class="required"></span></th>
      <td>
        <textarea id="inquiry" name="inquiry" rows="5" cols="40"></textarea>
      </td>
    </tr>
  </table>
</form>

<div class="button-wrapper">
  <button id="confirmButton">確認する</button>
</div>

<div id="overlay" class="overlay"></div>

<div id="confirmModal" class="modal-confirm">
  <table>
    <tr>
      <th>お名前</th>
      <td id="confirmName"></td>
    </tr>
    <tr>
      <th>お名前（フリガナ）</th>
      <td id="confirmRuby"></td>
    </tr>
    <tr>
      <th>ご職業</th>
      <td id="confirmJob"></td>
    </tr>
    <tr>
      <th>郵便番号（半角）</th>
      <td id="confirmPostalCode"></td>
    </tr>
    <tr>
      <th>ご住所</th>
      <td id="confirmStreetAddress"></td>
    </tr>
    <tr>
      <th>電話番号（半角）</th>
      <td id="confirmTel"></td>
    </tr>
    <tr>
      <th>メールアドレス</th>
      <td id="confirmEmail"></td>
    </tr>
    <tr>
      <th>応募職種</th>
      <td id="confirmObjective"></td>
    </tr>
    <tr>
      <th>添付資料</th>
      <td id="confirmAttachment"></td>
    </tr>
    <tr>
      <th>勤務開始希望時期</th>
      <td id="confirmDesiredDate"></td>
    </tr>
    <tr>
      <th>お問い合わせ内容</th>
      <td id="confirmInquiry"></td>
    </tr>
    <input type="hidden" id="csrfToken">
  </table>
  <div class="button-wrapper">
    <button id="backButton">閉じる</button>
    <button id="sendButton">送信する</button>
  </div>
</div>

<div id="completeModal" class="modal-complete">
  <p>送信が完了しました。</p>
  <div class="button-wrapper">
    <button id="completeButton">完了</button>
  </div>
</div>

</body>
</html>