<?php

$host = "voting-mysql";
$user = "root";
$password = "root";
$database = "voting_db";

$conn = new mysqli($host,$user,$password,$database);

if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

?>
