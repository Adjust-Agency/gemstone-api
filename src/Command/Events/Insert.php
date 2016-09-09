<?php namespace Adjust\GemstoneApi\Command\Events;

use Adjust\GemstoneApi\Command\ApiCommand;

class Insert extends Base implements ApiCommand
{

    protected $command_name   = 'create';
    protected $command_method = 'post';
    protected $values = [];

    private $action_infos = [];

    public function __construct($action_identifier)
    {
        $this->action_identifier = $action_identifier;
        parent::__construct();
    }

    public function insert($entry)
    {
        $this->values = $entry;
    }

}