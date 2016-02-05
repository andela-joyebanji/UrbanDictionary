<?php

use Pyjac\UrbanDictionary\UrbanDictionaryDataBank;
<<<<<<< HEAD
use Pyjac\UrbanDictionary\UrbanWord;
use Pyjac\UrbanDictionary\UrbanWordsDictionary;
=======
use Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException;

class UrbanWordsDictionaryTest extends PHPUnit_Framework_TestCase 
{

	public function inputUrbanWordsArray()
	{

		return UrbanDictionaryDataBank::$data;
	}	

	public function testUrbanWordsDictionaryIsEmptyWhenNewlyCreated()
	{

		$urbanWordsDictionary = new UrbanWordsDictionary();
		$this->assertTrue($urbanWordsDictionary->isEmpty());
	}


	public function testUrbanWordsDictionaryIsNotEmptyWhenNewUrbanWordsAreAdded()
	{

		$urbanWordsDictionary = new UrbanWordsDictionary();
		$urbanWordsDictionary->addWord(new UrbanWord("Goobe","Used as a substitute for Trouble","I don't want any Goobo while doing my Cheakpoints ooo."));
		$this->assertFalse($urbanWordsDictionary->isEmpty());
	}

	/**
	*
	* @dataProvider inputUrbanWordsArray
	*/
	public function testAddNewUrbanWordFromArgument($slang, $description, $sampleSentence)
	{
		
		$urbanWordsDictionary = new UrbanWordsDictionary();
		$urbanWordsDictionary->addWord($slang, $description, $sampleSentence);

		$this->assertFalse($urbanWordsDictionary->isEmpty());
		$this->assertEquals([$slang, $description, $sampleSentence], $urbanWordsDictionary->getWord($slang));
	}

	/**
	*
	* @dataProvider inputUrbanWordsArray
	*/
	public function testAddNewUrbanWordFromAnArray($slang, $description, $sampleSentence)
	{
		
		$testArray = [$slang, $description, $sampleSentence];
		$urbanWordsDictionary = new UrbanWordsDictionary();
		$urbanWordsDictionary->addWord($testArray);

		$this->assertFalse($urbanWordsDictionary->isEmpty());
		$this->assertEquals($testArray, $urbanWordsDictionary->getWord($slang));
	}

	public function testUrbanWordDeletedFromUrbanWordsDictionary()
	{
		
		$urbanWordsDictionary = new UrbanWordsDictionary();
		foreach (UrbanDictionaryDataBank::$data as $key => $value) {
			$urbanWordsDictionary->addWord($value["slang"], $value["description"], $value["sample‐sentence"]);
		}
		$beforeDeleteCount = $urbanWordsDictionary->getCount();
		$urbanWordsDictionary->deleteWord("Goobe");
		$this->assertEquals($beforeDeleteCount - 1, $urbanWordsDictionary->getCount());
	}
>>>>>>> develop

class UrbanWordsDictionaryTest extends PHPUnit_Framework_TestCase
{
    public function inputUrbanWordsArray()
    {
        return UrbanDictionaryDataBank::$data;
    }

    public function testUrbanWordsDictionaryIsEmptyWhenNewlyCreated()
    {
        $urbanWordsDictionary = new UrbanWordsDictionary();
        $this->assertTrue($urbanWordsDictionary->isEmpty());
    }

    public function testUrbanWordsDictionaryIsNotEmptyWhenNewUrbanWordsAreAdded()
    {
        $urbanWordsDictionary = new UrbanWordsDictionary();
        $urbanWordsDictionary->addWord(new UrbanWord('Goobe', 'Used as a substitute for Trouble', "I don't want any Goobo while doing my Cheakpoints ooo."));
        $this->assertFalse($urbanWordsDictionary->isEmpty());
    }

    /**
     *@dataProvider inputUrbanWordsArray
     */
    public function testAddNewUrbanWordFromAnArray($slang, $description, $sampleSentence)
    {
        $urbanWordsDictionary = new UrbanWordsDictionary();
        $urbanWordsDictionary->addWord($slang, $description, $sampleSentence);

        $this->assertFalse($urbanWordsDictionary->isEmpty());
        $this->assertEquals([$slang, $description, $sampleSentence], $urbanWordsDictionary->getWord($slang));
    }

    public function testUrbanWordDeletedFromUrbanWordsDictionary()
    {
        $urbanWordsDictionary = new UrbanWordsDictionary();
        foreach (UrbanDictionaryDataBank::$data as $key => $value) {
            $urbanWordsDictionary->addWord($value['slang'], $value['description'], $value['sample‐sentence']);
        }
        $beforeDeleteCount = $urbanWordsDictionary->getCount();
        $urbanWordsDictionary->deleteWord('Goobe');
        $this->assertEquals($beforeDeleteCount - 1, $urbanWordsDictionary->getCount());
    }

    /**
     * @expectedException Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException
     */
<<<<<<< HEAD
    public function testUrbanWordDictionaryThrowsUrbanWordDoesNotExistExceptionForNonExistantWord()
    {
        $urbanWordsDictionary = new UrbanWordsDictionary();
        $urbanWordsDictionary->getWord('Goobe');
    }

    /**
     *  @dataProvider inputUrbanWordsArray
     * @expectedException Pyjac\UrbanDictionary\Exception\UrbanWordAlreadyExistException
     */
    public function testUrbanWordDictionaryThrowsUrbanWordAlreadyExistExceptionWhileAddingAlreadyExistingWordViaArgument($slang, $description, $sampleSentence)
    {
        $urbanWordsDictionary = new UrbanWordsDictionary();

        $urbanWordsDictionary->addWord($slang, $description, $sampleSentence);
        //Duplicate
        $urbanWordsDictionary->addWord($slang, $description, $sampleSentence);
    }

    /**
     * @dataProvider inputUrbanWordsArray
     * @expectedException Pyjac\UrbanDictionary\Exception\UrbanWordAlreadyExistException
     */
    public function testUrbanWordDictionaryThrowsUrbanWordAlreadyExistExceptionWhileAddingAlreadyExistingWordViaUrbanWordObject($slang, $description, $sampleSentence)
    {
        $urbanWordsDictionary = new UrbanWordsDictionary();

        $urbanWordsDictionary->addWord(new UrbanWord('Goobe', 'Used as a substitute for Trouble', "I don't want any Goobo while doing my Cheakpoints ooo."));
        //Duplicate
        $urbanWordsDictionary->addWord(new UrbanWord('Goobe', 'Used as a substitute for Trouble', "I don't want any Goobo while doing my Cheakpoints ooo."));
    }
=======
	public function testUrbanWordDictionaryThrowsUrbanWordDoesNotExistExceptionForNonExistantWord()
	{

		$urbanWordsDictionary = new UrbanWordsDictionary();
		$urbanWordsDictionary->getWord("Goobe");
	}

	/**
	 * @dataProvider inputUrbanWordsArray 
     * @expectedException InvalidArgumentException
     */
	public function testUrbanWordDictionaryAddWordThrowsInvalidArgumentExceptionWhenOnlyOneStringIsPassed($slang, $description, $sampleSentence)
	{

		$urbanWordsDictionary = new UrbanWordsDictionary();
		$urbanWordsDictionary->addWord($slang);

	}

	/**
	 * @dataProvider inputUrbanWordsArray 
     * @expectedException InvalidArgumentException
     */
	public function testUrbanWordDictionaryAddWordThrowsInvalidArgumentExceptionWhenOnlyTwoStringsArePassed($slang, $description, $sampleSentence)
	{

		$urbanWordsDictionary = new UrbanWordsDictionary();
		$urbanWordsDictionary->addWord($slang,$description);

	}

	/**
	 * @dataProvider inputUrbanWordsArray 
     * @expectedException InvalidArgumentException
     */
	public function testUrbanWordDictionaryAddWordThrowsInvalidArgumentExceptionWhenArrayOfOneElementIsPassed($slang, $description, $sampleSentence)
	{

		$urbanWordsDictionary = new UrbanWordsDictionary();
		$urbanWordsDictionary->addWord([$slang]);

	}

	/**
	 * @dataProvider inputUrbanWordsArray 
     * @expectedException InvalidArgumentException
     */
	public function testUrbanWordDictionaryAddWordThrowsInvalidArgumentExceptionWhenArrayOfTwoElementIsPassed($slang, $description, $sampleSentence)
	{

		$urbanWordsDictionary = new UrbanWordsDictionary();
		$urbanWordsDictionary->addWord([$slang,$description]);

	}

	/**
	 * @dataProvider inputUrbanWordsArray 
     * @expectedException InvalidArgumentException
     */
	public function testUrbanWordDictionaryAddWordThrowsInvalidArgumentExceptionWhenArrayOfMoreThanThreeElementIsIsPassed($slang, $description, $sampleSentence)
	{

		$urbanWordsDictionary = new UrbanWordsDictionary();
		$urbanWordsDictionary->addWord([$slang,$description]);

	}

	/**
	* @dataProvider inputUrbanWordsArray
    * @expectedException Pyjac\UrbanDictionary\Exception\UrbanWordAlreadyExistException
    */
	public function testUrbanWordDictionaryThrowsUrbanWordAlreadyExistExceptionWhileAddingAlreadyExistingWordViaArgument($slang, $description, $sampleSentence)
	{

		$urbanWordsDictionary = new UrbanWordsDictionary();

		$urbanWordsDictionary->addWord($slang, $description, $sampleSentence);
		//Duplicate
		$urbanWordsDictionary->addWord($slang, $description, $sampleSentence);

	}

	/**
	* @dataProvider inputUrbanWordsArray
    * @expectedException Pyjac\UrbanDictionary\Exception\UrbanWordAlreadyExistException
    */
	public function testUrbanWordDictionaryThrowsUrbanWordAlreadyExistExceptionWhileAddingAlreadyExistingWordViaUrbanWordObject($slang, $description, $sampleSentence)
	{

		$urbanWordsDictionary = new UrbanWordsDictionary();

		$urbanWordsDictionary->addWord(new UrbanWord("Goobe","Used as a substitute for Trouble","I don't want any Goobo while doing my Cheakpoints ooo."));
		//Duplicate
		$urbanWordsDictionary->addWord(new UrbanWord("Goobe","Used as a substitute for Trouble","I don't want any Goobo while doing my Cheakpoints ooo."));
		
	}

	
	public function testUrbanWordDictionaryUpdateWord()
	{

		$urbanWordsDictionary = new UrbanWordsDictionary();

		$urbanWordsDictionary->addWord(new UrbanWord("Goobe","Used as a substitute for Trouble","I don't want any Goobo while doing my Cheakpoints ooo."));
		$urbanWordsDictionary->updateWord("Goobe","Means Trouble","I don't want any Goobo while doing my Cheakpoints ooo.");
		
		$this->assertEquals(["Goobe","Means Trouble","I don't want any Goobo while doing my Cheakpoints ooo."],$urbanWordsDictionary->getWord("Goobe"));
		
	}
	/**
	* @dataProvider inputUrbanWordsArray
    * @expectedException Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException
    */
	public function testUrbanWordDictionaryThrowsUrbanWordDoesNotExistExceptionWhenWordToUpdateDoesNotExist()
	{
>>>>>>> develop

    public function testUrbanWordDictionaryUpdateWord()
    {
        $urbanWordsDictionary = new UrbanWordsDictionary();

        $urbanWordsDictionary->addWord(new UrbanWord('Goobe', 'Used as a substitute for Trouble', "I don't want any Goobo while doing my Cheakpoints ooo."));
        $urbanWordsDictionary->updateWord('Goobe', 'Means Trouble', "I don't want any Goobo while doing my Cheakpoints ooo.");

        $this->assertEquals(['Goobe', 'Means Trouble', "I don't want any Goobo while doing my Cheakpoints ooo."], $urbanWordsDictionary->getWord('Goobe'));
    }

    /**
     * @dataProvider inputUrbanWordsArray
     * @expectedException Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException
     */
    public function testUrbanWordDictionaryThrowsUrbanWordDoesNotExistExceptionWhenWordToUpdateDoesNotExist()
    {
        $urbanWordsDictionary = new UrbanWordsDictionary();

        $urbanWordsDictionary->addWord(new UrbanWord('Goobe', 'Used as a substitute for Trouble', "I don't want any Goobo while doing my Cheakpoints ooo."));
        $urbanWordsDictionary->updateWord('Goob', 'Means Trouble', "I don't want any Goobo while doing my Cheakpoints ooo.");
    }
}
