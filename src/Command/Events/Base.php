<?php namespace Adjust\GemstoneApi\Command\Events;

use Adjust\GemstoneApi\Command\Base as BaseCommand;

abstract class Base extends BaseCommand
{
    protected $uri = '/api/htgf/v1/event';

    public function __construct()
    {
        parent::__construct();
    }
}
