<?php
// Include the header file that might contain common layout or initial settings
require 'layout/header.php';

// Make the PDO database connection object globally available
global $pdo;
// Include the database connection setup file
require 'eventConnection.php';

// Start or resume a session to manage user state
session_start();

// Check if a user ID is not set in the session, indicating the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Stop execution and send a message if the user is not logged in
    die("You must be logged in to book tickets.");
}

// Retrieve user ID from the session and booking details from the POST data
$user_id = $_SESSION['user_id'];
$event_id = $_POST['event_id'];
$quantity = $_POST['quantity'];

// Prepare and execute a query to fetch the price of the event by its ID
$stmt = $pdo->prepare("SELECT price FROM events WHERE event_id = ?");
$stmt->execute([$event_id]);
$event = $stmt->fetch();

// Check if the event exists in the database
if ($event) {
    // Calculate the total price based on the number of tickets and the event price
    $total_price = $event['price'] * $quantity;

    // Prepare and execute an INSERT statement to record the booking details
    $stmt = $pdo->prepare("INSERT INTO bookings (user_id, event_id, quantity, total_price) VALUES (?, ?, ?, ?)");
    $result = $stmt->execute([$user_id, $event_id, $quantity, $total_price]);

    // Check if the INSERT operation was successful
    if ($result) {
        // Confirm booking success and display the total price to the user
        echo "<p>Booking successful! Total price: $$total_price</p>";
    } else {
        // Handle possible errors in the booking process
        echo "<p>Error processing your booking.</p>";
    }
} else {
    // Notify the user if no event is found with the provided ID
    echo "<p>Event not found.</p>";
}
?>
