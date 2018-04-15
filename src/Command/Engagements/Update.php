<?php namespace Adjust\GemstoneApi\Command\Engagements;

use Adjust\GemstoneApi\Command\ApiCommand;

class Update extends Base
{

    protected $command_name   = 'update';
    protected $command_method = 'post';
    protected $values = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function insert($entry)
    {
        $this->values = $entry;
    }
}