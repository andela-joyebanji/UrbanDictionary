<?php
<<<<<<< HEAD
=======

namespace Pyjac\UrbanDictionary;
>>>>>>> develop

namespace Pyjac\UrbanDictionary;

final class UrbanWord
{
    private $slang;
    private $description;
    private $sampleSentence;

    /**
     * Create a new Urban Word.
     *
     * @param string $slang
     * @param string $description
     * @param string $sampleSentence
     */
    public function __construct($slang, $description, $sampleSentence)
    {
        $this->slang = $slang;
        $this->description = $description;
        $this->sampleSentence = $sampleSentence;
    }

    /**
     * Get the slang.
     *
     * @return string
     */
    public function getSlang()
    {
        return $this->slang;
    }

    /**
     * Get the description of the UrbanWord.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the sample sentence of the UrbanWord.
     *
     * @return string
     */
    public function getSampleSentence()
    {
        return $this->sampleSentence;
    }

    /**
     * Check if the current Urban Word is thesame with the compared object.
     *
     * @param object $object
     *
     * @return bool true if the two UrbanWords are equal
     */
    public function equals($object)
    {
<<<<<<< HEAD
        return get_class($object) == 'UrbanWord'
           and strcmp($this->slang, $object->slang)
           and strcmp($this->description, $object->description)
           and strcmp($this->sampleSentence, $object->sampleSentence);
=======
        return strcmp(get_class($object), 'Pyjac\UrbanDictionary\UrbanWord') == 0
           and strcmp($this->slang, $object->slang) == 0
           and strcmp($this->description, $object->description) == 0
           and strcmp($this->sampleSentence, $object->sampleSentence) == 0;
>>>>>>> develop
    }

    /**
     * Returns an associative array of properties of Urban Word.
     *
     * @return array
     */
    public function toArray()
    {
<<<<<<< HEAD
        $urbanWordsArray = get_object_vars($this);
=======
        $urbanWordsArray = get_object_vars ($this);     
>>>>>>> develop
        $urbanWordsArray['sample‐sentence'] = $urbanWordsArray['sampleSentence'];
        unset($urbanWordsArray['sampleSentence']);

        return $urbanWordsArray;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> develop
