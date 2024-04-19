<?php
global $pdo;
require 'db.php';

$sql = "SELECT * FROM performers";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$performers = $stmt->fetchAll();

echo "<h1>Performers</h1>";
foreach ($performers as $performer) {
    echo "<p>{$performer['performer_name']}</p>";
}
?>
