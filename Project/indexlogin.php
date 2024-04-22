<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to UserLogin.php
    header("Location: UserLogin.php");
    exit;
} else {

}


global $pdo;
require 'layout/header.php';
require "connection.php";
require "function.php";

$user_data = check_login($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My website</title>
</head>
<body>
<a href="logout.php">Click here to Logout</a>
<h1>You are logged in as <?php echo htmlspecialchars($user_data['user_name']); ?></h1>
</body>
</html>
<?php require "layout/footer.php"; ?>
