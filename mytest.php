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

m('INFO', '---- 「勤務報告書（案件先）」シートのチェック開始 ----');

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

// -- 部署 空欄チェック 一致チェック
$t = getCellText($sheet->getCell('B3'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「部署」欄が空欄です。');
} elseif ($t !== $names[1] ) {
    m('ERROR','「勤務報告書（案件先）」シートの「部署」欄（'.$t.'）がファイル名と一致しません。');
}

// -- 名前 空欄チェック 一致チェック
$t = getCellText($sheet->getCell('B4'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「名前」欄が空欄です。');
} elseif ($t !== str_replace(" ", "", $names[2]) && $t !== str_replace("　", "", $names[2])) {
    m('ERROR','「勤務報告書（案件先）」シートの「名前」欄（'.$t.'）がファイル名と一致しません。');
}


// -- あああああ 空欄チェック
$t = getCellText($sheet->getCell('Z5'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「あああああ」欄が空欄です。');
}

// -- 始業時刻 空欄チェック
$t = getCellText($sheet->getCell('Z9'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「始業時刻」欄が空欄です。');
}

// -- 終業時刻 空欄チェック
$t = getCellText($sheet->getCell('Z9'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「終業時刻」欄が空欄です。');
}

// -- ああああああ 空欄チェック
$t = getCellText($sheet->getCell('Z9'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「あああああああ」欄が空欄です。');
}

// -- 休憩時刻 空欄チェック
$t = getCellText($sheet->getCell('H2'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「休憩時刻」欄が空欄です。');
}

// -- 休憩時間帯 空欄チェック
$t = getCellText($sheet->getCell('K2'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「休憩時間帯」欄が空欄です。');
}

// -- 就業先企業名 空欄チェック
$t = getCellText($sheet->getCell('G3'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「就業先企業名」欄が空欄です。');
}

// -- 計算時間単位 空欄チェック
$t = getCellText($sheet->getCell('G2'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「計算時間単位」欄が空欄です。');
}

// -- 始業時刻 空欄チェック
$t = getCellText($sheet->getCell('I2'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「始業時刻」欄が空欄です。');
}

// -- 終業時刻 空欄チェック
$t = getCellText($sheet->getCell('K2'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「終業時刻」欄が空欄です。');
}

// -- 休憩時刻 空欄チェック
$t = getCellText($sheet->getCell('Z2'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「休憩時刻」欄が空欄です。');
}

// -- 休憩時刻 空欄チェック
$t = getCellText($sheet->getCell('ZZ'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「あああああああ」欄が空欄です。');
}

// -- 休憩時間帯 空欄チェック
$t = getCellText($sheet->getCell('ZZ'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「ああああ」欄が空欄です。');
}

// -- 就業先企業名 空欄チェック
$t = getCellText($sheet->getCell('ZZ'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「あああああああ」欄が空欄です。');
}

// -- プロジェクト名 空欄チェック
$t = getCellText($sheet->getCell('ZZ'));
if ($t === "") {
    m('ERROR','「勤務報告書（案件先）」シートの「あああああああ」欄が空欄です。');
}

m('INFO', '---- 「勤務報告書（案件先）」シートのチェック完了 ----');
