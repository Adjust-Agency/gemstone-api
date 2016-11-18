<?php namespace Adjust\GemstoneApi\Facade;

class Events {

    protected $infos_keys = ['lastname', 'firstname', 'address', 'number', 'city', 'postcode'];

    public static function insertPostFormResult($action_identifier, $form_name, $email, $lng, $optin, $datas, $type = 'lead') {
        
        $events_insert = new \Adjust\GemstoneApi\Command\Events\Insert($action_identifier);

        $insert_data = [
            'event_name'  => 'filled_form',
            'event_value' => $form_name,
            'action'      => $action_identifier,
            'email'       => $email,
            'lng'         => $lng,
            'optin'       => $optin,
            'type'        => $type,
            'hash'        => !empty($_COOKIE['htgs_ref']) ? $_COOKIE['htgs_ref'] : null,
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