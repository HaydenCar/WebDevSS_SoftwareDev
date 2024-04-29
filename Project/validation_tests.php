<?php
global $pdo;
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'eventConnection.php';

// Test data simulation
$userName = "testUser";
$password = "password123!";
$email = "test@example.com";
$eventDate = "2023-12-25";



// Function to check password strength
function isPasswordStrong($password) {
    return strlen($password) >= 8 && preg_match('/[a-zA-Z]/', $password) && preg_match('/\d/', $password);
}

// Function to validate event date
function isEventDateValid($eventDate) {
    return new DateTime($eventDate) > new DateTime();
}

// Function to validate email format
function isEmailValid($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Testing and output
echo "Test 1 - Password Strength: " . (isPasswordStrong($password) ? "Passed" : "Failed") . "<br>";
echo "Test 2 - Event Date Validation: " . (isEventDateValid($eventDate) ? "Passed" : "Failed") . "<br>";
echo "Test 3 - Email Format: " . (isEmailValid($email) ? "Passed" : "Failed") . "<br>";
?>
