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
 * データベースにメッセージを書き込む
 * $p   プライオリティ(INFO, WORNING, ERROR)
 * $s   メッセージテキスト
 */
function m($p, $s) {
    $dbh = connectDb();
    $sql = "insert into result
            (google_user_id, priority, message, created, modified)
            values
            (:id, :priority, :message, now(), now())";
    $stmt = $dbh->prepare($sql);
    $params = array(
        ":id" => $_SESSION['me']['google_user_id'],
        ":priority" => $p,
        ":message" => $s
    );
    $stmt->execute($params);
}

/**
 * メッセージをテーブルで表示する
 * 
 */
function showMessages() {

    $dbh = connectDb();
    $sql = "select
            priority, message, created
            from result
            where google_user_id = :id";
    $stmt = $dbh->prepare($sql);
    $params = array(":id" => $_SESSION['me']['google_user_id']);
    $stmt->execute($params);

    echo '<table class="table table-striped table-bordered">';
    echo '<thead>';
    echo '<tr><th>PRIORITY</th><th>MESSAGES</th><th>LAST CHECK</th></tr>';
    echo '</thead>';
    echo '<tbody>';
    while($record = $stmt->fetch()) {
        echo '<tr>';
        echo '<td>'.$record[0].'</td>';
        echo '<td>'.$record[1].'</td>';
        echo '<td>'.$record[2].'</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';

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
