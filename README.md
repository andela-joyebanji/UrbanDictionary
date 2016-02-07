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