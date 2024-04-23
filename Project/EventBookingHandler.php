<?php
global $pdo;
require 'layout/header.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require 'eventConnection.php'; // This file should return a PDO object ($pdo)

class Booking {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

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
            return true;
        } catch (PDOException $e) {
            error_log('Booking creation failed: ' . $e->getMessage());
            return false;
        }
    }
}

class EventBookingHandler {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function processBooking() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: UserLogin.php");
            exit;
        }

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

            if ($success) {
                echo "Booking successful!";
                // Optional: Redirect to a confirmation page
                // header("Location: bookingConfirmation.php");
                // exit;
            } else {
                echo "Failed to book the event.";
            }
        } else {
            // Show an appropriate message or redirect if this page is accessed without POST data
            echo "Please submit the booking form.";
        }
    }
}

$eventBookingHandler = new EventBookingHandler($pdo);
$eventBookingHandler->processBooking();

// Add layout/header.php and layout/footer.php if needed
require 'layout/footer.php';
?>
