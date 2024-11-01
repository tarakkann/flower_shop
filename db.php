<?php
$servername = "localhost";
$username = "u2378827_tarakan";
$password = "vopolo456QW7";
$dbname = "u2378827_flower_shop";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

?>

