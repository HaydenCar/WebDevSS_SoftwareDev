<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

class UserRegistrationTest {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function testRegisterUser() {
        // Test Case 1: Valid Input
        $result = $this->registerUser('ValidUser', 'Secure1234');
        echo 'Test Case 1 - Expected: User registered successfully, Actual: ' . $result . "\n";

        // Test Case 2: Username or Password Empty
        $result = $this->registerUser('', 'Secure1234');
        echo 'Test Case 2 - Expected: Username and password must not be empty, Actual: ' . $result . "\n";

        $result = $this->registerUser('ValidUser', '');
        echo 'Test Case 2 - Expected: Username and password must not be empty, Actual: ' . $result . "\n";

        // Test Case 3: Username or Password Length Validation Fails
        $result = $this->registerUser('user', 'Secure1234');
        echo 'Test Case 3 - Expected: Username must be between 5 and 20 characters, Actual: ' . $result . "\n";

        $result = $this->registerUser('ValidUser', '123');
        echo 'Test Case 3 - Expected: Password must be between 4 and 20 characters, Actual: ' . $result . "\n";
    }

    private function registerUser($userName, $password) {
        // Simulating the registerUser function from UserRegistration class
        if (empty($userName) || empty($password)) {
            return "Username and password must not be empty";
        }
        if (strlen($userName) < 5 || strlen($userName) > 20) {
            return "Username must be between 5 and 20 characters";
        }
        if (strlen($password) < 4 || strlen($password) > 20) {
            return "Password must be between 4 and 20 characters";
        }
        return "User registered successfully";
    }
}

// Assuming $pdo is a PDO object connected to a database
$pdo = new PDO('mysql:host=localhost;dbname=testdb', 'user', 'password');
$test = new UserRegistrationTest($pdo);
$test->testRegisterUser();
?>
