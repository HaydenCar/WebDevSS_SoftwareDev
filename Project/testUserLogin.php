<?php

// Set PHP to report all errors and display them to the user
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Define a class to handle user login
class UserLogin {
    // Method to attempt login with a username and password
    public function loginUser($username, $password) {
        // Simulated behavior: check if the credentials match predefined valid credentials
        if ($username === 'correctUsername' && $password === 'correctPassword') {
            return true;
        }
        return false;
    }
}

// Function to test login with correct credentials
function testLoginWithValidCredentials() {
    echo "Test: Login with valid credentials: ";
    $login = new UserLogin();
    $result = $login->loginUser('correctUsername', 'correctPassword');
    if ($result) {
        echo "PASSED<br>";
    } else {
        echo "FAILED<br>";
    }
}

// Function to test login with incorrect credentials
function testLoginWithInvalidCredentials() {
    echo "Test: Login with invalid credentials: ";
    $login = new UserLogin();
    $result = $login->loginUser('wrongUsername', 'wrongPassword');
    if (!$result) {
        echo "PASSED<br>";
    } else {
        echo "FAILED<br>";
    }
}

// Function to test login with empty credentials
function testLoginWithEmptyCredentials() {
    echo "Test: Login with empty credentials: ";
    $login = new UserLogin();
    $result = $login->loginUser('', '');
    if (!$result) {
        echo "PASSED<br>";
    } else {
        echo "FAILED<br>";
    }
}

// Execute the test functions
testLoginWithValidCredentials();
testLoginWithInvalidCredentials();
testLoginWithEmptyCredentials();
