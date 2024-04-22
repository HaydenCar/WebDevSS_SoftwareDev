<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include("eventConnection.php");
include("connection.php");  // Ensure this file sets $pdo correctly
include("common.php");

try {
    require 'layout/header.php';

    // Check if $pdo is initialized and connected
    if (!$pdo) {
        die("Connection failed: " . $pdo->errorInfo());
    }

    var_dump($pdo);  // Debug: Check database connection

    if (isset($_POST['submit'])) {
        try {
            // Check if username and password are set
            if (!isset($_POST['username']) || empty($_POST['username']) || !isset($_POST['password']) || empty($_POST['password'])) {
                throw new Exception("Username and Password are required.");
            }

            $user = [
                "id" => htmlspecialchars($_POST['id']),
                "username" => htmlspecialchars($_POST['username']),
                "password" => password_hash($_POST['password'], PASSWORD_DEFAULT),  // Hash password
                "date" => htmlspecialchars($_POST['date']),
            ];

            var_dump($_POST);  // Debug: Check form data

            $sql = "UPDATE users
                    SET user_name = :username,
                        password = :password,
                        date = :date
                    WHERE id = :id";

            echo $sql . "<br>";  // Debug: Print SQL query

            $statement = $pdo->prepare($sql);

            foreach ($user as $key => &$value) {
                $statement->bindParam(":$key", $value);
            }

            if ($statement->execute()) {
                $success = "User successfully updated.";
            }
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        } catch(Exception $error) {
            echo $error->getMessage();
        }
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id = :id";
        echo $sql . "<br>";  // Debug: Print SQL query
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Something went wrong!";
        exit;
    }

    var_dump($user);  // Debug: Check fetched user data
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
} catch(Exception $error) {
    echo $error->getMessage();
}
?>

<?php if (isset($success)) : ?>
    <p><?php echo $success; ?></p>
<?php endif; ?>

<h2>Edit a user</h2>
<form method="post">
    <?php foreach ($user as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>"
               value="<?php echo htmlspecialchars($value); ?>"
            <?php echo ($key === 'id' ? 'readonly' : ''); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>
<a href="index.php">Back to home</a>
<?php require "layout/footer.php"; ?>
