<?php
// Start the session if needed (if you're using sessions)
global $pdo;
session_start();

// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
require 'eventConnection.php'; // Adjust this path as necessary

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather form data
    $user_id = $_POST['user_id'];
    $event_id = $_POST['event_id'];
    $quantity = $_POST['quantity'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    // Prepare the INSERT statement
    $sql = "INSERT INTO bookings (user_id, event_id, quantity, email, phone_number) VALUES (:user_id, :event_id, :quantity, :email, :phone_number)";
    try {
        $stmt = $pdo->prepare($sql);

        // Bind parameters and execute
        $stmt->execute([
            ':user_id' => $user_id,
            ':event_id' => $event_id,
            ':quantity' => $quantity,
            ':email' => $email,
            ':phone_number' => $phone_number
        ]);

        // Check if the booking was successful
        if ($stmt->rowCount() > 0) {
            // Booking success HTML content
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Booking Confirmed</title>
            </head>
            <body>
                <h1>Booking Successful!</h1>
                <p>Thank you for your purchase, {$email}. Your booking has been confirmed.</p>
                <p><strong>Event ID:</strong> {$event_id}</p>
                <p><strong>Quantity:</strong> {$quantity}</p>
                <p><strong>Phone Number:</strong> {$phone_number}</p>
                <a href='index.php'>Return to Home</a>
            </body>
            </html>";
        } else {
            throw new Exception("Unable to process booking.");
        }
    } catch (Exception $e) {
        // If an error occurs, display the error message
        echo "Error: " . $e->getMessage();
    }
} else {
    // Not a POST request
    echo "Invalid request.";
}
?>

