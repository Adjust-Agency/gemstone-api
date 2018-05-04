<?php namespace Adjust\GemstoneApi\Facade;

class Events
{
    protected static $api_key = null;

    public static function insertPostFormResult($action_identifier, $form_name, $email, $lng, $optin, $datas, $type = 'lead')
    {
        
        $events_insert = new \Adjust\GemstoneApi\Command\Events\Insert($action_identifier);
        $events_insert->setApiKey(self::$api_key);

        $insert_data = [
            'event_name'           => 'filled_form',
            'event_value'          => $form_name,
            'action'               => $action_identifier,
            'email'                => $email,
            'lng'                  => $lng,
            'optin'                => $optin,
            'type'                 => $type,
            'hash'                 => !empty($_COOKIE['htgs_ref']) ? $_COOKIE['htgs_ref'] : null,
            
            'http_client_ip'       => !empty($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : null,
            'http_x_forwarded_for' => !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null,
            'remote_addr'          => !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null,
            'http_referer'         => !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null,
            'http_host'            => !empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null,
            'request_uri'          => !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null,
        ];

        foreach ($datas as $key => $value) {
            $insert_data['pinfo_'.$key] = $value;
        }

        $events_insert->insert($insert_data);
        $api_request = \Adjust\GemstoneApi\ApiRequest::make();
        $result = $api_request->send($events_insert);

        if (!empty($result->success) && $result->success == 1) {
            // update hash
            $newfull_hash = self::updateHash($insert_data['hash'], $result->hash, $result->bit);
            setcookie('htgs_ref', $newfull_hash, 0, '/');
        }

        return $result;
    }

    public static function setApiKey($api_key)
    {
        self::$api_key = $api_key;
    }

    protected static function updateHash($fullhash, $new_hashpart, $new_bit)
    {
        $split = explode('.', $fullhash);
        $data  = [
            'hash' => $new_hashpart,
            'bit' => $new_bit,
            'created_at' => !empty($split[2]) ? $split[2] : '',
            'prev_ts' => !empty($split[3]) ? $split[3] : '',
            'updated_at' => !empty($split[4]) ? $split[4] : '',
        ];
        return implode('.', $data);
    }
}
