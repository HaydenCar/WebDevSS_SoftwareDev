<?php global $pdo;
require 'layout/header.php'?>

<?php
session_start();

include("connection.php");
include("function.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        $query = "SELECT * FROM users WHERE user_name = :user_name LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['user_name' => $user_name]);

        if($stmt && $stmt->rowCount() > 0) {
            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user_data['password'] === $password) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: index.php");
                die;
            }
        }
        echo "Wrong username or password!";
    } else {
        echo "Wrong username or password!";
    }
}
?>

<DOCTYPE html>
    <html>
    <head>
        <title>Login </title>
    </head>
    <body>
    <style type="text/css">
        #text {

            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
        }

        #button{
            padding:10px;
            width:100px;
            color:white;
            background-color: lightblue;
            border: none;
        }

        #box{
            background-color: grey;
            margin:auto;
            width: 300px;
            padding: 20px;
        }
    </style>

    <div id = "box">
        <form method ="post">
            <div style="font-size: 20px;margin:10px;color: white;">Login</div>

            <input id="text" type="text" name = "user_name"><br><br>
            <input id="text" type="password" name = "password"><br><br>

            <input id="button" type="submit" value = "login"><br><br>

            <a href ="signup.php"> Click to Signup</a>


        </form>
    </div>
    </body>
    </html>
</DOCTYPE>

