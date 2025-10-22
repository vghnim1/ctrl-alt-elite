#!/usr/bin/php
<?php

$db1 = 'authorizationdb';
$db2 = 'it490';
$mydb = new mysqli('127.0.0.1', 'Sebas', 'IT490', 'authorizationdb');

if ($mydb->errno != 0) {
    echo "Failed to connect to database: " . $mydb->error . PHP_EOL;
    exit(0);
}

echo "Successfully connected to database: " . $db1 . PHP_EOL;

// Query to select all users (no need for bind_param here)
$nquery = "SELECT * FROM users;";
$response = $mydb->query($nquery);

if ($mydb->errno != 0) {
    echo "Failed to execute query:" . PHP_EOL;
    echo __FILE__ . ':' . __LINE__ . ": error: " . $mydb->error . PHP_EOL;
    exit(0);
}

echo "Users from authorizationdb:\n";
while ($user = $response->fetch_assoc()) {
    echo $user['username'] . " - " . $user['email'] . PHP_EOL;
}

$mydb->close();

$mydb = new mysqli('127.0.0.1', 'Sebas', 'IT490', 'it490');

if ($mydb->errno != 0) {
    echo "Failed to connect to database: " . $mydb->error . PHP_EOL;
    exit(0);
}

echo "Successfully connected to database: " . $db2 . PHP_EOL;

// Create the user_login table if it doesn't exist
$query = "CREATE TABLE IF NOT EXISTS user_login (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(60) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($mydb->query($query) === TRUE) {
    echo "Table 'user_login' created successfully in it490 database.\n";
} else {
    echo "Error creating table: " . $mydb->error . PHP_EOL;
}

// Close the connection to it490 database
$mydb->close();

?>
