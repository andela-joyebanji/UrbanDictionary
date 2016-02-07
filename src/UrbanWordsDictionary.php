<?php

namespace Pyjac\UrbanDictionary;

use Pyjac\UrbanDictionary\Exception\UrbanWordAlreadyExistException;
use Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException;

class UrbanWordsDictionary
{
    /**
     * The number of words in the Dictionary.
     *
     * @var int
     */
    private $count;

    /**
     *  The words in the Dictionary.
     *
     * @var array
     */
    private $urbanWords;

    /**
     *  The keys of UrbanWords Array.
     *
     * @var array
     */
    private $urbanWordKeys = ['slang', 'description', 'sample‐sentence'];

    public function __construct($urbanWords = [])
    {
        $this->urbanWords = $urbanWords;
        $this->count = count($urbanWords);
    }

    /**
     * Adds a new word, including it description and simple sentence, into the Urban Words
     * Dictionary.
     *
     * @param string $word
     * @param array  $wordInfomation
     *
     * @throws Pyjac\UrbanDictionary\Exception\UrbanWordAlreadyExistException
     * 
     * @return true
     */
    private function add($word, $wordInfomation)
    {
        if ($this->urbanWordExist($word)) {
            throw new UrbanWordAlreadyExistException();
        }
        $this->urbanWords[$word] = $wordInfomation;
        $this->count++;

        return true;
    }

    /**
     * Checks if the passed $word exits in the Urban Dictionary.
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
     * Validate that the passed array has all UrbanWords Keys.
     *
     * @param array $array
     *
     * @return true|false
     */
    public function validateUrbanWordArrayKeys($array)
    {
        foreach ($this->urbanWordKeys as $key) {
            if (!array_key_exists($key, $array)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Adds a new word, including it description and simple sentence, into the Urban Words
     * Dictionary.
     *
     * @param string|array|UrbanWord $word
     * @param string                 $description
     * @param string                 $someSentence
     *
     * @throws Pyjac\UrbanDictionary\Exception\UrbanWordAlreadyExistException
     * @throws InvalidArgumentException
     *
     * @return true
     */
    public function addWord($word, $description = '', $someSentence = '')
    {
        //Check if an associative array is passed to the function
        if (is_array($word) && !empty($word) && count($word) == 3) {
            if (!$this->validateUrbanWordArrayKeys($word)) {
                throw new \InvalidArgumentException();
            }
            $this->add($word['slang'], $word);
        } elseif ($word instanceof UrbanWord) {
            $this->add($word->getSlang(), $word->toArray());
        } elseif ($this->validateUrbanWordDetailsAreNonEmptyStrings($word, $description, $someSentence)) {
            $this->add($word, (new UrbanWord($word, $description, $someSentence))->toArray());
        } else {
            throw new \InvalidArgumentException();
        }

        return true;
    }

    /**
     * Validates the details of a word as a non-empty string.
     *
     * @param mixed $word
     * @param mixed $description
     * @param mixed $someSentence
     *
     * @return true|false
     */
    private function validateUrbanWordDetailsAreNonEmptyStrings($word, $description, $someSentence)
    {
        return array_reduce([$word, $description, $someSentence], function($initial, $current)
        {
            $initial = $this->is_non_empty_string($current);
            return $initial;
        },false);
       
    }

    /**
     * Validates $val is a non empty string.
     *
     * @param mixed $val
     *
     * @return true|false
     */
    function is_non_empty_string($val)
    {
        return is_string($val) && $val !== '';
    }

    /**
     * Update the slang of the UrbanWord in the Dictionary.
     *
     * @param string $word
     * @param string $wordUpdate
     *
     * @throws InvalidArgumentException
     * @throws Pyjac\UrbanDictionary\Exception\UrbanWordAlreadyExistException
     *
     * @return string
     */
    private function updateWordSlang($word, $wordUpdate)
    {
        if(!empty($wordUpdate)) {
            $this->replaceWordSlang($word, $wordUpdate);
            //Once the slang as been replaced, subsequent modifications should be done on the new slang value 
            $word = $wordUpdate;
        } else {
            throw new \InvalidArgumentException("Can't Update word with an empty String");
        }

        return $word;
    }

    /**
     * Update the UrbanWord with an UrbanWord Object.
     *
     * @param string                          $word
     * @param Pyjac\UrbanDictionary\UrbanWord $wordUpdateObject
     *
     * @throws Pyjac\UrbanDictionary\Exception\UrbanWordAlreadyExistException
     *
     * @return string
     */
    private function updateWordObject($word, $wordUpdateObject)
    {
        if ($this->urbanWordExist($wordUpdateObject->getSlang())) {
            throw new UrbanWordAlreadyExistException();
        }
        if (strcasecmp($word, $wordUpdateObject->getSlang()) !== 0) {
            unset($this->urbanWords[$word]);
            $this->urbanWords[$wordUpdateObject->getSlang()] = $wordUpdateObject->toArray();
        }
        $this->urbanWords[$wordUpdateObject->getSlang()] = $wordUpdateObject->toArray();

        return  $wordUpdateObject->getSlang();
    }

    /**
     * Replaces a UrbanWord Slang.
     *
     * @param string $word
     * @param string  $slang
     *
     * @throws Pyjac\UrbanDictionary\Exception\UrbanWordAlreadyExistException
     * 
     * @return string 
     */
    private function replaceWordSlang($word, $slang)
    {
        if ($this->urbanWordExist($slang)) {
            throw new UrbanWordAlreadyExistException();
        }
        $this->urbanWords[$slang] = $this->urbanWords[$word];
        $this->urbanWords[$slang]["slang"] = $slang;
        unset($this->urbanWords[$word]);
    }

    /**
     * Update the UrbanWord with an Array.
     *
     * @param string $word
     * @param array  $wordUpdateArray
     *
     * @throws Pyjac\UrbanDictionary\Exception\UrbanWordAlreadyExistException
     * 
     * @return string
     */
    private function updateWordArray($word, $wordUpdateArray)
    {
        foreach ($wordUpdateArray as $key => $value) {
           if(in_array($key, $this->urbanWordKeys)){
                if(strcasecmp("slang", $key) == 0){
                    $this->replaceWordSlang($word, $value);
                    //Once the slang as been replaced, subsequent modifications should be done on the new slang value 
                    $word = $value;
                } else {
                    $this->urbanWords[$word][$key] = $value;
                }
            }
        }

        return $word;
    }

    /**
     * Update an existing word, including it description and simple sentence, in the Urban Words
     * Dictionary.
     *
     * @param string|array|Pyjac\UrbanDictionary\UrbanWord $wordUpdate
     *
     * @throws Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException
     * @throws InvalidArgumentException
     *
     * @return array
     */
    public function updateWord($word, $wordUpdate)
    {
        if (!$this->urbanWordExist($word)) {
            throw new UrbanWordDoesNotExistException();
        }
        //If a string is passed you're updating the slang itself
        if (is_string($wordUpdate)) {
            $word = $this->updateWordSlang($word, $wordUpdate);
        } elseif ($wordUpdate instanceof UrbanWord) {
            $word = $this->updateWordObject($word, $wordUpdate);
        } elseif (is_array($wordUpdate)) {
            $word = $this->updateWordArray($word, $wordUpdate);
        } else {
            throw new \InvalidArgumentException();
        }

        return $this->urbanWords[$word];
    }

    /**
     * Get the details of the Urban Word.
     *
     * @param string $word
     *
     * @throws Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException
     *
     * @return array
     */
    public function getWord($word)
    {
        if (!$this->urbanWordExist($word)) {
            throw new UrbanWordDoesNotExistException();
        }

        return $this->urbanWords[$word];
    }

    /**
     * Delete the Urban Word from the Urban Words Dictionary.
     *
     * @param string $word
     *
     * @throws Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException
     *
     * @return int Returns the current number of Words in the Dictionary
     */
    public function deleteWord($word)
    {
        if (!$this->urbanWordExist($word)) {
            throw new UrbanWordDoesNotExistException();
        }

        unset($this->urbanWords[$word]);

        return --$this->count;
    }

    /**
     * Get number of Words in Urban Words Dictionary.
     *
     * @throws Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException
     *
     * @return int Returns the current number of Words in the Dictionary
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Checks if Urban Words Dictionary is empty.
     *
     * @return true|false
     */
    public function isEmpty()
    {
        return $this->count == 0;
    }
}
