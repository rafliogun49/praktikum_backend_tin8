<?php

$servername ="localhost";
$database = "test";
$username = "rafli";
$password = "admin";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $sql = "
// CREATE TABLE sunscreen (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     nama VARCHAR(255) NOT NULL,
//     harga INT(64) NOT NULL,
//     rating INT(64) NOT NULL,
//     tekstur VARCHAR(255) NOT NULL,
//     manfaat VARCHAR(255) NOT NULL,
//     spf VARCHAR(255) NOT NULL,
//     keunggulan VARCHAR(255) NOT NULL,
//     gambar VARCHAR(255) NOT NULL,
//     time_data TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";
// if ($conn->query($sql) === TRUE) {
//     echo "Table sunscreen created successfully";
//   } else {
//     echo "Error creating table: " . $conn->error;
//   }

// $conn->close();

// $sql = "INSERT INTO sunscreen (nama, harga, rating, tekstur, manfaat, spf, keunggulan, gambar)
// VALUES ('test', 65000, 8, 'test tekstur', 'test manfaat', 'test spf', 'test keunggulan', './image/skinaqua.png')";

// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $conn->close();


 ?>

