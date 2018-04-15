<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/../autoload.php';

$key = '12345';

$action_identifier = "test-action-001";
$form_name = "test-form";
$email = "test@example.com";
$lng = "fr";
$optin = true;
$datas = [
    "fistname" => "John",
    "lastname" => "Doe",
];
$type = "lead";

$result = Adjust\GemstoneApi\Facade\Events::insertPostFormResult(
    $action_identifier,
    $form_name,
    $email,
    $lng,
    $optin,
    $datas,
    $type
);

var_dump($result);
