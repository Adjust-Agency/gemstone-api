<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);

require __DIR__.'/../autoload.php';

$key = '12345';
$actions_insert = new Adjust\GemstoneApi\Command\Actions\Insert($key, 'dsqf','sdf','sdfs');
//insert one by one
$actions_insert->insert(array('field1' => 'value1', 'field2' => 'value2', 'field3' => 'value3', 'field4' => 'value4'));
$actions_insert->insert(array('field12' => 'value12', 'field22' => 'value22', 'field32' => 'value32', 'field42' => 'value42'));
//insert multiple
$actions_insert->inserts(array(
    array('field1' => 'value1', 'field2' => 'value2', 'field3' => 'value3', 'field4' => 'value4'),
    array('field12' => 'value12', 'field22' => 'value22', 'field32' => 'value32', 'field42' => 'value42')
));
//do the request
$api_request = Adjust\GemstoneApi\ApiRequest::make();
$api_request->send($actions_insert);