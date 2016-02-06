<?php

use Pyjac\UrbanDictionary\WordsRankManager;

class WordsRankManagerTest extends PHPUnit_Framework_TestCase
{
	protected $sentence;
	protected $wordsRankManager;
	public function setUp()
	{
		$this->sentence = "Prosper has finished the curriculum and he will submit it to Nadayar. Tight Tight Tight";
		$this->wordsRankManager = new WordsRankManager($this->sentence);
	}

    public function testWordsRankManagerCreation()
    {
        $sentence = 'Prosper has finished the curriculum and he will submit it to Nadayar.';
        $wordsRankManager = new WordsRankManager($sentence);
        $this->assertEquals($sentence, $wordsRankManager->getSentence());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWordsRankManagerThrowsInvalidArgumentExceptionWhenEmptyStringIsPassed()
    {
        $wordsRankManager = new WordsRankManager('');
    }

    public function testWordsRankManagerReturnsCorrectWordsRank()
    {
        $this->assertEquals(3, $this->wordsRankManager->getWordRank('Tight'));
    }

    public function testWordsRankManagerReturnsCorrectWordsRankForCaseInsensitiveRank()
    {
        $wordsRankManager = new WordsRankManager($this->sentence, CASE_INSENSITIVE);
        $this->assertEquals(3, $wordsRankManager->getWordRank('tight'));
    }

    public function testWordsRankManagerReturnsCorrectWordsRankWhenModeIsSwitched()
    {
    	$sentence = 'Prosper has finished the curriculum and he will submit it to Nadayar. Tight tight Tight !!!';
        $wordsRankManager = new WordsRankManager($sentence, CASE_SENSITIVE);
        $this->assertEquals(1, $wordsRankManager->getWordRank('tight'));
        $wordsRankManager->setMode(CASE_INSENSITIVE);
        $this->assertEquals(3, $wordsRankManager->getWordRank('tight'));
    }

    /**
     * @expectedException Pyjac\UrbanDictionary\Exception\WordDoesNotExistException
     */
    public function testWordsRankManagerThrowsWordDoesNotExistExceptionWhileGettingWordNotInSentence()
    {
        $wordsRankManager = new WordsRankManager($this->sentence, CASE_INSENSITIVE);
        $wordsRankManager->getWordRank('love');
    }

    public function testWordsRankManagerGetCorrectWordsRank()
    {
        $wordsRankManager = new WordsRankManager($this->sentence);
        //die(var_dump($wordsRankManager->getWordsRank()));
        $this->assertTrue(
            ["Prosper" => 1, "has" => 1,"finished" => 1, 
             "the"     => 1, "curriculum" => 1, "and" => 1, "he"   => 1, "will" => 1, "submit"  => 1, 
             "it"      => 1, "to"         => 1, "Nadayar" => 1, "Tight" => 3] == $wordsRankManager->getWordsRank());
    }

}
