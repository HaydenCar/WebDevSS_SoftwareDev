<?php
// Ensure global scope for $pdo and include the header layout
global $pdo;
require 'layout/header.php';
?>

<?php
// Start a session to manage user state across multiple pages
session_start();

// Include necessary files for database connections and utility functions
include("eventConnection.php");
include("connection.php");
include("function.php");

// Check if the form was submitted using the POST method
if($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve username and password from the POST data
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    // Ensure username and password are not empty and username is not numeric
    if(!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // Prepare a query to select the user from the database based on the username
        $query = "SELECT * FROM users WHERE user_name = :user_name LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['user_name' => $user_name]);

        // Check if the query executed and there is at least one user returned
        if($stmt && $stmt->rowCount() > 0) {
            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verify if the password matches the one in the database
            if($user_data['password'] === $password) {
                // Set user ID in session and redirect to the index page
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: index.php");
                die;
            }
        }
        // Display an error message if username or password is incorrect
        echo "Wrong username or password!";
    } else {
        // Display an error message for invalid input
        echo "Wrong username or password!";
    }
}
?>
<DOCTYPE html>
    <html>
    <head>
        <title>Login </title>
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

        #button{
            padding:10px;
            width:100px;
            color:white;
            background-color: lightblue;
            border: none;
        }

        #box{
            background-color: grey;
            margin:auto;
            width: 300px;
            padding: 20px;
        }
    </style>

    <div id = "box">
        <form method ="post">
            <div style="font-size: 20px;margin:10px;color: white;">Login</div>

            <input id="text" type="text" name = "user_name"><br><br>
            <input id="text" type="password" name = "password"><br><br>

            <input id="button" type="submit" value = "login"><br><br>

            <a href ="signup.php"> Click to Signup</a>


        </form>
    </div>
    </body>
    </html>
</DOCTYPE>

