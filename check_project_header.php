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

// DBconnect
if (is_null($dbh)) $dbh = connectDb();

// Excel読み込み
$objPHPExcel->setActiveSheetIndexByName('勤務報告書(案件先)');
$sheet = $objPHPExcel->getActiveSheet();

// -- 年月 一致チェック
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
$cellMonth = $cellDate[0]  . $cellDate[1];

if ($fileMonth !== $cellMonth) {
    m('ERROR','「勤務報告書（案件先）」シートの「年月」欄（'.$cellDate[0].$cellDate[1].'）がファイル名と一致しません。');
}

// -- 会社名 空欄チェック
if (getCellText($sheet->getCell('B2')) === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「会社名」欄が空欄です。');
}

m('INFO', 'GOOD');

/*
// -- 部署 空欄チェック 一致チェック
$t = getCellText($sheet->getCell('B3'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「部署」欄が空欄です。');
} elseif ($t !== $names[1] ) {
    m('ERROR','「勤務報告書（案件先）」シートの「部署」欄（'.$t.'）がファイル名と一致しません。');
}
*/


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

