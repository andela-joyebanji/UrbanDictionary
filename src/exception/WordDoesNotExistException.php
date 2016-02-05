<?php

namespace Pyjac\UrbanDictionary\Exception;

class WordDoesNotExistException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Word does not exist in the sentence.');
    }
}
