<?php
global $pdo;
session_start();
include("eventConnection.php");
include("connection.php");  // Ensure this file sets $pdo correctly
include("common.php");

if (isset($_POST['submit'])) {
    try {
        $sql = "UPDATE users
                SET user_name = :user_name,
                    password = :password
                WHERE user_id = :user_id";
        $user =[
            "user_id" => escape($_POST['user_id']),
            "user_name" => escape($_POST['user_name']),
            "password" => escape($_POST['password'])
        ];

        $statement = $pdo->prepare($sql);
        $statement->execute($user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['user_id'])) {
    $sql = "SELECT * FROM users WHERE user_id = :user_id";

    try {
        $user_id = $_GET['user_id'];
        $statement = $pdo->prepare($sql);
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
        <label for="<?php echo $key; ?>"><?php echo ucfirst(str_replace('_', ' ', $key)); ?></label>
        <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'user_id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>
<a href="index.php">Back to home</a>
<?php require "layout/footer.php"; ?>
