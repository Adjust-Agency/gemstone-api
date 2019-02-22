<?php namespace Adjust\GemstoneApi\Facade;

class AutomationEmail
{
    public static function send($api_key, $campaign_id, $prospect_id, $merge_tags)
    {
        $email_create = new \Adjust\GemstoneApi\Command\Automation\EmailCreate();
        $email_create->setApiKey($api_key);

        $create_data = [
            'campaign_id' => $campaign_id,
            'prospect_id' => $prospect_id,
            'merge_tags'  => $merge_tags,
        ];

        $email_create->create($create_data);
        $api_request = \Adjust\GemstoneApi\ApiRequest::make();
        $result = $api_request->send($email_create);

        return $result;
    }
}
