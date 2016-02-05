<?php

use Pyjac\UrbanDictionary\SentenceWordsRanker;

class SentenceWordsRankerTest extends PHPUnit_Framework_TestCase
{
    public function testSentenceWordsRankerCreation()
    {
        $sentence = 'Prosper has finished the curriculum and he will submit it to Nadayar.';
        $sentenceWordsRanker = new SentenceWordsRanker($sentence);

        $this->assertEquals($sentence, $sentenceWordsRanker->getSentence());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSentenceWordsRankerThrowsInvalidArgumentExceptionWhenEmptyStringIsPassed()
    {
        $sentenceWordsRanker = new SentenceWordsRanker('');
    }

    public function testSentenceWordsRankerReturnsCorrectWordsRank()
    {
        $sentence = 'Prosper has finished the curriculum and he will submit it to Nadayar. Tight Tight Tight !!!';
        $sentenceWordsRanker = new SentenceWordsRanker($sentence);

        $this->assertEquals(3, $sentenceWordsRanker->getWordRank('Tight'));
    }
}
