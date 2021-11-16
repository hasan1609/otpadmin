<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otp";

$mysqli = mysqli_connect($servername, $username, $password, $dbname);

$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
