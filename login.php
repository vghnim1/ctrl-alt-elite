<?php
echo "logging in...";

// RabbitMQ library files
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

// Connection to the RabbitMQ client 
$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

if (isset($argv[1])) {
    $msg = $argv[1];
} else {
    $msg = "login request sent";
}


$username = $_POST['username'];  
$password = $_POST['password'];  
$d = time();  
// Check if the user is already logged in (if needed)
if ($loggedin == true) {
    exit();
}

// request to send to RabbitMQ for login authentication
$request = array(); 
$request['type'] = "login";  
$request['username'] = $username;  
$request['password'] = $password;  
$request['session'] = $d;  
$request['message'] = $msg;  

// Send the login request to RabbitMQ
$response = $client->send_request($request);

// Handle the response from RabbitMQ
if ($response['returnCode'] == 1) {  // If login is successful
    header("Location: home.php");  // Redirect to home page
} else if ($response['returnCode'] == 0) {  // If login fails
    echo "Login failed. Please try again.";  
    header("Location: index.php");  // Redirect back to the login page
    exit();
}

$loggedin = true;  
echo "client received response: ".PHP_EOL;
print_r($response);  
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
?>
