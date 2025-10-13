#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "login request";
}

$request = array();

/* Used for testing
$request['type'] = "Login";
$request['username'] = "steve";
$request['password'] = "password"; */

// Login 
$request['type'] = "Login";
$request['username'] = $_POST['username'];
$request['password'] = $_POST['password'];

$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

// test if login is successful
// TODO add code here 
/* return code from recieverRabbitMQ.php
  if return code = 1, login successful
    change page to home
  if return code = 0, login failed
    return to login page
*/

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;

