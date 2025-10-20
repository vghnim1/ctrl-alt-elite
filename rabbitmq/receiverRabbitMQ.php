#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($username,$password)
{
    // use to require database established
    // $mysqli = require __DIR__ . "users"; TODO create database table

    // sanitize login
    $uname = mysqli -> real_escape_string($username);
    $pass = mysqli -> real_escape_string($password);

    // create sql select statement
    $sql = sprintf('SELECT /*password*/ from /*login table*/ where email = "%s"',
      $uname);

    // query database
    $result = $mysqli -> query($sql);

    if ($result && $user = $result -> fetch_assoc()) {
      // check password
      if ($pass == $user['password']){
        return array ("returnCode" => '1', 'message'=>"Login successful"); 
      } else {
        return array ("returnCode" => '0', 'message'=>"Wrong password");
      } } else {
        return array ("returnCode" => '0', 'message'=>"User not found");
    }
} 

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
      return doLogin($request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>

