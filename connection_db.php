<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/config.php";

$dsn = DB_DRIVER.":host=".host.";dbname=".dbname;

// Attempt to connect
try {
    $pdo = new PDO($dsn, username, password);
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}