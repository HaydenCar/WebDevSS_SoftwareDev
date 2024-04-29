<?php
global $username;
$host = 'localhost';
$dbname = 'combined_db';
$username = 'root';
$pass = 'root';

try {
    // Attempt to create a new PDO  instance to connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $pass);

    // Set PDO attribute to throw exceptions for errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If connection fails, output an error message and terminate script execution
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
`