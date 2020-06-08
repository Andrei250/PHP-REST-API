<?php
    $db_user     = "root";
    $db_password = "password";
    $db_name     = "restinphp";

    try {
        $db = new PDO('mysql:host=localhost;dbname='.$db_name, $db_user, $db_password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        $error_message = date('Y-m-d G:i:s') . " [ERROR]: " . $e->getMessage() . "\n\r";
        file_put_contents('PDOErrors.txt', $error_message, FILE_APPEND);
    }


    define('APP_NAME', 'PHP REST API');
?>