<?php 

namespace Pyjac\UrbanDictionary;

use Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException;
use Pyjac\UrbanDictionary\Exception\UrbanWordAlreadyExistException;

class UrbanWordsDictionary 
{
	private $count;
	private $urbanWords;

	public function __construct($urbanWords = [])
	{
		$this->urbanWords = $urbanWords;
		$this->count = count($urbanWords);
	}

	/**
	 * Adds a new word, including it description and simple sentence, into the Urban Words
	 * Dictionary
	 *
	 * @param string $word
	 * @param array $wordInfomation
	 * @return true
	 */

	private function add($word, $wordInfomation)
	{
		$this->urbanWords[$word] = $wordInfomation;
		$this->count++;
		return true;
	}
	/**
	 * Checks if the passed $word exits in the Urban Dictionary
	 *
	 * @param string $word
	 *
	 * @return true|false
	 */
	public function urbanWordExist($word)
	{
		return array_key_exists($word, $this->urbanWords);
	}

	/**
	 * Adds a new word, including it description and simple sentence, into the Urban Words
	 * Dictionary
	 *
	 * @param string|array|UrbanWord $word
	 * @param string $description
	 * @param string $someSentence
	 * @throws Pyjac\UrbanDictionary\Exception\UrbanWordAlreadyExistException
	 * @throws InvalidArgumentException
	 * @return true|false
	 */
	public function addWord($word, $description = "", $someSentence = "")
	{
		$wordInfomation = [];
		$urbanWord = "";
		//Check if an associative array is passed to the function
		if (is_array($word) && !empty($word) && count($word) == 3){
			$urbanWord = $word[0];
			$wordInfomation = $word;
		} elseif ($word instanceof UrbanWord){
			$urbanWord = $word->getSlang();
			$wordInfomation = $word->toArray();
		} elseif (!empty($word) && !empty($description)  && !empty($someSentence)){
			$urbanWord = $word;
			$wordInfomation = [$word, $description, $someSentence];
		} else {
			throw new \InvalidArgumentException;
		}

		if($this->urbanWordExist($urbanWord)){
			throw new UrbanWordAlreadyExistException;
		}

		return $this->add($urbanWord, $wordInfomation);
	}

	/**
	 * Update an existing word, including it description and simple sentence, in the Urban Words
	 * Dictionary
	 *
	 * @param string|array|UrbanWord $word
	 * @param string $description
	 * @param string $someSentence
	 * @throws Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException
	 * @throws InvalidArgumentException
	 * @return array
	 */
	public function updateWord($word, $description, $someSentence)
	{
		if (!$this->urbanWordExist($word)){
			throw new UrbanWordDoesNotExistException;
		}

		$this->urbanWords[$word] = [$word,$description,$someSentence];
		return $this->urbanWords[$word];
	}


	/**
	 * Get the details of the Urban Word.
	 *
	 * @param string $word
	 * @throws Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException
	 * @return array
	 */
	public function getWord($word)
	{
		if (!$this->urbanWordExist($word)){
			throw new UrbanWordDoesNotExistException;
		}
		return $this->urbanWords[$word];
	}

	/**
	 * Delete the Urban Word from the Urban Words Dictionary.
	 *
	 * @param string $word
	 * @throws Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException
	 * @return int Returns the current number of Words in the Dictionary
	 */
	public function deleteWord($word)
	{
		if (!$this->urbanWordExist($word)){
			throw new UrbanWordDoesNotExistException;
		}

		unset($this->urbanWords[$word]);
		return --$this->count;
	}

	/**
	 * Get number of Words in Urban Words Dictionary.
	 *
	 * @param string $word
	 * @throws Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException
	 * @return int Returns the current number of Words in the Dictionary
	 */
	public function getCount()
	{
		return $this->count;
	}

	/**
	 * Checks if Urban Words Dictionary is empty.
	 * @return true|false
	 */
	public function isEmpty()
	{
		return $this->count == 0;
	}
}