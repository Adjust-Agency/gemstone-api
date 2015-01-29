<?php namespace Adjust\GemstoneApi\Command\Actions;

abstract class Base
{
    //const URL_API = 'http://gemstone.adjust.be/actions/api';
    const URL_API = 'http://localhost:8000/actions/api';

    protected $key;

    public function __construct($key)
    {
        $this->key = $key;
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