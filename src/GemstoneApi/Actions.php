<?php namespace Adjust\GemstoneApi;

class Actions
{
    const URL_API = 'http://gemstone.adjust.be/actions/api';

    public function __construct($key)
    {
        $this->key = $key;
        $this->request = new Http\Request(self::URL_API, array('key'=>$key));
    }

    public function insert($actions)
    {
        $datas = array(
            'actions' => $actions
        );
        $result = $this->request->post('insert',$datas);
        return $result;
    }

    public function getFields()
    {
        $result = $this->request->get('show-fields');
        return $result;
    }

}