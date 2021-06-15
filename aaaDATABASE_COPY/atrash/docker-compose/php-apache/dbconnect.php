<?php

$db_host = "192.168.237.80";
// $db_host = "localhost";
$db_name = "classe";
$db_user = "admin";
$db_pass = "1234";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>