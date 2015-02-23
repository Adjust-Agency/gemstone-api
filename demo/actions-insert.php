<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);

require __DIR__.'/../autoload.php';

$key = '12345';
$product = 'product name';
$action = 'action name';
$started_at = date('Y-m-d');
$account_id = 17;

$actions_insert = new Adjust\GemstoneApi\Command\Actions\Insert($key, $product, $action, $started_at, $account_id);
//insert one by one
$actions_insert->insert(array(
    'lastname' => 'Johnson', 
    'firstname' => 'Lindon', 
    'address' => 'street of name', 
    'number' => '52', 
    'city' => 'Point Place',
    'postcode' => '45235',
    'email' => 'jl@me.com',
    'lang' => 'en',
    'optin' => 1
));
$actions_insert->insert(array(
    'lastname' => 'Jackson', 
    'firstname' => 'Jeremy', 
    'address' => 'Long street', 
    'number' => '2', 
    'city' => 'Three Hill',
    'postcode' => '5200',
    'email' => 'jj@acme.com',
    'lang' => 'en',
    'optin' => 0
));
//insert multiple
/*
$actions_insert->inserts(array(
    array('field1' => 'value1', 'field2' => 'value2', 'field3' => 'value3', 'field4' => 'value4'),
    array('field12' => 'value12', 'field22' => 'value22', 'field32' => 'value32', 'field42' => 'value42')
));
*/
//do the request
$api_request = Adjust\GemstoneApi\ApiRequest::make();
$result = $api_request->send($actions_insert);
var_dump($result);