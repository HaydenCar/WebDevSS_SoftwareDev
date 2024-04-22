<?php
require 'layout/header.php';

session_start();
if (isset($_SESSION['user_id'])) {
    // User is already logged in, redirect to indexlogin.php
    header("Location: indexlogin.php");
    exit;
} else {

}


class UserLogin {
    private $pdo;
    public $message = "";

    public function __construct($pdo) {
        $this->pdo = $pdo;
        session_start();
    }

    public function loginUser($userName, $password) {
        if(!empty($userName) && !empty($password) && !is_numeric($userName)) {
            $query = "SELECT * FROM users WHERE user_name = :user_name LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['user_name' => $userName]);

            if($stmt && $stmt->rowCount() > 0) {
                $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
                if($user_data['password'] === $password) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                } else {
                    $this->message = "Wrong username or password!";
                }
            } else {
                $this->message = "Wrong username or password!";
            }
        } else {
            $this->message = "Please enter some valid information!";
        }
    }
}

// Ensure global scope for $pdo
global $pdo;
// Include necessary files for database connections and utility functions
include("eventConnection.php");
include("connection.php");
include("function.php");

$userLogin = new UserLogin($pdo);

if($_SERVER['REQUEST_METHOD'] == "POST") {
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
    /* Your CSS styles */
</style>

<div id="box">
    <form method="post">
        <div style="font-size: 20px;margin: 10px;color: white;">Login</div>
        <?php if(!empty($userLogin->message)): ?>
            <p style="color: red"><?php echo $userLogin->message; ?></p>
        <?php endif; ?>
        <input id="text" type="text" name="user_name" placeholder="Username"><br><br>
        <input id="text" type="password" name="password" placeholder="Password"><br><br>

        <input id="button" type="submit" value="Login"><br><br>

        <a href="UserRegistration.php">Click to Sign Up</a>
    </form>
</div>
</body>
</html>
<?php require "layout/footer.php"; ?>
