<?php namespace Adjust\GemstoneApi\Command\Automation;

use Adjust\GemstoneApi\Command\Base as BaseCommand;

abstract class Base extends BaseCommand
{
    protected $uri = '/api/htgf/v2/automation';

    public function __construct()
    {
        parent::__construct();
    }
}
