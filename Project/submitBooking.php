<?php
global $pdo;

require 'eventConnection.php';

// Start or resume a session to manage user sessions
session_start();

// Check if a user is not logged in by checking the session
if (!isset($_SESSION['user_id'])) {
    // Terminate the script with a message if the user is not logged in
    die("You must be logged in to book tickets.");
}

// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user and booking details from session and POST data
    $user_id = $_SESSION['user_id'];
    $event_id = $_POST['event_id'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $quantity = $_POST['quantity'];

    // Prepare a SQL query to fetch the price of the event from the database
    $stmt = $pdo->prepare("SELECT price FROM events WHERE event_id = :event_id");
    // Execute the query with the event ID parameter
    $stmt->execute([':event_id' => $event_id]);
    // Fetch the result row
    $event = $stmt->fetch();

    // Check if the event data was successfully retrieved
    if ($event) {
        // Calculate the total cost of the booking
        $total_price = $event['price'] * $quantity;

        // Prepare a SQL statement to insert the booking details into the database
        $stmt = $pdo->prepare("INSERT INTO bookings (user_id, event_id, quantity, total_price, booking_date, email, phone_number) VALUES (?, ?, ?, ?, CURDATE(), ?, ?)");
        // Execute the insert statement with all booking details
        $result = $stmt->execute([$user_id, $event_id, $quantity, $total_price, $email, $phone_number]);

        // Check if the insert operation was successful
        if ($result) {
            // Notify the user that booking was successful and confirmation will be sent
            echo "<p>Booking successful! A confirmation email will be sent to $email.</p>";
        } else {
            // Handle errors during the booking process
            echo "<p>Error processing your booking. Please try again later.</p>";
        }
    } else {
        // Notify the user if the specified event does not exist
        echo "<p>Event not found. Please try again.</p>";
    }
} else {
    // Notify the user if the script was accessed without submitting the form
    echo "<p>Invalid request. Please use the booking form.</p>";
}
?>
