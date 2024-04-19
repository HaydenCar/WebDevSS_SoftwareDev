<?php
global $pdo;
require 'eventConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['event_name'];
    $type = $_POST['event_type'];
    $date = $_POST['event_date'];
    $venue = $_POST['venue'];

    $sql = "INSERT INTO events (event_name, event_type, event_date, venue) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $type, $date, $venue]);

    echo "<p>Event added successfully!</p>";
}
?>
<form method="post">
    Event Name: <input type="text" name="event_name"><br>
    Event Type: <select name="event_type">
        <option value="concert">Concert</option>
        <option value="nightclub">Nightclub</option>
    </select><br>
    Event Date: <input type="date" name="event_date"><br>
    Venue: <input type="text" name="venue"><br>
    <input type="submit" value="Add Event">
</form>
