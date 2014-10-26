<?php

require_once('config.php');
require_once('functions.php');

session_start();

if (!isset($_SESSION['me'])) {
    header('Location: '.SITE_URL.'login.php');
    exit;
}

// ファイルアップロード
if (is_uploaded_file($_FILES['upfile']['tmp_name'])) {
  if (move_uploaded_file($_FILES['upfile']['tmp_name'], 'files/' . $_FILES['upfile']['name'])) {
    chmod('files/' . $_FILES['upfile']['name'], 0644);
    l($_FILES['upfile']['name'] . 'をアップロードしました。');
    $_SESSION['file'] = 'files/' . $_FILES['upfile']['name'];
    // チェック画面へ飛ばす
	header('Location: '.SITE_URL.'reader.php');
  } else {
    l('ファイルをアップロードできません。');
    // ホーム画面へ飛ばす
	header('Location: '.SITE_URL);
  }
} else {
  l('ファイルが選択されていません。');
  // ホーム画面へ飛ばす
  header('Location: '.SITE_URL);
}
