<?php

namespace Pyjac\UrbanDictionary;

use InvalidArgumentException;

class SentenceWordsRanker
{
    /**
     * Stores the sentence to be ranked.
     *
     * @var string
     */
    private $sentence;

    /**
     * Stores each word in the passed sentence and rank.
     *
     * @var array
     */
    private $sentenceWordsRank;

    /**
     * Accepts sentence to preform words rank on.
     *
     * @param string
     */
    public function __construct($sentence)
    {
        if (!is_string($sentence) || empty($sentence)) {
            throw new InvalidArgumentException('Sentence must be a string and not empty');
        }
        $this->sentence = $sentence;
        $this->computeSentenceWordsRank();
    }

    private function computeSentenceWordsRank()
    {
        $this->sentenceWordsRank = array_count_values(explode(' ', $this->sentence));
    }

    public function getSentence()
    {
        return $this->sentence;
    }

    public function getWordRank($word)
    {
        if (!$this->wordExist($word)) {
        }

        return $this->sentenceWordsRank[$word];
    }

    public function wordExist($word)
    {
        return isset($this->sentenceWordsRank[$word]);
    }
}
