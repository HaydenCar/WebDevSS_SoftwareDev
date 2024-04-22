<?php
<<<<<<< HEAD
global $pdo;
error_reporting(E_ALL);
ini_set('display_errors', 1);
=======
>>>>>>> 09ba7412b27ae5a1c87b2055c9ff78501bc8b3ff
session_start();
include("eventConnection.php");
include("connection.php");  // Ensure this file sets $pdo correctly
include("common.php");

if (isset($_POST['submit'])) {
    try {
        $user =[
            "user_id" => escape($_POST['user_id']),
            "user_name" => escape($_POST['user_name']),
            "password" => escape($_POST['password']),
            "date" => escape($_POST['date'])
        ];
        $sql = "UPDATE users
 SET user_id = :user_id,
 user_name = :user_name,
 password = :password,
 date = :date,
 WHERE user_id = :user_id";
        $statement = $connection->prepare($sql);
        $statement->execute($user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
if (isset($_GET['id'])) {
    try {
        require_once '../src/DBconnect.php';
        $id = $_GET['user_id'];
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}
?>
<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
    <?php echo escape($_POST['user_name']); ?> successfully updated.
<?php endif; ?>
<h2>Edit a user</h2>
<form method="post">
    <?php foreach ($user as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <input type="text" name="<?php echo $key; ?>" user_id="<?php echo $key;
        ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'user_id' ?
            'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>
<a href="index.php">Back to home</a>
<?php require "layout/footer.php"; ?>
