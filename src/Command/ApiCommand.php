<?php namespace Adjust\GemstoneApi\Command;

interface ApiCommand
{
    public function getCommandUrl();
    public function getCommandName();
    public function getCommandMethod();
    public function getCommandValues();
}