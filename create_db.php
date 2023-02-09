<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS wsms";
if (mysqli_query($conn, $sql)) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}

// Select database
$conn = mysqli_connect($servername, $username, $password, "wsms");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
  // echo "Table created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
