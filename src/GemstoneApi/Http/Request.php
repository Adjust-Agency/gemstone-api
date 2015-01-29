<?php namespace Adjust\GemstoneApi\Http;

use Adjust\GemstoneApi\Command\ApiCommand;

class Request
{
    public function __construct()
    {

    }

    public function post($url, $postDatas)
    {
        $ch = curl_init(); 
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDatas);   
        $output=curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function get($url)
    {
        $ch = curl_init(); 
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER, false); 
        $output=curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}