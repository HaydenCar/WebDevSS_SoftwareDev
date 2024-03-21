<?php
session_start();


if (!isset($_SESSION['user_id'])) {

    header('Location: login.php');
    exit;
}

require 'layout/header.php';

$userId = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking - HII Events</title>
</head>
<body>
<div class="booking-container">
    <h2>Book Your Tickets</h2>
    <form action="handle_booking.php" method="POST">
        <div class="form-group">
            <label for="event_id">Event ID:</label>
            <input type="text" name="event_id" id="event_id" placeholder="Event ID" required>
        </div>
        <div class="form-group">
            <label for="user_id">Your User ID:</label>
            <input type="text" name="user_id" id="user_id" placeholder="Your User ID" required>
        </div>
        <div class="form-group">
            <label for="quantity">Number of Tickets:</label>
            <input type="number" name="quantity" id="quantity" placeholder="Number of Tickets" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required> <!-- Changed to type 'date' for better user experience -->
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>

<!-- Include your footer here -->
<?php require 'layout/footer.php'; ?>
</body>
</html>
