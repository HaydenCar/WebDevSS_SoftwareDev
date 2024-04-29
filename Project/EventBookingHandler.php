<?php
global $pdo; // Global variable to hold the PDO object for database connection

// Include header layout
require 'layout/header.php';

// Set error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Include database connection setup file (which should return a PDO object)
require 'eventConnection.php';

// Class for handling booking operations
class Booking {
    private $pdo; // PDO object for database connection

    // Constructor to initialize with PDO object
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Method to create a booking record in the database
    public function createBooking($userId, $eventId, $quantity, $email, $phoneNumber, $cardNumber, $cardHolderName, $expirationDate, $cvv) {
        $sql = "INSERT INTO bookings (user_id, event_id, quantity, email, phone_number, card_number, cardholder_name, expiration_date, cvv) VALUES (:user_id, :event_id, :quantity, :email, :phone_number, :card_number, :cardholder_name, :expiration_date, :cvv)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $userId,
                ':event_id' => $eventId,
                ':quantity' => $quantity,
                ':email' => $email,
                ':phone_number' => $phoneNumber,
                ':card_number' => $cardNumber,
                ':cardholder_name' => $cardHolderName,
                ':expiration_date' => $expirationDate,
                ':cvv' => $cvv
            ]);
            return true; // Booking successful
        } catch (PDOException $e) {
            // Log error if booking creation fails
            error_log('Booking creation failed: ' . $e->getMessage());
            return false; // Booking failed
        }
    }
}

// Class for handling event booking process
class EventBookingHandler {
    private $pdo; // PDO object for database connection

    // Constructor to initialize with PDO object
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Method to process the booking request
    public function processBooking() {
        // Redirect to login page if user is not logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: UserLogin.php");
            exit;
        }

        // Process booking if request method is POST
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $booking = new Booking($this->pdo);
            $success = $booking->createBooking(
                $_SESSION['user_id'],
                $_POST['event_id'],
                $_POST['quantity'],
                $_POST['email'],
                $_POST['phone_number'],
                $_POST['card_number'],
                $_POST['cardholder_name'],
                $_POST['expiration_date'],
                $_POST['cvv']
            );

            // Display booking confirmation or failure message
            if ($success) {
                // Get event details
                $event = $this->getEventDetails($_POST['event_id']);
                // Prepare last four digits of the card for display
                $cardLastFour = substr($_POST['card_number'], -4);
                // Display booking confirmation with event details
                echo "<div>
                    <h2>Booking Successful!</h2>
                    <p>Email: " . htmlspecialchars($_POST['email']) . "</p>
                    <p>Phone: " . htmlspecialchars($_POST['phone_number']) . "</p>
                    <h3>Event Details:</h3>
                    <p>Event: " . htmlspecialchars($event['event_name']) . "</p>
                    <p>Venue: " . htmlspecialchars($event['venue']) . "</p>
                    <p>Date: " . htmlspecialchars($event['event_date']) . "</p>
                    <p>Price: €" . htmlspecialchars($event['price']) . "</p>
                    <p>Description: " . htmlspecialchars($event['description']) . "</p>
                    <p>Card Used: **** **** **** " . htmlspecialchars($cardLastFour) . "</p>
                  </div>";
            } else {
                echo "Failed to book the event.";
            }
        } else {
            echo "Please submit the booking form.";
        }
    }

    // Method to fetch event details from the database
    private function getEventDetails($eventId) {
        $stmt = $this->pdo->prepare("SELECT event_name, venue, event_date, price, description, event_id FROM events WHERE event_id = ?");
        $stmt->execute([$eventId]);
        return $stmt->fetch(); // Return event details
    }
}

// Create instance of EventBookingHandler and process booking
$eventBookingHandler = new EventBookingHandler($pdo);
$eventBookingHandler->processBooking();


require 'layout/footer.php';
?>
