<?php
global $pdo;
session_start();

require 'connectionTickets.php';

if (isset($_POST['submit'])) {
    $eventId = $_POST['event_id'];
    $userId = $_POST['user_id'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];

    try {
        $stmt = $pdo->prepare("INSERT INTO bookings (event_id, user_id, quantity, date) VALUES (:event_id, :user_id, :quantity, :date)");
        $stmt->execute([
            ':event_id' => $eventId,
            ':user_id' => $userId,
            ':quantity' => $quantity,
            ':date' => $date
        ]);

        echo "Booking successful!";
        // Redirect to a confirmation page
        header('Location: booking_success.php');
    } catch (PDOException $e) {
        die("Booking failed: " . $e->getMessage());
    }
} else {
    header('Location: booking.php');
}
?>
