<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);

require __DIR__.'/../autoload.php';

$key = '12345';
$actions_fields = new Adjust\GemstoneApi\Command\Actions\GetFields($key);
//do the request
$api_request = Adjust\GemstoneApi\ApiRequest::make();
$result = $api_request->send($actions_fields);
var_dump($result);