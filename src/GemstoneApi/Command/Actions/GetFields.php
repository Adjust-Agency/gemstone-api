<?php namespace Adjust\GemstoneApi\Command\Actions;

use Adjust\GemstoneApi\Command\ApiCommand;

class GetFields extends Base implements ApiCommand
{

    protected $command_name   = 'show-fields';
    protected $command_method = 'get';
    protected $values = array();


}