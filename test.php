<?php
    echo 0;
    require_once('config.php');
    require_once('functions.php');
    echo 1;
    $d = '2014-12-25 00:00:00';
    $dbh = connectDb();
    $sql = "insert into result
            (google_user_id, priority, message, filename)
            values
            (:id, :priority, :message, :filename)";
    $stmt = $dbh->prepare($sql);
    $params = array(
    	    ":id" => 'a',
    	    ":priority" => 'b',
    	    ":message" => 'c',
    	    ":filename" => 'd'
    	    );
    $dbh->beginTransaction();
    $stmt->execute($params);
    $dbh->commit();
    $stmt->closeCursor();
    
    echo 2;
    echo $sql;

    $params = array(
    	    ":id" => 'e',
    	    ":priority" => 'f',
    	    ":message" => 'g',
    	    ":filename" => 'h'
    	    );
    $dbh->beginTransaction();
    $stmt->execute($params);
    $dbh->commit();
    $stmt->closeCursor();

    echo 3;
    echo $sql;
