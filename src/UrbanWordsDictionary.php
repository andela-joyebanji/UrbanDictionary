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
    private $urbanWordKeys = ["slang","description","sample-sentence"];

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
     * @return true
     */
    private function add($word, $wordInfomation)
    {
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
            if(!array_key_exists($key, $array)){
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
     * @return true|false
     */
    public function addWord($word, $description = '', $someSentence = '')
    {
        
        //Check if an associative array is passed to the function
        if (is_array($word) && !empty($word) && count($word) == 3) {
            if(!$this->validateUrbanWordArrayKeys($word)){
                throw new \InvalidArgumentException();
            }
            $urbanWord = $word["slang"];
            $wordInfomation = $word;
        } elseif ($word instanceof UrbanWord) {
            $urbanWord = $word->getSlang();
            $wordInfomation = $word->toArray();
        } elseif (!empty($word) && !empty($description)  && !empty($someSentence)) {
            $urbanWord = $word;
            $wordInfomation = (new UrbanWord($word, $description, $someSentence))->toArray();
        } else {
            throw new \InvalidArgumentException();
        }

        if ($this->urbanWordExist($urbanWord)) {
            throw new UrbanWordAlreadyExistException();
        }

        return $this->add($urbanWord, $wordInfomation);
    }

    /**
     * Update the slang of the UrbanWord in the Dictionary.
     *
     * @param string $word
     * @param string $wordUpdate
     *
     * @throws InvalidArgumentException
     *
     * @return string 
     */
    private function updateWordSlang($word, $wordUpdate)
    {
        if(!empty($wordUpdate)) {
            if ($this->urbanWordExist($wordUpdate)) {
                throw new UrbanWordAlreadyExistException();
            }
            $this->urbanWords[$wordUpdate] = $this->urbanWords[$word];
            $this->urbanWords[$wordUpdate]["slang"] = $wordUpdate;
            unset($this->urbanWords[$word]);
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
     * @param string $word
     * @param string $wordUpdateObject
     *
     * @throws Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException
     *
     * @return string 
     */
    private function updateWordObject($word, $wordUpdateObject)
    {
        if ($this->urbanWordExist($wordUpdateObject->getSlang())) {
            throw new UrbanWordDoesNotExistException();
        }
        if(strcasecmp($word, $wordUpdateObject->getSlang()) !== 0){
            unset($urbanWordsArray[$word]);
            $this->urbanWords[$wordUpdateObject->getSlang()] = $wordUpdateObject->toArray();
        }
        $this->urbanWords[$wordUpdateObject->getSlang()] = $wordUpdateObject->toArray(); 

        return  $wordUpdateObject->getSlang();
    }

    /**
     * Update the UrbanWord with an Array.
     *
     * @param string $word
     * @param string $wordUpdateObject
     *
     * @throws Pyjac\UrbanDictionary\Exception\UrbanWordDoesNotExistException
     *
     * @return string 
     */
    private function updateWordArray($word, $wordUpdateArray)
    {
        foreach ($wordUpdate as $key => $value) {
           if(array_key_exists($key, $this->urbanWords)){
                if(strcasecmp("slang", $key) == 0){
                    //Replace Urban Word if the new object passed as a different slang
                    if(strcasecmp($word, $value) !== 0){
                        $this->urbanWords[$value] = $this->urbanWords[$wordUpdate];
                        unset($this->urbanWords[$word]);
                        //Once the slang as been replaced, subsequent modifications should be done on the new slang value 
                        $word = $value;
                    }else {
                        $this->urbanWords[$word][$key] = $value;
                    }

                }
            } 
        }
        return $word;
    }

    /**
     * Update an existing word, including it description and simple sentence, in the Urban Words
     * Dictionary.
     *
     * @param string|array|UrbanWord $wordUpdate
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
        if(is_string($wordUpdate)){
            $word = $this->updateWordSlang($word, $wordUpdate);
        } elseif ($wordUpdate instanceof UrbanWord) {
            $word = $this->updateWordObject($word, $wordUpdate);
        } elseif (is_array($wordUpdate)) {
            $word = $this->updateWordArray($word, $wordUpdate);  
        } else {
            throw new \InvalidArgumentException; 
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
     * @param string $word
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
