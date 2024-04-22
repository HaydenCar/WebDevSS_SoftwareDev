<?php


function check_login($pdo) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: UserLogin.php");
        die;
    }

    // Assume user_id is in session
    $id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE user_id = :id LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    if ($stmt->rowCount() > 0) {
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user_data;
    }
    // Redirect if no user found (which should be unlikely if user_id was in the session)
    header("Location: UserLogin.php");
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

