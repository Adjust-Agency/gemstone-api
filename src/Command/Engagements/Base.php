<?php namespace Adjust\GemstoneApi\Command\Engagements;

use Adjust\GemstoneApi\Command\Base as BaseCommand;

abstract class Base extends BaseCommand
{
    protected $uri = '/api/htgf/v1/engagement';

    public function __construct()
    {
        parent::__construct();
    }
}
