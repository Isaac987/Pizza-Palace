<?php

$db_servername = "localhost";
$db_username = "isaac";
$db_password = "password";
$db = "pizza_palace";

// Create connection
$conn = mysqli_connect($db_servername, $db_username, $db_password, $db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>