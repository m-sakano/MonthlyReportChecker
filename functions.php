<?php

function connectDb() {
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

function l($s) {
    $line = date('Y-m-d H:i:s') . " " . $_SESSION['me']['google_name'] . " " . $s . "\r\n";
    // error_log($line, 3, LOG_FILE);
    $_SESSION['msg'][] = $s;
}

/**
 * 指定したセルの文字列を取得する
 *
 * 色づけされたセルなどは cell->getValue()で文字列のみが取得できない
 * また、複数の配列に文字列データが分割されてしまうので、その部分も連結して返す
 *
 *
 * @param  $objCell Cellオブジェクト
 */
function getCellText($objCell = null)
{
     if (is_null($objCell)) {
         return false;
     }

     $txtCell = "";

     //まずはgetValue()を実行
     $valueCell = $objCell->getValue();

     if (is_object($valueCell)) {
         //オブジェクトが返ってきたら、リッチテキスト要素を取得
         $rtfCell = $valueCell->getRichTextElements();
         //配列で返ってくるので、そこからさらに文字列を抽出
         $txtParts = array();
         foreach ($rtfCell as $v) {
            $txtParts[] = $v->getText();
         }
         //連結する
         $txtCell = implode("", $txtParts);

     } else {
         if (!empty($valueCell)) {
             $txtCell = $valueCell;
         }
     }

     return $txtCell;
}

function strDate($read_date) {
    $display_date = PHPExcel_Style_NumberFormat::toFormattedString($read_date, PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
    return $display_date;
}

function strTime($read_date) {
    $display_date = PHPExcel_Style_NumberFormat::toFormattedString($read_date, PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME3);
    return $display_date;
}
