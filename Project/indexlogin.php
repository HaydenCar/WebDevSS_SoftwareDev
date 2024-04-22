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

    <a href = "logout.php"> Click here to Logout</a>
    <h1> You are logged in as <?php echo $user_data['user_name']?></h1>
    </body>
    </html>
</DOCTYPE>

<?php require "layout/footer.php" ?>