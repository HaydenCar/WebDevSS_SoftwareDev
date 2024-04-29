<?php
// Make the PDO object available globally
global $pdo;

// Start a session to store user data between HTTP requests
session_start();

// Include necessary PHP files for database connections and functions
include("eventConnection.php");
include("connection.php");
include("common.php");

// Check if the 'submit' button was pressed
if (isset($_POST['submit'])) {
    // Handle the form submission for updating a user
    try {
        // SQL query to update user details
        $sql = "UPDATE users
                SET user_name = :user_name,
                    password = :password
                WHERE user_id = :user_id";

        $user = [
            "user_id" => escape($_POST['user_id']),
            "user_name" => escape($_POST['user_name']),
            "password" => escape($_POST['password'])
        ];

        // Preparing and executing the SQL statement with user data
        $statement = $pdo->prepare($sql);
        $statement->execute($user);
    } catch(PDOException $error) {
        // Error handling, display SQL query and error message
        echo $sql . "<br>" . $error->getMessage();
    }
}

// Check if the user_id is present in the URL query string
if (isset($_GET['user_id'])) {
    // SQL query to fetch the user details
    $sql = "SELECT * FROM users WHERE user_id = :user_id";

    try {
        // Get user_id from URL
        $user_id = $_GET['user_id'];

        // Prepare and execute the query to fetch user data
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();

        // Fetch the result as an associative array
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        // Display the SQL query and error message if an exception occurs
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    // If user_id is not set, show an error message and terminate the script
    echo "Something went wrong!";
    exit;
}
?>
<!-- Include the header template for the website -->
<?php require "templates/header.php"; ?>

<!-- Display success message if the form was submitted successfully -->
<?php if (isset($_POST['submit']) && $statement) : ?>
    <?php echo escape($_POST['user_name']); ?> successfully updated.
<?php endif; ?>

<h2>Edit a user</h2>
<form method="post">
    <!-- Generate form fields for each attribute of the user -->
    <?php foreach ($user as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst(str_replace('_', ' ', $key)); ?></label>
        <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'user_id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>
<!-- Link to return to the home page -->
<a href="index.php">Back to home</a>

<!-- Include the footer template for the website -->
<?php require "layout/footer.php"; ?>
