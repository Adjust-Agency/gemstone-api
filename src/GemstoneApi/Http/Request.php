<?php namespace Adjust\GemstoneApi\Http;

class Request
{
    public function __construct($url, $params)
    {
        $this->url = $url;
        $this->params = $params;
    }

    public function post($action, $datas)
    {
        $postDatas = http_build_query($datas);
        $url = $this->url.'/'.$action.'?'.http_build_query($this->params);
        $ch = curl_init(); 
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDatas);   
 
        $output=curl_exec($ch);
 
        curl_close($ch);
        return json_decode($output);
    }

    public function get($action, $datas=array())
    {
        $getDatas = array_merge($this->params, $datas);
        $url = $this->url.'/'.$action.'?'.http_build_query($getDatas);
        echo $url;
        $ch = curl_init(); 
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER, false); 
 
        $output=curl_exec($ch);
 
        curl_close($ch);
        return json_decode($output);
    }
}