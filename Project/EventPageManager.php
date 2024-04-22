<?php

global $pdo;

class EventPageManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->checkUserLogin();
    }

    private function checkUserLogin() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: UserLogin.php');
            exit;
        }
    }

    public function displayEventTypes() {
        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Event Type</title>
    <!-- Stylesheets -->
</head>
<body>
<h1>Buy Tickets</h1>
<a href="EventFetcher.php?type=Concert">Concert Tickets</a> |
<a href="EventFetcher.php?type=Nightclub">Nightclub Tickets</a>
</body>
</html>';
    }
}

// Usage
session_start();
require 'layout/header.php'; // Include the header layout

require 'eventConnection.php'; // Database connection for the event

$eventPageManager = new EventPageManager($pdo);
$eventPageManager->displayEventTypes();

require 'layout/footer.php'; // Include the footer layout
