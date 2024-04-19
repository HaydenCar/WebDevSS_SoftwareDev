<?php

require_once 'user.php';
session_start();

$user = new User();

if (isset($_SESSION['user_id'])) {
    $user_data = $user->checkLogin($_SESSION['user_id']);
}
?>