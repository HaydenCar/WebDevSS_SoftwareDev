<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'UserRegistration.php';

function simulatePost($userName, $password) {
    $_POST['user_name'] = $userName;
    $_POST['password'] = $password;
    $_SERVER['REQUEST_METHOD'] = "POST";
}

function testRegisterUser() {
    $pdo = new PDO("mysql:host=localhost;dbname=test_db;charset=utf8", "root", "root");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $registration = new UserRegistration($pdo);

    echo "Test case 1: Valid registration - ";
    simulatePost('testUser', 'testPass123');
    $registration->registerUser($_POST['user_name'], $_POST['password']);
    echo "Done. Please manually verify in your test database if the user was added.<br>";
}

testRegisterUser();
