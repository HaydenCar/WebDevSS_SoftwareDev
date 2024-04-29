<?php

// Function to check user login and retrieve user data
function check_login($pdo) {
    // Redirect to login page if user is not logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: UserLogin.php");
        die;
    }

    // User ID from session
    $id = $_SESSION['user_id'];
    // Prepare SQL query to fetch user data
    $query = "SELECT * FROM users WHERE user_id = :id LIMIT 1";
    // Execute query
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    // Check if the user exists
    if ($stmt->rowCount() > 0) {
        // Return user data
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user_data;
    }
    // Redirect to login page if no user found
    header("Location: UserLogin.php");
    die;
}

// Function to generate a random number of a given length
function random_num($length)
{
    // Ensure minimum length of 5
    $text = "";
    if ($length < 5) {
        $length = 5;
    }

    // Generate random number
    $len = rand(4, $length);
    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }

    // Return generated number
    return $text;
}

