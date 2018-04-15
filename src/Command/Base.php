<?php namespace Adjust\GemstoneApi\Command;

abstract class Base implements ApiCommand
{

    protected $api_key = null;
    protected $base_url = 'http://gemstone.adjust.be';
    protected $uri;

    public function __construct()
    {
    }

    public function setApiKey($api_key)
    {
        $this->api_key = $api_key;
    }

    public function setBaseUrl($base_url)
    {
        $this->base_url = $base_url;
    }

    public function getCommandUrl()
    {
        return $this->base_url.$this->uri.'/'.$this->getCommandName().'?api_key='.$this->api_key;
    }

    public function getCommandName()
    {
        return $this->command_name;
    }

    public function getCommandMethod()
    {
        return $this->command_method;
    }

    public function getCommandValues()
    {
        return $this->values;
    }
}
