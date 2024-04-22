<?php

global $pdo;
require 'eventConnection.php';  // Your PDO database connection script
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

echo '<h2>Book Your Tickets</h2>';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventId = $_POST['event_id'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];

    $sql = "INSERT INTO bookings (event_id, user_id, quantity, date) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$eventId, $_SESSION['user_id'], $quantity, $date]);

    echo "<p>Booking successful!</p>";
}
?>
<form action="" method="POST">
    Event ID: <input type="text" name="event_id"><br>
    Number of Tickets: <input type="number" name="quantity"><br>
    Date: <input type="date" name="date"><br>
    <input type="submit" value="Book Now">
</form>
