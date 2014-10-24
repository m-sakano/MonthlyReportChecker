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
    error_log($line, 3, LOG_FILE);
    $_SESSION['msg'][] = $s;
}
