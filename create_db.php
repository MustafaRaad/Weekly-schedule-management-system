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
    user_type INT(1) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
  // echo "Table created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

// Create table
$sql = "CREATE TABLE IF NOT EXISTS classes (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    college VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    PRIMARY KEY (id)
)";

if (mysqli_query($conn, $sql)) {
  // echo "Table created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}
// Create table
$sql = "CREATE TABLE IF NOT EXISTS materials (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    college VARCHAR(255) NOT NULL,
    units INT(2) NOT NULL,
    date DATE NOT NULL,
        class_id INT(11) NOT NULL,
     PRIMARY KEY (id),
         FOREIGN KEY (class_id) REFERENCES classes(id)

)";

if (mysqli_query($conn, $sql)) {
  // echo "Table created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}


mysqli_close($conn);
