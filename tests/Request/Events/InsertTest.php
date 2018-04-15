<?php namespace Request\Events;

class InsertTest extends \TestBootstrap
{
    public function testPostData()
    {
        $event_insert = new \Adjust\GemstoneApi\Command\Events\Insert('action_identifier_12345');
        $event_insert->insert([
            'lastname' => 'John',
            'firstname' => 'Doe',
            'optin' => 1,
            'randomdata' => 'azerty123',
        ]);

        $request_stub = $this->createMock('\Adjust\GemstoneApi\Http\Request');
        $api_request = new \Adjust\GemstoneApi\ApiRequest($request_stub);

        $request_stub->expects($this->exactly(1))
                     ->method('post')
                     ->with('http://gemstone.adjust.be/api/htgf/v1/event/create?api_key=', 'lastname=John&firstname=Doe&optin=1&randomdata=azerty123');

        $result = $api_request->send($event_insert);
    }
}
