<?php
global $pdo;
require 'eventConnections.php';  // Your PDO database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['performer_name'];

    $sql = "INSERT INTO performers (performer_name) VALUES (?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name]);

    echo "<p>Performer added successfully!</p>";
}
?>
<form method="post">
    Performer Name: <input type="text" name="performer_name"><br>
    <input type="submit" value="Add Performer">
</form>
