<?php
// data source name
$dsn = "mysql:host=localhost;dbname=final_1531";
$username = "root";
$password = "";

// PHP DATA OBJECT
try {
    // Reference: https://www.php.net/manual/en/book.pdo.php
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $err) {
    $connectionError = $err->getMessage();
}

?>