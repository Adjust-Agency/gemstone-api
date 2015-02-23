<?php namespace Command\Actions;

class GetFieldsTest extends \TestBootstrap
{
    public function testInstantiation()
    {
        $key = 'adg45d7fdds764d53dfg';
        $url = 'http://gemstone.adjust.be/actions/api/show-fields?key='.$key;
        $actions_insert = new \Adjust\GemstoneApi\Command\Actions\GetFields($key);
        $this->assertEquals($actions_insert->getCommandName(),'show-fields');
        $this->assertEquals($actions_insert->getCommandMethod(),'get');
        $this->assertEquals($actions_insert->getCommandUrl(),$url);
    }

}