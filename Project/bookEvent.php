<?php
// Include the header file for consistent layout
require 'layout/header.php';

// Establish database connection by including the connection setup file
global $pdo;
require 'eventConnection.php';

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
        <p>Price: $<?php echo isset($event['price']) ? htmlspecialchars($event['price']) : 'Not available'; ?></p>

        <!-- Booking Form -->
        <form action="handle_booking.php" method="post">
            User ID: <input type="text" name="user_id" value="1" readonly><br>
            Event ID: <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event['event_id']); ?>"><br>
            Quantity: <input type="number" name="quantity" min="1" value="2" required><br>
            Email: <input type="email" name="email" value="example@example.com" required><br>
            Phone Number: <input type="tel" name="phone_number" value="123-456-7890" required><br>
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
?>
