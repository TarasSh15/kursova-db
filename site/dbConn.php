<?php

$servername = "localhost";
$username = "root";
$password = "123321";
$database = "display";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>