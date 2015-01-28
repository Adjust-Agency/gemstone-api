<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);

require __DIR__.'/../autoload.php';

$key = '12345';
$api_actions = new Adjust\GemstoneApi\Actions($key);
//demo get fields
$fields = $api_actions->getFields();
var_dump($fields);
//demo insert
$result = $api_actions->insert(array(
    array('fsdf'=>'fds'),
    array('fsdf2'=>'fds2'),
));
