<?php
session_start();
include("eventConnection.php");
include("connection.php");  // Ensure this file sets $pdo correctly
include("common.php");

if (isset($_POST['submit'])) {
    try {
        $user = [
            "user_id" => $_POST['user_id'],
            "user_name" => $_POST['user_name'],
            "password" => $_POST['password'],
            "date" => $_POST['date']
        ];

        $sql = "UPDATE users
                SET user_id = :user_id,
                    user_name = :user_name,
                    password = :password,
                    date = :date
                WHERE user_id = :user_id";

        $statement = $connection->prepare($sql);
        $statement->execute($user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':user_id', $id);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}

$connection = null;  // Close the database connection
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
    <?php echo escape($_POST['user_name']); ?> successfully updated.
<?php endif; ?>

<h2>Edit a user</h2>
<form method="post">
    <?php foreach ($user as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <input type="text" name="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'user_id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>
<a href="index.php">Back to home</a>
<?php require "layout/footer.php"; ?>
