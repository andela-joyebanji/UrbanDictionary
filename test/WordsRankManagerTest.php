<?php

use Pyjac\UrbanDictionary\WordsRankManager;

class WordsRankManagerTest extends PHPUnit_Framework_TestCase
{
	protected $sentence;
	protected $wordsRankManager;
	public function setUp()
	{
		$this->sentence = 'Prosper has finished the curriculum and he will submit it to Nadayar. Tight Tight Tight !!!';
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

}
