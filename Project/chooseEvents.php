<?php
session_start();
require 'layout/header.php'; // Include the header layout

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header('Location: UserLogin.php');
    exit;
}

// Database connection for the event (Assuming needed for something else on this page)
require 'eventConnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Event Type</title>
    <!-- Stylesheets -->
</head>
<body>
<h1>Buy Tickets</h1>
<a href="listEvents.php?type=Concert">Concert Tickets</a> |
<a href="listEvents.php?type=Nightclub">Nightclub Tickets</a>
</body>
</html>
<?php require 'layout/footer.php'; ?>
