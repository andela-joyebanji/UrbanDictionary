<?php

use Pyjac\UrbanDictionary\WordsRankManager;

class WordsRankManagerTest extends PHPUnit_Framework_TestCase
{
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
        $sentence = 'Prosper has finished the curriculum and he will submit it to Nadayar. Tight Tight Tight !!!';
        $wordsRankManager = new WordsRankManager($sentence);
        $this->assertEquals(3, $wordsRankManager->getWordRank('Tight'));
    }

    public function testWordsRankManagerReturnsCorrectWordsRankForCaseInsensitiveRank()
    {
        $sentence = 'Prosper has finished the curriculum and he will submit it to Nadayar. Tight Tight Tight !!!';
        $wordsRankManager = new WordsRankManager($sentence, CASE_INSENSITIVE);
        $this->assertEquals(3, $wordsRankManager->getWordRank('tight'));
    }
}
