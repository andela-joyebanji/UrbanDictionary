<?php

use Pyjac\UrbanDictionary\UrbanDictionaryDataBank;

<<<<<<< HEAD
class UrbanDictionaryDataBankTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->dataBank = UrbanDictionaryDataBank::$data;
    }
=======
Class UrbanDictionaryDataBankTest extends PHPUnit_Framework_TestCase 
{
>>>>>>> develop

    public function testUrbanDictionaryDataBankIsNotEmpty()
    {
        $this->assertNotNull($this->dataBank);
    }

    public function testUrbanDictionaryDataBankContainsThreeSlangs()
    {
        $this->assertEquals(3, count($this->dataBank));
    }
}
