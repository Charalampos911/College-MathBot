<?php

/* Database connection settings */
error_reporting(E_ALL);

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'mathbot';

$con = mysqli_connect($host, $user, $pass, $db);

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (!mysqli_set_charset($con, "utf8")) {
    die("Error setting UTF-8: " . mysqli_error($con));
}

?>