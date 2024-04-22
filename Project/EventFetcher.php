<?php

global $pdo;

class EventFetcher {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getEventsByType($type) {
        $stmt = $this->pdo->prepare("SELECT * FROM events WHERE event_type = ?");
        $stmt->execute([$type]);
        return $stmt->fetchAll();
    }

    public function displayEvents($type) {
        $events = $this->getEventsByType($type);

        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>' . htmlspecialchars($type) . ' Tickets</title>
</head>
<body>
<h1>' . htmlspecialchars($type) . ' Tickets</h1>';

        if (empty($events)) {
            echo "<p>No upcoming events found.</p>";
        } else {
            foreach ($events as $event) {
                echo "<div>
                        <h2>" . htmlspecialchars($event['event_name']) . "</h2>
                        <p>Venue: " . htmlspecialchars($event['venue']) . "</p>
                        <p>Date: " . htmlspecialchars($event['event_date']) . "</p>
                        <p>Price: €" . htmlspecialchars($event['price']) . "</p>
                        <p>" . htmlspecialchars($event['description']) . "</p>
                        <a href='bookEvent.php?event_id=" . htmlspecialchars($event['event_id']) . "'>Book Now</a>
                      </div>";
                echo "<p style='color: red; font-weight: bold;'>Tickets are selling fast! Don't miss your chance!</p>";
            }
        }

        echo '</body>
</html>';
    }
}

// Usage
require 'layout/header.php'; // Include the header layout
require 'eventConnection.php'; // Include the database connection setup

$type = isset($_GET['type']) ? $_GET['type'] : '';

$eventFetcher = new EventFetcher($pdo);
$eventFetcher->displayEvents($type);

require 'layout/footer.php'; // Include the footer layout
?>
