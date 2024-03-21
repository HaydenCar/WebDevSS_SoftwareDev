<?php


function check_login($pdo)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);

        if ($stmt && $stmt->rowCount() > 0) {
            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user_data;
        }
    }

    header("Location: login.php");
    die;
}

function random_num($length)
{
    $text = "";
    if ($length < 5) {
        $length = 5;
    }

    $len = rand(4, $length);

    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }

    return $text;
}

