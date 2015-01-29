<?php namespace Command\Actions;

class InsertTest extends \TestBootstrap
{
    public function testInstantiation()
    {
        $key = 'adg45d7fdds764d53dfg';
        $product = 'one product';
        $action = 'action_name';
        $started_at = '2015-07-12';
        $account_id = 5;
        $url = 'http://localhost:8000/actions/api/insert?key='.$key;
        $actions_insert = new \Adjust\GemstoneApi\Command\Actions\Insert($key, $product, $action, $started_at, $account_id);
        $this->assertEquals($actions_insert->getCommandName(),'insert');
        $this->assertEquals($actions_insert->getCommandMethod(),'post');
        $this->assertEquals($actions_insert->getCommandUrl(),$url);
    }

    public function testValues()
    {
        $key = 'adg45d7fdds764d53dfg';
        $product = 'one product';
        $action = 'action_name';
        $started_at = '2015-07-12';
        $account_id = 5;
        $actions_insert = new \Adjust\GemstoneApi\Command\Actions\Insert($key, $product, $action, $started_at, $account_id);
        $actions_insert->insert(array('field1' => 'value1', 'field2' => 'value2', 'field3' => 'value3', 'field4' => 'value4'));
        $actions_insert->insert(array('field12' => 'value12', 'field22' => 'value22', 'field32' => 'value32', 'field42' => 'value42'));
        $actions_insert->inserts(array(
            array('field1' => 'value1', 'field2' => 'value2', 'field3' => 'value3', 'field4' => 'value4'),
            array('field12' => 'value12', 'field22' => 'value22', 'field32' => 'value32', 'field42' => 'value42')
        ));
        $this->assertEquals($actions_insert->getCommandValues(),array('list'=>array(
            array('product' => $product, 'action' => $action, 'started_at' => $started_at, 'account_id' => $account_id, 'field1' => 'value1', 'field2' => 'value2', 'field3' => 'value3', 'field4' => 'value4'),
            array('product' => $product, 'action' => $action, 'started_at' => $started_at, 'account_id' => $account_id, 'field12' => 'value12', 'field22' => 'value22', 'field32' => 'value32', 'field42' => 'value42'),
            array('product' => $product, 'action' => $action, 'started_at' => $started_at, 'account_id' => $account_id, 'field1' => 'value1', 'field2' => 'value2', 'field3' => 'value3', 'field4' => 'value4'),
            array('product' => $product, 'action' => $action, 'started_at' => $started_at, 'account_id' => $account_id, 'field12' => 'value12', 'field22' => 'value22', 'field32' => 'value32', 'field42' => 'value42')
        )));
    }
}