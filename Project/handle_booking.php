<?php
// Start the session if needed (if you're using sessions)
global $pdo;
session_start();

// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
require 'eventConnection.php'; // Adjust this path as necessary
require 'layout/header.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather form data
    $user_id = $_POST['user_id'];
    $event_id = $_POST['event_id'];
    $quantity = $_POST['quantity'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $card_number = $_POST['card_number']; // Retrieve card number
    $cardholder_name = $_POST['cardholder_name']; // Retrieve cardholder name
    $expiration_date = $_POST['expiration_date']; // Retrieve expiration date
    $cvv = $_POST['cvv']; // Retrieve CVV

    // Prepare the INSERT statement with the new fields
    $sql = "INSERT INTO bookings (user_id, event_id, quantity, email, phone_number, card_number, cardholder_name, expiration_date, cvv) 
        VALUES (:user_id, :event_id, :quantity, :email, :phone_number, :card_number, :cardholder_name, :expiration_date, :cvv)";

    try {
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':card_number', $card_number);
        $stmt->bindParam(':cardholder_name', $cardholder_name);
        $stmt->bindParam(':expiration_date', $expiration_date);
        $stmt->bindParam(':cvv', $cvv);

        // Execute the prepared statement
        $stmt->execute();

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
require 'layout/footer.php';
?>
