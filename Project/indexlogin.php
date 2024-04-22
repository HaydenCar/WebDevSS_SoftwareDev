<?php global $pdo;
require 'layout/header.php'?>

<?php
session_start();

include("connection.php");
include("function.php");

$user_data = check_login($pdo);
?>

<DOCTYPE html>
    <html>
    <head>
        <title>My website </title>
    </head>
    <body>

    <a href = "logout.php"> Logout</a>
    <h1> This is the index page</h1>

    <br>
    Hello, <?php echo $user_data['user_name']; ?>
    </body>
    </html>
</DOCTYPE>

<?php require "layout/footer.php" ?>