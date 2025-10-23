<?php

$host = '10.147.17.72';
$username = 'Sebas';
$password = 'IT490';
$database = 'authorizationdb';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

$conn->close();

?> 