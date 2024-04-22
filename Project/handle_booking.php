<?php
global $pdo;
require 'User.php';
require 'Event.php';
require 'Booking.php';
require 'layout/header.php';
require 'eventConnection.php'; // Ensure this file returns $pdo

$user = new User();
if (!$user->isLoggedIn()) {
    $user->redirectToLogin();
}

$booking = new Booking($pdo);
$success = $booking->createBooking(
    $user->getUserId(),
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
    // Render booking confirmation page
} else {
    echo "Failed to book the event.";
    // Handle booking failure
}

?>
