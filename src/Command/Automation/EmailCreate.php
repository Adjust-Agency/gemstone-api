<?php namespace Adjust\GemstoneApi\Command\Automation;

use Adjust\GemstoneApi\Command\ApiCommand;

class EmailCreate extends Base
{

    protected $command_name   = 'email/create';
    protected $command_method = 'post';
    protected $values = [];

    private $action_infos = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function create($entry)
    {
        $this->values = $entry;
    }
}
