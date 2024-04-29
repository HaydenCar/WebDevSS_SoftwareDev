<?php

require 'layout/header.php';

// Start session to maintain user state across pages
session_start();

// Redirect logged in users to the home page
if (isset($_SESSION['user_id'])) {
    // If user is already logged in, redirect to the main page
    header("Location: indexlogin.php");
    exit;
}

// Define the UserLogin class to handle the login process
class UserLogin {
    private $pdo; // PDO connection object
    public $message = "";

    // Constructor to initialize the class with a PDO object
    public function __construct($pdo) {
        $this->pdo = $pdo;
        session_start();
    }

    // Function to authenticate a user
    public function loginUser($userName, $password) {
        // Check if username and password are valid and username is not numeric
        if(!empty($userName) && !empty($password) && !is_numeric($userName)) {
            // Prepare a query to fetch the user based on the username
            $query = "SELECT * FROM users WHERE user_name = :user_name LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['user_name' => $userName]);

            // Check if any user exists with the given username
            if($stmt && $stmt->rowCount() > 0) {
                $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
                // Verify password and set session if correct
                if($user_data['password'] === $password) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                } else {
                    // Set error message if password does not match
                    $this->message = "Wrong username or password!";
                }
            } else {
                // Set error message if no user found
                $this->message = "Wrong username or password!";
            }
        } else {
            // Prompt user to enter valid information if inputs are incorrect
            $this->message = "Please enter some valid information!";
        }
    }
}

// Ensure global scope for $pdo variable
global $pdo;

// Include additional necessary files
include("eventConnection.php");
include("connection.php");
include("function.php");

// Create a new instance of UserLogin with the PDO object
$userLogin = new UserLogin($pdo);

// Check for POST request to handle form submission
if($_SERVER['REQUEST_METHOD'] == "POST") {
    // Attempt to log in user with provided credentials
    $userLogin->loginUser($_POST['user_name'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<style type="text/css">

</style>

<div id="box">
    <form method="post">
        <div style="font-size: 20px;margin: 10px;color: white;">Login</div>
        <!-- Display any login error messages -->
        <?php if(!empty($userLogin->message)): ?>
            <p style="color: red"><?php echo $userLogin->message; ?></p>
        <?php endif; ?>
        <!-- Form fields for username and password -->
        <input id="text" type="text" name="user_name" placeholder="Username"><br><br>
        <input id="text" type="password" name="password" placeholder="Password"><br><br>
        <input id="button" type="submit" value="Login"><br><br>
        <!-- Link to registration page if the user needs to create an account -->
        <a href="UserRegistration.php">Click to Sign Up</a>
    </form>
</div>
</body>
</html>
<?php
require "layout/footer.php";
?>
