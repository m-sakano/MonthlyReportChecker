<?php

require_once('config.php');
require_once('functions.php');
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel/IOFactory.php';

session_start();

if (!isset($_SESSION['me'])) {
    header('Location: '.SITE_URL.'login.php');
    exit;
}

// Load Excel File
$inputFileName = $_SESSION['file'];
try {
    /** Load $inputFileName to a PHPExcel Object  **/
    $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(PHPExcel_Reader_Exception $e) {
    die('Error loading file: '.$e->getMessage());
}

// Database接続
$dbh = connectDb();

// 過去のレコードがあったら削除する
$sql = "delete from result where google_user_id = :id";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(":id" => $_SESSION['me']['google_user_id']));

// 勤務報告書(案件先)
// 読み込み
require_once('check_project_header.php');
// チェック

// ホーム画面へ飛ばす
header('Location: '.SITE_URL);

