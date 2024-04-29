<?php
global $pdo;
require 'layout/header.php';
require 'eventConnection.php';

class EventBooker {
    private $pdo;
    private $userId;

    // Constructor: Initializes the class with a PDO object and user ID, and checks session
    public function __construct($pdo, $userId) {
        $this->pdo = $pdo;
        $this->userId = $userId;
        $this->initSession();
    }

    // Initializes the session and redirects if the user is not logged in
    private function initSession() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: UserLogin.php");
            exit;
        }
    }

    // Displays event details or an error message if no event ID is specified
    public function displayEvent($eventId) {
        if (empty($eventId)) {
            echo "<p>No event specified. Please check the link.</p>";
            return;
        }

        $event = $this->fetchEvent($eventId);
        if ($event) {
            $this->renderEvent($event);
        } else {
            echo "<p>Event not found. Please check the event ID.</p>";
        }
    }

    // Fetches event data from the database using the event ID
    private function fetchEvent($eventId) {
        $stmt = $this->pdo->prepare("SELECT * FROM events WHERE event_id = :event_id");
        $stmt->execute([':event_id' => $eventId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Renders the event booking form with the fetched event details
    private function renderEvent($event) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Book Tickets for <?php echo htmlspecialchars($event['event_name']); ?></title>
        </head>
        <body>

        <h1><?php echo htmlspecialchars($event['event_name']); ?></h1>
        <p>Date: <?php echo isset($event['event_date']) ? htmlspecialchars($event['event_date']) : 'Not available'; ?></p>
        <p>Venue: <?php echo isset($event['venue']) ? htmlspecialchars($event['venue']) : 'Not available'; ?></p>
        <p>Price: €<?php echo isset($event['price']) ? htmlspecialchars($event['price']) : 'Not available'; ?></p>

        <form action="EventBookingHandler.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($this->userId); ?>">
            <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event['event_id']); ?>">
            Quantity: <input type="number" name="quantity" min="1" value="1" required><br>
            Email: <input type="email" name="email" required><br>
            Phone Number: <input type="tel" name="phone_number" required><br>
            Card Number: <input type="text" name="card_number" pattern="\d{16}" title="Card number must be 16 digits" required><br>
            Cardholder Name: <input type="text" name="cardholder_name" required><br>
            Expiration Date: <input type="date" name="expiration_date" required><br>
            CVV: <input type="text" name="cvv" pattern="\d{3}" title="CVV must be 3 digits" required><br>
            <input type="submit" value="Submit Booking">
        </form>

        </body>
        </html>
        <?php
    }
}

// Usage of the class with provided PDO object and user ID from session
$booker = new EventBooker($pdo, $_SESSION['user_id']);
if (isset($_GET['event_id'])) {
    $booker->displayEvent($_GET['event_id']);
}
?>
