<?php

require_once('config.php');
require_once('functions.php');
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel/IOFactory.php';

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
  } else {
    l('ファイルをアップロードできません。');
  }
} else {
  l('ファイルが選択されていません。');
}

// ホーム画面へ飛ばす
header('Location: '.SITE_URL);
