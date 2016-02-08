[![Build Status](https://travis-ci.org/andela-joyebanji/UrbanDictionary.svg?branch=develop)](https://travis-ci.org/andela-joyebanji/UrbanDictionary) 
[![Coverage Status](https://coveralls.io/repos/github/andela-joyebanji/UrbanDictionary/badge.svg?branch=develop)](https://coveralls.io/github/andela-joyebanji/UrbanDictionary?branch=develop)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/andela-joyebanji/UrbanDictionary/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/andela-joyebanji/UrbanDictionary/?branch=develop)


###  Urban Dictionary Agnostic PHP Package

A php package for managing Urban Words and ranking of words in a sentence.
This Package uses PSR-4 Autoload Standard.

## Install

Via Composer

``` bash
$ composer require Pyjac/UrbanDictionary
```

## Usage

###UrbanWord

A class used to store Detials of an Urban Word.
```php
    $urbanWord = new Pyjac\UrbanDictionary\UrbanWord("Twale","An exclamation that is used to show respect to another person", "Twale!!! The Chairman");

	$urbanWord->getSlang(); // "Twale"
	$urbanWord->getDescription(); // "An exclamation that is used to show respect to another person"
	$urbanWord->getSampleSentence(); // "Twale!!! The Chairman"
	$urbanWord->toArray(); 
	// [
	//	'slang'           => "Twale",
	//	'description'     => "An exclamation that is used to show respect to another person.",
	//	'sample-sentence' => "Twale!!! The Chairman."
	//	]
```

###UrbanDictionaryDataBank
A class that contains a static array of test Urban words.
```php
	print_r(Pyjac\UrbanDictionary\UrbanDictionaryDataBank::$data);
```
###UrbanWordsDictionary
A class used to store and manage urban words.
```php
	use Pyjac\UrbanDictionary\UrbanWordsDictionary;
	use Pyjac\UrbanDictionary\UrbanWord;

	$urbanWordsDictionary = new UrbanWordsDictionary();
```

#####Adding a new Urban Word
```php
	//Using UrbanWord Object
    $urbanDictionary->addUrbanWordObject(new UrbanWord("Twale", "An exclamation that is used to show respect to another person", "Twale!!! The Chairman."));

    //Using UrbanWord Array
    $urbanWordArray = ['slang' => "Twale", 'description' => "An exclamation that is used to show respect to another person", 'sample‐sentence' => "Twale!!! The Chairman."];
    $urbanWordsDictionary->addUrbanWordArray($urbanWordArray);

    //Using Strings
    $urbanWordsDictionary->addWord("Twale","An exclamation that is used to show respect to another person","Twale!!! The Chairman.");

```
#####Getting Urban Word
```php
	//Returns an associative array of the Urban Word
	$urbanWordsDictionary->getWord("Twale");
```
#####Deleting Urban Word
```php
	$urbanWordsDictionary->deleteWord(Twale");
```

#####Updating Urban Word
```php
	//Using UrbanWord Object
	$urbanWordsDictionary->updateWordObject('Twale', new UrbanWord("Twale", "Used to show respect to another person", "Twale!!! Mr Chairman sir."));

	//Using UpdateWord Array
	$urbanWordsDictionary->updateWordArray('Twale', ["description" => "Used to show respect to another person", 'sample‐sentence' => "Twale!!! Mr Chairman sir."]);

	//Changing/Replacing the Slang
	 $urbanWordsDictionary->updateWord("Twale", "Twa");
```

###WordsRankManager
A class used to rank words in a string or sentence.
It allows perform CASE_INSENSITIVE and CASE_SENSITIVE rank of words in a sentence.

```php
	use Pyjac\UrbanDictionary\WordsRankManager;

	$sentence = 'Prosper has finished the curriculum and he will submit it to Nadayar. Tight Tight Tight';
	//CASE_SENSITIVE by default
    $wordsRankManager = new WordsRankManager($sentence);
    $wordsRankManager->getWordRank('Tight'); // 3

    // Throws Pyjac\UrbanDictionary\Exception\WordDoesNotExistException
    $wordsRankManager->getWordRank('tight');  

    $wordsRankManager->setMode(CASE_INSENSITIVE);
    $wordsRankManager->getWordRank('tight'); // 3

    $wordsRankManager = new WordsRankManager($sentence);

    print_r($wordsRankManager->getWordsRank());
    // ['Prosper'    => 1, 'has' => 1, 'finished' => 1, 'the'     => 1, 
    //  'curriculum' => 1, 'and' => 1, 'he'       => 1, 'will'    => 1, 
    //  'submit'     => 1, 'it'  => 1, 'to'       => 1, 'Nadayar' => 1, 
    //  'Tight'      => 3]

```

## Security

If you discover any security related issues, please email [Oyebanji Jacob](oyebanji.jacob@andela.com) or create an issue.

## Credits

[Oyebanji Jacob](https://github.com/andela-joyebanji)

## License

### The MIT License (MIT)

Copyright (c) 2016 Oyebanji Jacob <oyebanji.jacob@andela.com>

> Permission is hereby granted, free of charge, to any person obtaining a copy
> of this software and associated documentation files (the "Software"), to deal
> in the Software without restriction, including without limitation the rights
> to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
> copies of the Software, and to permit persons to whom the Software is
> furnished to do so, subject to the following conditions:
>
> The above copyright notice and this permission notice shall be included in
> all copies or substantial portions of the Software.
>
> THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
> IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
> FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
> AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
> LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
> OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
> THE SOFTWARE.