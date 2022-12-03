<?php

$servername ="sql300.byethost17.com";
$database = "b17_33033567_praktikum_db";
$username = "b17_33033567";
$password = "dwtq6kxf";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

 ?>