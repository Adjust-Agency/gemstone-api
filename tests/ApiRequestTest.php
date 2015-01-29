<?php

class ApiRequestTest extends TestBootstrap
{
    public function testBuildGetUrl()
    {
        $request_stub = $this->getMock('Adjust\GemstoneApi\Http\Request');
        $api_request = new Adjust\GemstoneApi\ApiRequest($request_stub);
        $url = $api_request->buildGetUrl('http://www.example.com/test', array('test'=>'yep','hello'=>'world'));
        $this->assertEquals($url, 'http://www.example.com/test?test=yep&hello=world');
        $url = $api_request->buildGetUrl('http://www.example.com/test?first', array('test'=>'yep','hello'=>'world'));
        $this->assertEquals($url, 'http://www.example.com/test?first&test=yep&hello=world');
    }

    public function testPostSend()
    {
        $request_stub = $this->getMock('Adjust\GemstoneApi\Http\Request');
        $request_stub->expects($this->exactly(1))
                     ->method('post')
                     ->will($this->returnValue(json_encode(array('return'=>'yeah'))));
        $command_stub = $this->getMock('Adjust\GemstoneApi\Command\ApiCommand');
        $command_stub->expects($this->exactly(1))
                     ->method('getCommandMethod')
                     ->will($this->returnValue('post'));
        $command_stub->expects($this->exactly(1))
                     ->method('getCommandUrl')
                     ->will($this->returnValue('http://www.example.com/test'));
        $command_stub->expects($this->exactly(1))
                     ->method('getCommandValues')
                     ->will($this->returnValue(array('hello'=>'world')));
        $api_request = new Adjust\GemstoneApi\ApiRequest($request_stub);
        $result = $api_request->send($command_stub);
        $this->assertEquals($result->return, 'yeah');
            
    }

    public function testGetSend()
    {
        $request_stub = $this->getMock('Adjust\GemstoneApi\Http\Request');
        $request_stub->expects($this->exactly(1))
                     ->method('get')
                     ->will($this->returnValue(json_encode(array('return'=>'yeah'))));
        $command_stub = $this->getMock('Adjust\GemstoneApi\Command\ApiCommand');
        $command_stub->expects($this->exactly(1))
                     ->method('getCommandMethod')
                     ->will($this->returnValue('get'));
        $command_stub->expects($this->exactly(1))
                     ->method('getCommandUrl')
                     ->will($this->returnValue('http://www.example.com/test'));
        $command_stub->expects($this->exactly(1))
                     ->method('getCommandValues')
                     ->will($this->returnValue(array('hello'=>'world')));
        $api_request = new Adjust\GemstoneApi\ApiRequest($request_stub);
        $result = $api_request->send($command_stub);
        $this->assertEquals($result->return, 'yeah');
            
    }

}