<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Abushaban123";
$dbname = "login_sample";

try {
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("failed to connect: " . $e->getMessage());
}
?>

