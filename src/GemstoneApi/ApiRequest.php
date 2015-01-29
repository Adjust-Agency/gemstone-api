<?php namespace Adjust\GemstoneApi;

use Adjust\GemstoneApi\Http\Request;
use Adjust\GemstoneApi\Command\ApiCommand;

class ApiRequest
{

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(ApiCommand $command)
    {
        $method = $command->getCommandMethod();
        $url = $command->getCommandUrl();
        $values = $command->getCommandValues();
        switch ($method) {
            case 'post':
                $postDatas = http_build_query($values);
                return json_decode($this->request->post($url, $postDatas));
                break;
            
            case 'get':
                $url = $this->buildGetUrl($url, $values);
                return json_decode($this->request->get($url));
                break;
        }
    }

    public function buildGetUrl($url, $datas)
    {
        $query_string_separator = strpos($url, '?')!==false?'&':'?';
        $url .= $query_string_separator.http_build_query($datas);
        return $url;
    }

    public static function make()
    {
        return new self(new Request());
    }

    
}