<?php

namespace Pyjac\UrbanDictionary\Exception;

class UrbanWordDoesNotExistException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Word does not exist in the Urban Words Dictionary');
    }
}
