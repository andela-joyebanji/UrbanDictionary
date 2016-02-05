<?php
<<<<<<< HEAD

namespace Pyjac\UrbanDictionary\Exception;

use Exception;

class UrbanWordAlreadyExistException extends Exception
{
    public function __construct()
    {
        parent::__construct('Word already exist in the Urban Words Dictionary');
    }
=======

namespace Pyjac\UrbanDictionary\Exception;

class UrbanWordAlreadyExistException extends \Exception 
{
  public function __construct()
  {
    parent::__construct("Word already exist in the Urban Words Dictionary");
  }

>>>>>>> develop
}
