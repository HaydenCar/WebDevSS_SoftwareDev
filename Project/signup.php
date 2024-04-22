<?php
// Start or resume a session to track user state across different pages
global $pdo;
require "layout/header.php";
session_start();

// Include database connection settings specific to the events
include("eventConnection.php");
// Include general database connection settings
include("connection.php");
// Include utility functions such as random_num
include("function.php");

$message = ""; // Initialize an empty message variable

// Check if the form was submitted using POST method
if($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve username and password from POST data
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    // Validate that username and password meet the required conditions
    if(!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        if(strlen($user_name) >= 5 && (strlen($password) >= 4)) {
            // Generate a random user ID with a specified length
            $user_id = random_num(5);

            // Prepare the SQL query to insert the new user into the database
            $query = "INSERT INTO users (user_id, user_name, password, date) VALUES (:user_id, :user_name, :password, NOW())";
            $stmt = $pdo->prepare($query);
            // Execute the query with parameters
            $stmt->execute(['user_id' => $user_id, 'user_name' => $user_name, 'password' => $password]);

            // Redirect to the login page after successful registration
            header("Location: login.php");
            die;
        }
        else {
            $message = "Username must be at least 5 characters and password must be at least 4 characters.";
        }
    }
        else {
        // Display an error message if the input validation fails
            $message = "Please enter some valid information!";
        }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>
<style type="text/css">
    #text {
        height: 25px;
        border-radius: 5px;
        padding: 4px;
        border: solid thin #aaa;
        width: 100%;
    }

    #button {
        padding: 10px;
        width: 100px;
        color: white;
        background-color: lightblue;
        border: none;
    }

    #box {
        background-color: #04233b;
        margin: auto;
        width: 300px;
        padding: 20px;
    }
</style>

<div id="box">
    <form method="post">
        <div style="font-size: 20px;margin: 10px;color: white;">Sign Up</div>
        <?php if(!empty($message)): ?>
            <p style="color: red"><?php echo $message; ?></p>
        <?php endif; ?>
        <input id="text" type="text" name="user_name" placeholder="Username (min 5 characters)"><br><br>
        <input id="text" type="password" name="password" placeholder="Password (min 4 characters)"><br><br>

        <input id="button" type="submit" value="Signup"><br><br>

        <a href="login.php">Click to Login</a>
    </form>
</div>
</body>
</html>
<?php require "layout/footer.php"?>