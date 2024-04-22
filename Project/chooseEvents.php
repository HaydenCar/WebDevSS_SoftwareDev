<?php
// Start a session to manage user session data
session_start();

// Include the header layout
require 'layout/header.php';

// Include the database connection for the event
require 'eventConnection.php';

// Check if the session variable 'user_id' is not set, which means the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header('Location: login.php');
    exit;
}

// If the script continues beyond this point, it means the user is logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Event Type</title>
</head>
<body>
<h1>Buy Tickets</h1>
<a href="listEvents.php?type=Concert">Concert Tickets</a> |
<a href="listEvents.php?type=Nightclub">Nightclub Tickets</a>
</body>
</html>
