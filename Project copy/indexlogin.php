<?php
// Start a new or resume the existing session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page since the user is not logged in
    header("Location: UserLogin.php");
    exit;
}
global $pdo;
require 'layout/header.php';
require "connection.php";
require "function.php";

// Fetch logged in user data using a custom function
$user_data = check_login($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My website</title>
</head>
<body>
<!-- Provide a logout link -->
<a href="logout.php">Click here to Logout</a>
<!-- Display the username of the logged-in user -->
<h1>You are logged in as <?php echo htmlspecialchars($user_data['user_name']); ?></h1>
</body>
</html>
<!-- Include the footer layout for consistent page appearance -->
<?php require "layout/footer.php"; ?>
