<?php
// Include the header file that may contain common layout or initial settings
require 'layout/header.php';

// Access the global PDO object to use for database connections
global $pdo;
// Include the database connection setup
require 'eventConnection.php';

// Retrieve 'type' from URL parameters; default to empty string if not set
$type = isset($_GET['type']) ? $_GET['type'] : '';

// Prepare a SQL query to fetch all events of the specified type from the database
$stmt = $pdo->prepare("SELECT * FROM events WHERE event_type = ?");
// Execute the query with the event type as a parameter
$stmt->execute([$type]);
// Fetch all matching records as an associative array
$events = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title><?php echo htmlspecialchars($type); ?> Tickets</title>
</head>
<body>
<h1><?php echo htmlspecialchars($type); ?> Tickets</h1>

<?php
// Check if the $events array is empty (no events found)
if (empty($events)) {
    // Display a message if no events are found for the specified type
    echo "<p>No upcoming events found.</p>";
} else {
    // Iterate through each event in the array and display its details
    foreach ($events as $event) {
        echo "<div>
                <h2>" . htmlspecialchars($event['event_name']) . "</h2>
                <p>Venue: " . htmlspecialchars($event['venue']) . "</p>
                <p>Date: " . htmlspecialchars($event['event_date']) . "</p>
                <p>Price: €" . htmlspecialchars($event['price']) . "</p>
                <p>" . htmlspecialchars($event['description']) . "</p>
                <a href='bookEvent.php?event_id=" . htmlspecialchars($event['event_id']) . "'>Book Now</a>
              </div>";
        // Display a warning about the urgency of buying tickets
        echo "<p style='color: red; font-weight: bold;'>Tickets are selling fast! Don't miss your chance!</p>";
    }
}
?>

</body>
</html>
