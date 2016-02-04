<?php

use Pyjac\UrbanDictionary\UrbanWord;

class UrbanWordTest extends PHPUnit_Framework_TestCase {

	
	public function inputUrbanWords()
	{
		return [
			["Goobe","Used as a substitute for Trouble","I don't want any Goobo while doing my Cheakpoints ooo."],
			["Figo","Used as a substitute for 1000 naira","Can I get One Figo from you? I'd return it back went I come around." ]
		];
	}	
	

	public function testUrbanWordIsCreatedProperly()
	{
		$urbanword = new UrbanWord("Goobe","Used as a substitute for Trouble","I don't want any Goobo while doing my Cheakpoints ooo.");

		$this->assertEquals("Goobe", $urbanword->getSlang());
	}

	/**
	*
	*@dataProvider inputUrbanWords
	*/
	public function testUrbanWordCreation($slang, $description, $sampleSentence)
	{
		$urbanword = new UrbanWord($slang,$description,$sampleSentence);
		$this->assertEquals($slang, $urbanword->getSlang());
		$this->assertEquals($description, $urbanword->getDescription());
		$this->assertEquals($sampleSentence, $urbanword->getSampleSentence());
	}

	/**
	*
	*@dataProvider inputUrbanWords
	*/
	public function testUrbanWordConvertsToAnAssociativeArray($slang, $description, $sampleSentence)
	{
		$urbanword = new UrbanWord($slang,$description,$sampleSentence);
		$this->assertEquals(["slang" => $slang,"description" => $description, "sample‐sentence" => $sampleSentence], $urbanword->toArray());
	}

	/**
	*
	*@dataProvider inputUrbanWords
	*/
	public function testTwoUrbanWordsAreEqual($slang, $description, $sampleSentence)
	{	
		$urbanword1 = new UrbanWord($slang,$description,$sampleSentence);
		$urbanword2 = new UrbanWord($slang,$description,$sampleSentence);
		$this->assertTrue($urbanword1 == $urbanword2);
	}
}

