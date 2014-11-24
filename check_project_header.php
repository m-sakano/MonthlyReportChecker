<?php

require_once('config.php');
require_once('functions.php');
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel/IOFactory.php';

session_start();

if (!isset($_SESSION['me'])) {
    header('Location: '.SITE_URL.'login.php');
    exit;
}

// 勤務報告書(案件先)ヘッダチェック


// Excel読み込み
$objPHPExcel->setActiveSheetIndexByName('勤務報告書(案件先)');
$sheet = $objPHPExcel->getActiveSheet();

// 月チェック
// ファイルから年月を取り出し
    // ファイル名（パスを除く）の取り出し
$inputFileName = basename($_SESSION['file']);
    // 拡張子（.xls, xlsx）の取り外し
$fileName = preg_split('/\./', $inputFileName);
    // ファイル名を'_'で分割
$names = preg_split('/_/', $fileName[0]);
$fileMonth = $names[3];
// セルから年月（YYYYMM）を取り出し
$cellDate = preg_split('/\-/', strDate(getCellText($sheet->getCell('N1'))));
$cellMonth = $cellDate[0] . $cellDate[1];

if ($fileMonth !== $cellMonth) {
    m('ERROR','OTL');
}
m('INFO','GOOD');

/*
$params = array(
    ":report_month" => strDate(getCellText($sheet->getCell('N1'))),
    ":report_company" => getCellText($sheet->getCell('B2')), 
    ":report_organization" => getCellText($sheet->getCell('B3')), 
    ":report_name" => getCellText($sheet->getCell('B4')), 
    ":report_timeunit" => strTime(getCellText($sheet->getCell('G2'))), 
    ":report_begintime" => strTime(getCellText($sheet->getCell('I2'))), 
    ":report_endtime" => strTime(getCellText($sheet->getCell('K2'))),
    ":report_intervaltime" => strTime(getCellText($sheet->getCell('M2'))), 
    ":project_name" => getCellText($sheet->getCell('G3')), 
    ":project_company" => getCellText($sheet->getCell('G4')), 
    ":google_email" => $_SESSION['me']['google_email']
);
*/



l('check_project_header.php DONE.');
