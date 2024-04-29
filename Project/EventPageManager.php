<?php
// Declare the global PDO object for database access
global $pdo;

// Define the EventPageManager class
class EventPageManager {
    private $pdo;

    // Constructor initializes the PDO connection and checks user login
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->checkUserLogin();
    }

    // Private method to check if the user is logged in and redirect if not
    private function checkUserLogin() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: UserLogin.php');
            exit;
        }
    }

    // Public method to display event types as HTML
    public function displayEventTypes() {
        // Echo the HTML structure for choosing event types
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

// Begin the session to maintain user session state
session_start();


require 'layout/header.php';
require 'eventConnection.php';

// Create an instance of EventPageManager with the PDO object
$eventPageManager = new EventPageManager($pdo);
$eventPageManager->displayEventTypes();

require 'layout/footer.php';
?>
