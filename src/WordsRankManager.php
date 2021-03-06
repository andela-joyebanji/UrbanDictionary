<?php

namespace Pyjac\UrbanDictionary;

use Pyjac\UrbanDictionary\Exception\WordDoesNotExistException;

define('CASE_SENSITIVE', 0);
define('CASE_INSENSITIVE', 1);

class WordsRankManager
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
    private $wordsRank;

    /**
     * Stores the mode of the WordsRankManager (Case Sensitive or Case Insensitive).
     *
     * @var array
     */
    private $mode;

    /**
     * Accepts sentence to preform words rank on.
     *
     * @param string
     */
    public function __construct($sentence, $caseSensitivityMode = CASE_SENSITIVE)
    {
        if (!is_string($sentence) || empty($sentence)) {
            throw new \InvalidArgumentException('Sentence must be a string and not empty.');
        }

        $this->mode = $caseSensitivityMode;
        $this->sentence = $sentence;
        $this->computeWordsRank();
    }

    /**
     * Compute rank of words in the instance sentence.
     *
     * @param void
     */
    private function computeWordsRank()
    {
        if ($this->getMode() == CASE_SENSITIVE) {
            $this->wordsRank =
                            array_count_values(
                                preg_replace('/[^A-Za-z0-9 ]/', '', explode(' ', $this->sentence))
                            );
        } else {
            //Reference: http://us3.php.net/manual/en/function.array-count-values.php#81799
            $this->wordsRank =
                            array_count_values(
                                preg_replace(
                                    '/[^A-Za-z0-9 ]/',
                                    '',
                                    array_map('strtolower', explode(' ', $this->sentence))
                                    )
                            );
        }
    }

    /**
     * Get the set sentence.
     *
     * @return string
     */
    public function getSentence()
    {
        return $this->sentence;
    }

    /**
     * Set the mode.
     *
     * @return void
     */
    public function setMode($caseSensitivityMode)
    {
        if (!($this->getMode() == $caseSensitivityMode)) {
            $this->mode = $caseSensitivityMode;
            $this->computeWordsRank();
        }
    }

    /**
     * Get the mode.
     *
     * @return int CASE_SENSITIVE = 0 and CASE_INSENSITIVE = 1
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Get Word Rank.
     *
     * @throws Pyjac\UrbanDictionary\Exception\WordDoesNotExistException
     * 
     * @return void
     */
    public function getWordRank($word)
    {
        if (!$this->wordExist($word)) {
            throw new WordDoesNotExistException();
        }

        return $this->wordsRank[$word];
    }

    /**
     * Get Words Rank.
     * 
     * @return array
     */
    public function getWordsRank()
    {
        return $this->wordsRank;
    }

    /**
     * Check If a Word Exist.
     * 
     * @return booleen
     */
    private function wordExist($word)
    {
        if ($this->getMode() == CASE_SENSITIVE) {
            return isset($this->wordsRank[$word]);
        } else {
            return isset($this->wordsRank[$word]) || isset($this->wordsRank[strtolower($word)]);
        }
    }
}
