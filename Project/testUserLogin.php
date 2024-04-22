<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

class UserLogin {
    public function loginUser($username, $password) {
        // Mock behavior for demonstration
        if ($username === 'correctUsername' && $password === 'correctPassword') {
            return true;
        }
        return false;
    }
}

// Test case 1: Valid credentials
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

// Test case 2: Invalid credentials
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

// Test case 3: Empty credentials
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


testLoginWithValidCredentials();
testLoginWithInvalidCredentials();
testLoginWithEmptyCredentials();
