<?php namespace Command\Engagements;

class UpdateTest extends \TestBootstrap
{
    public function testSetKey()
    {
        $key = 'adg45d7fdds764d53dfg';
        $url = 'http://gemstone.adjust.be/api/htgf/v1/engagement/update?api_key='.$key;

        $enga_update = new \Adjust\GemstoneApi\Command\Engagements\Update();
        $enga_update->setApiKey($key);

        $this->assertEquals($enga_update->getCommandName(), 'update');
        $this->assertEquals($enga_update->getCommandMethod(), 'post');
        $this->assertEquals($enga_update->getCommandUrl(), $url);
    }

    public function testSetBaseUrl()
    {
        $key = 'adg45d7fdds764d53dfg';
        $url = 'http://gemstone.loc/api/htgf/v1/engagement/update?api_key='.$key;

        $enga_update = new \Adjust\GemstoneApi\Command\Engagements\Update();
        $enga_update->setApiKey($key);
        $enga_update->setBaseUrl('http://gemstone.loc');

        $this->assertEquals($enga_update->getCommandName(), 'update');
        $this->assertEquals($enga_update->getCommandMethod(), 'post');
        $this->assertEquals($enga_update->getCommandUrl(), $url);
    }

    public function testInsert()
    {
        $enga_update = new \Adjust\GemstoneApi\Command\Engagements\Update();
        $enga_update->insert([
            'where' => [
                'action_identifier' => 'mc-2342',
            ],
            'optin' => 0
        ]);

        $this->assertEquals($enga_update->getCommandValues(), [
            'where' => [
                'action_identifier' => 'mc-2342',
            ],
            'optin' => 0
        ]);
    }
}
