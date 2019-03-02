<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/../autoload.php';

$api_key = '12345';

$action_identifier = "test-action-001";
$email = "john@example.com";
$lng = "fr";
$from = ['name' => 'Api Tester', 'address' => 'test@gemstone.mx'];
$subject = 'Test Send via API';

// Set api key
Adjust\GemstoneApi\Facade\Events::setApiKey($api_key);
// Insert
$result = Adjust\GemstoneApi\Facade\Events::insertEmailSend($action_identifier, $email, $lng);

if ($result && $result->success === 1) {
    $prospect_id = $result->prospect_id;
    $campaign_id = 14;
    $merge_tags = ['tag' => 'hello world'];

    // Send
    $result = Adjust\GemstoneApi\Facade\AutomationEmail::send($api_key, $campaign_id, $prospect_id, $merge_tags, $from, $subject);

    var_dump($result);
}
