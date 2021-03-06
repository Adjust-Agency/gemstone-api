<?php namespace Adjust\GemstoneApi\Facade;

class Events
{
    protected static $api_key = null;

    public static function insertPostFormResult($action_identifier, $form_name, $email, $lng, $optin, $datas, $type = 'lead')
    {
        $result = self::insert('filled_form', $action_identifier, $form_name, $email, $lng, $optin, $datas, $type);

        return $result;
    }

    public static function insertEmailSend($action_identifier, $email, $lng, $type = 'lead')
    {
        $result = self::insert('email_sent', $action_identifier, '', $email, $lng, 1, [], $type);

        return $result;
    }

    public static function insert($event_name, $action_identifier, $event_value, $email, $lng, $optin, $datas, $type = 'lead')
    {
        $events_insert = new \Adjust\GemstoneApi\Command\Events\Insert($action_identifier);
        $events_insert->setApiKey(self::$api_key);

        $insert_data = [
            'event_name'           => $event_name,
            'event_value'          => $event_value,
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
        
        $hashKey = '_gmst';
        if(!empty($_GET[$hashKey]) || !empty($datas[$hashKey])) {
            $base64 = !empty($_GET[$hashKey]) ? $_GET[$hashKey] : $datas[$hashKey];
            parse_str(base64_decode($base64), $_source);
            if(!empty($_source) && is_array($_source)) {
                
                // Do something with $_source['traffic_type'] and $_source['traffic_value']
                foreach($_source as $key => $value) {
                    $insert_data['pinfo_'.$key] = $value;
                }
            }
            try {
                unset($insert_data['pinfo_' . $hashKey]);
            } catch(\Exception $e) {
                // dies silently
            }
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
