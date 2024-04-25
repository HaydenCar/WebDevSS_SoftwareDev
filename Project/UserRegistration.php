<?php
// Start session to store user data between HTTP requests
session_start();

// Include the header file for consistent layout across pages
require "layout/header.php";

// Establish a PDO connection to the database
$host = 'localhost';
$dbname = 'combined_db';
$username = 'root';
$password = 'root';

try {
    // Attempt to connect using the defined credentials and set error mode to exception
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Stop script and output error message if connection fails
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Include a utility function to generate random user IDs
include("function.php");

// Define the UserRegistration class to handle registration logic
class UserRegistration {
    private $pdo;
    public $message = "";

    // Constructor to initialize the PDO connection
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Register user with username and password
    public function registerUser($userName, $password) {
        // Validate input for minimum length requirements
        if (!empty($userName) && !empty($password) && strlen($userName) >= 5 && strlen($password) >= 4) {
            $userId = random_num(20); // Generate a random user ID
            $query = "INSERT INTO users (user_id, user_name, password, date) VALUES (:user_id, :user_name, :password, NOW())";
            $stmt = $this->pdo->prepare($query);
            // Execute the query and redirect if successful
            if ($stmt->execute(['user_id' => $userId, 'user_name' => $userName, 'password' => $password])) {
                header("Location: UserLogin.php");
                exit;
            }
        } else {
            // Set error message if input validation fails
            $this->message = "Username must be at least 5 characters and password must be at least 4 characters.";
        }
    }
}

// Create an instance of UserRegistration
$registration = new UserRegistration($pdo);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $registration->registerUser($_POST['user_name'], $_POST['password']);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>
<div id="box">
    <!-- Registration form for new users -->
    <form method="post">
        <div style="font-size: 20px;margin: 10px;color: white;">Sign Up</div>
        <!-- Display validation message if any -->
        <?php if(!empty($registration->message)): ?>
            <p style="color: red"><?php echo $registration->message; ?></p>
        <?php endif; ?>
        <!-- User inputs for username and password -->
        <input id="text" type="text" name="user_name" placeholder="Username (min 5 characters)"><br><br>
        <input id="text" type="password" name="password" placeholder="Password (min 4 characters)"><br><br>
        <input id="button" type="submit" value="Signup"><br><br>
        <a href="UserLogin.php">Click to Login</a><br><br>
    </form>
</div>
</body>
</html>
<?php require "layout/footer.php"; ?>
