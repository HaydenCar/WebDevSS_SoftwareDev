<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "combined_db";

try {
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("failed to connect: " . $e->getMessage());
}
?>
