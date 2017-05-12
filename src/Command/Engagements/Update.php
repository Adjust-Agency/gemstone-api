<?php namespace Adjust\GemstoneApi\Command\Engagements;

use Adjust\GemstoneApi\Command\ApiCommand;

class Update extends Base implements ApiCommand
{

    protected $command_name   = 'update';
    protected $command_method = 'post';
    protected $values = array('list'=>array());

    public function __construct($key)
    {
        parent::__construct($key);
    }

    public function insert($entry)
    {
        $this->inserts(array($entry));
    }

    public function inserts($entries)
    {
        foreach ($entries as $key => $value) {
            $this->values['list'][] = $value;
        }
        
    }

}