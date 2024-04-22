<?php
global $pdo;
require 'eventConnection.php';

$sql = "SELECT * FROM events";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$events = $stmt->fetchAll();

echo "<h1>Events</h1>";
foreach ($events as $event) {
    echo "<p>{$event['event_name']} - Type: {$event['event_type']} - Date: {$event['event_date']} - Venue: {$event['venue']}</p>";
}
?>
