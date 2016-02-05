<?php

namespace Pyjac\UrbanDictionary;

use Pyjac\UrbanDictionary\Exception\WordDoesNotExistException;

class WordsRankManager 
{
	/**
	*
	* Stores the sentence to be ranked.
	*
	* @var string
	*/
	private $sentence;

	/**
	*
	* Stores each word in the passed sentence and rank.
	*
	* @var array
	*/
	private $wordsRank;

	/**
	*
	* Accepts sentence to preform words rank on.
	*
	* @param string
	*/
	public function __construct($sentence)
	{
		if(!is_string($sentence) || empty($sentence)){
			throw new \InvalidArgumentException("Sentence must be a string and not empty.");		
		}

		$this->sentence = $sentence;
		$this->computeWordsRank();	
	}

	private function computeWordsRank()
	{
		$this->wordsRank = array_count_values(explode(" ", $this->sentence));
	}

	public function getSentence()
	{
		return $this->sentence;
	}

	public function getWordRank($word)
	{
		if (!$this->wordExist($word)) {
			throw new WordDoesNotExistException;
		}

		return $this->wordsRank[$word];
	}

	public function wordExist($word)
	{
		return isset($this->wordsRank[$word]);
	}
}