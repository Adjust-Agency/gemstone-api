<?php namespace Adjust\GemstoneApi\Command\Engagements;

abstract class Base
{
    //const URL_API = 'http://gemstone.local/api/htgf/v1/engagement';
    const URL_API = 'http://gemstone.adjust.be/api/htgf/v1/engagement';

    protected $key;

    public function __construct()
    {
    }

    public function getCommandUrl()
    {
        return self::URL_API.'/'.$this->getCommandName().'?key='.$this->key;
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