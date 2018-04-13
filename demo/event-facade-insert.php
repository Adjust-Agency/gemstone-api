<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);

require __DIR__.'/../autoload.php';

$key = '12345';

$actions_update = new Adjust\GemstoneApi\Command\Actions\Update($key);
//update one by one
$actions_update->insert(array(
    'where' => array(
        'email' => 'dd@acme.com', 
        'product' => 'product', 
    ),
    'optin' => 0
));
$actions_update->insert(array(
    'where' => array(
        'email' => 'jj@acme.com', 
        'product' => 'product', 
    ),
    'optin' => 0
));

//do the request
$api_request = Adjust\GemstoneApi\ApiRequest::make();
$result = $api_request->send($actions_update);
var_dump($result);