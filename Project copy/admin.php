<?php
session_start();
include("eventConnection.php");
include("connection.php");
include("function.php");

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != '1') {
    header('Location: index.php');
    exit;
}

try {
    global $pdo;
    require 'layout/header.php';

    if (!$pdo) {
        die("Connection failed: " . $pdo->errorInfo());
    }

    $sql = "SELECT * FROM users";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $error) {
    echo "Error executing query: " . $error->getMessage();
}
?>
<h2>Update users</h2>
<table>
    <thead>
    <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Date</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo htmlspecialchars($row["user_id"]); ?></td>
            <td><?php echo htmlspecialchars($row["user_name"]); ?></td>
            <td><?php echo htmlspecialchars($row["password"]); ?></td>
            <td><?php echo htmlspecialchars($row["date"]); ?> </td>
            <td><a href="update-single.php?id=<?php echo htmlspecialchars($row["id"]); ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="index.php">Back to home</a>
<?php require "layout/footer.php"; ?>
