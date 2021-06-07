<?php
// Johann AppStage Assessment
//PHP Script that connects database using PDO
    $dsn = 'mysql:host=localhost;dbname=veterinary';
    $username = 'root';
    $password = '';

    //try catch exception
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../error/connection_error.php');
        exit();
    }
?>