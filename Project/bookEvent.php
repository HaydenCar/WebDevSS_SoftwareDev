<?php
// Include the header file for consistent layout
global $pdo;
require 'layout/header.php';

// Start the session to access session variables
session_start();

// Establish database connection by including the connection setup file
require 'eventConnection.php';

// Check if a user is logged in and has a user ID stored in the session
if (isset($_SESSION['user_id'])) {
    // Retrieve the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Check if an event ID is provided in the URL and that it is not empty
    if (isset($_GET['event_id']) && !empty($_GET['event_id'])) {
        $event_id = $_GET['event_id'];

        // Prepare and execute a query to fetch event details by ID
        $stmt = $pdo->prepare("SELECT * FROM events WHERE event_id = :event_id");
        $stmt->execute([':event_id' => $event_id]);
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the event data was successfully fetched
        if ($event) {
            // Start of HTML content
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

            <!-- Booking Form -->
            <form action="handle_booking.php" method="post">
                <!-- Hidden User ID field pre-populated with the user's ID -->
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                <!-- Hidden Event ID field pre-populated with the event's ID -->
                <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event['event_id']); ?>">
                Quantity: <input type="number" name="quantity" min="1" value="2" required><br>
                Email: <input type="email" name="email" value="example@example.com" required><br>
                Phone Number: <input type="tel" name="phone_number" value="123-456-7890" required><br>
                Card Number: <input type="text" name="card_number" required><br>
                Cardholder Name: <input type="text" name="cardholder_name" required><br>
                Expiration Date: <input type="date" name="expiration_date" required><br>
                CVV: <input type="text" name="cvv" required><br>
                <input type="submit" value="Submit Booking">
            </form>

            </body>
            </html>
            <?php
        } else {
            // Display error message if no event was found with the given ID
            echo "<p>Event not found. Please check the event ID.</p>";
        }
    } else {
        // Display error message if no event ID is provided in the URL
        echo "<p>No event specified. Please check the link.</p>";
    }
} else {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit; // Terminate script execution after redirect
}
?>
