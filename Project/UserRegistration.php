<?php
session_start();
require "layout/header.php";

// Database connection setup
$host = 'localhost';
$dbname = 'combined_db';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Include utility function for generating random user IDs
include("function.php");

class UserRegistration {
    private $pdo;
    public $message = "";

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registerUser($userName, $password) {
        if (!empty($userName) && !empty($password) && strlen($userName) >= 5 && strlen($password) >= 4) {
            $userId = random_num(20); // Assuming function.php defines this function
            $query = "INSERT INTO users (user_id, user_name, password, date) VALUES (:user_id, :user_name, :password, NOW())";
            $stmt = $this->pdo->prepare($query);
            if ($stmt->execute(['user_id' => $userId, 'user_name' => $userName, 'password' => $password])) {
                header("Location: UserLogin.php");
                exit;
            }
        } else {
            $this->message = "Username must be at least 5 characters and password must be at least 4 characters.";
        }
    }
}

$registration = new UserRegistration($pdo);

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
    <form method="post">
        <div style="font-size: 20px;margin: 10px;color: white;">Sign Up</div>
        <?php if(!empty($registration->message)): ?>
            <p style="color: red"><?php echo $registration->message; ?></p>
        <?php endif; ?>
        <input id="text" type="text" name="user_name" placeholder="Username (min 5 characters)"><br><br>
        <input id="text" type="password" name="password" placeholder="Password (min 4 characters)"><br><br>
        <input id="button" type="submit" value="Signup"><br><br>
        <a href="UserLogin.php">Click to Login</a><br><br>
    </form>
</div>
</body>
</html>
<?php require "layout/footer.php"; ?>
