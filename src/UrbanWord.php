<?php

namespace Pyjac\UrbanDictionary;

final class UrbanWord
{
    /**
     * The slang.
     *
     * @var string
     */
    private $slang;

    /**
     * The description of slang.
     *
     * @var string
     */
    private $description;

    /**
     * A sample sentence.
     *
     * @var string
     */
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
        $this->slang = (string)$slang;
        $this->description = (string)$description;
        $this->sampleSentence = (string)$sampleSentence;
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
     * Set the slang.
     *
     * @return void
     */
    public function setSlang($slang)
    {
        $this->slang = $slang;
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
     * Set the description of the UrbanWord.
     *
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * Set the sample sentence of the UrbanWord.
     *
     * @return void
     */
    public function setSampleSentence($sampleSentence)
    {
        $this->sampleSentence = $sampleSentence;
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
        return strcmp(get_class($object), 'Pyjac\UrbanDictionary\UrbanWord') == 0
           and strcmp($this->slang, $object->slang) == 0
           and strcmp($this->description, $object->description) == 0
           and strcmp($this->sampleSentence, $object->sampleSentence) == 0;
    }

    /**
     * Returns an associative array of properties of Urban Word.
     *
     * @return array
     */
    public function toArray()
    {
        $urbanWordsArray = get_object_vars($this);
        $urbanWordsArray['sample‐sentence'] = $urbanWordsArray['sampleSentence'];
        unset($urbanWordsArray['sampleSentence']);

        return $urbanWordsArray;
    }
}
