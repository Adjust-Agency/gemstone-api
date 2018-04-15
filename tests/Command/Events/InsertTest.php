<?php namespace Command\Events;

class InsertTest extends \TestBootstrap
{
    public function testSetKey()
    {
        $key = 'adg45d7fdds764d53dfg';
        $url = 'http://gemstone.adjust.be/api/htgf/v1/event/create?api_key='.$key;

        $event_insert = new \Adjust\GemstoneApi\Command\Events\Insert('action_identifier_12345');
        $event_insert->setApiKey($key);

        $this->assertEquals($event_insert->getCommandName(), 'create');
        $this->assertEquals($event_insert->getCommandMethod(), 'post');
        $this->assertEquals($event_insert->getCommandUrl(), $url);
    }

    public function testSetBaseUrl()
    {
        $key = 'adg45d7fdds764d53dfg';
        $url = 'http://gemstone.loc/api/htgf/v1/event/create?api_key='.$key;

        $event_insert = new \Adjust\GemstoneApi\Command\Events\Insert('action_identifier_12345');
        $event_insert->setApiKey($key);
        $event_insert->setBaseUrl('http://gemstone.loc');

        $this->assertEquals($event_insert->getCommandName(), 'create');
        $this->assertEquals($event_insert->getCommandMethod(), 'post');
        $this->assertEquals($event_insert->getCommandUrl(), $url);
    }

    public function testInsert()
    {
        $event_insert = new \Adjust\GemstoneApi\Command\Events\Insert('action_identifier_12345');
        $event_insert->insert([
            'lastname' => 'John',
            'firstname' => 'Doe',
            'optin' => 1,
            'randomdata' => 'azerty123',
        ]);

        $this->assertEquals($event_insert->getCommandValues(), [
            'lastname' => 'John',
            'firstname' => 'Doe',
            'optin' => 1,
            'randomdata' => 'azerty123',
        ]);
    }
}
