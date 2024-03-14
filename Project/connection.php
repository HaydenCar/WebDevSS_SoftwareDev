<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Abushaban123";
$dbname = "login_sample";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed to connect!");
}
