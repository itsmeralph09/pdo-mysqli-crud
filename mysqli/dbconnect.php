<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ralph";

// Create connection gamit si mysqli
$connection = new mysqli($servername, $username, $password, $database);

// Check connection kung working
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}
?>