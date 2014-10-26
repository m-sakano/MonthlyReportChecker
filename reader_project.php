<?php

require_once('config.php');
require_once('functions.php');
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel/IOFactory.php';

session_start();

if (!isset($_SESSION['me'])) {
    header('Location: '.SITE_URL.'login.php');
    exit;
}

// 勤務報告書(案件先)
// 過去のレコードがあったら削除する
$sql = "delete from project_sheet where google_email = :email";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(":email" => $_SESSION['me']['google_email']));

$sql = "delete from project_worktime where google_email = :email";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(":email" => $_SESSION['me']['google_email']));

// Excel読み込み
$objPHPExcel->setActiveSheetIndexByName('勤務報告書(案件先)');
$sheet = $objPHPExcel->getActiveSheet();

// Table書き込み
$sql = "insert into project_sheet
        (report_month, report_company, report_organization, report_name, report_timeunit, report_begintime, report_endtime,
        report_intervaltime, project_name, project_company, google_email, created, modified)
        values
        (:report_month, :report_company, :report_organization, :report_name, :report_timeunit, :report_begintime, :report_endtime,
        :report_intervaltime, :project_name, :project_company, :google_email, now(), now())";
$stmt = $dbh->prepare($sql);
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
$stmt->execute($params);

// Table内容表示
$sql = "select * from project_sheet where google_email = :google_email limit 1";
$stmt = $dbh->prepare($sql);
$params = array( ":google_email" => $_SESSION['me']['google_email'] );
$stmt->execute($params);
$record = $stmt->fetch();
foreach ($record as $r) {
	l($r);
}
l('reader_project.php DONE.');
