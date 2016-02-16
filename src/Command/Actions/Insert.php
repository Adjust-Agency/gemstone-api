<?php namespace Adjust\GemstoneApi\Command\Actions;

use Adjust\GemstoneApi\Command\ApiCommand;

class Insert extends Base implements ApiCommand
{

    protected $command_name   = 'insert';
    protected $command_method = 'post';
    protected $values = array('list'=>array());

    private $action_infos = array();

    public function __construct($key, $product, $action, $started_at, $account_id = null)
    {
        $this->action_infos = array(
            'product' => $product,
            'action' => $action,
            'started_at' => $started_at,
            'account_id' => $account_id
        );
        parent::__construct($key);
    }

    public function insert($entry)
    {
        $this->inserts(array($entry));
    }

    public function inserts($entries)
    {
        foreach ($entries as $key => $value) {
            $value['product'] = $this->action_infos['product'];
            $value['action'] = $this->action_infos['action'];
            $value['started_at'] = $this->action_infos['started_at'];
            if(isset($this->action_infos['account_id']) && $this->action_infos['account_id']) {
                $value['account_id'] = $this->action_infos['account_id'];
            }
            $this->values['list'][] = $value;
        }
        
    }

}