# The Stringler

A simple class to manipulate strings in an OO way. Inspired by [Spatie's String](https://github.com/spatie/string). Just built this for fun. Hope you like it.

## Install
Via composer:
```bash
composer require thestringler/manipulator
```

Using Laravel? Checkout [The Stringler Laravel Package](https://github.com/mattsparks/the-stringler-laravel). 

## Methods
### append($string)
```php
Manipulator::make('Freak')->append(' Out!');
// Freak Out!
```

### camelToSnake
```php
Manipulator::make('camelCase')->camelToSnake();
// camel_case
```

### camelToClass
```php
Manipulator::make('className')->camelToClass();
// ClassName
```

### capitalize
```php
Manipulator::make('hello')->capitalize();
// Hello
```
### capitalizeEach
```php
Manipulator::make('i like toast!')->capitalizeEach();
// I Like Toast!
```

### eachCharacter($closure)
```php
Manipulator::make('hello')->eachCharacter(function($char) {
    return strtoupper($char);
});
// HELLO
```

### eachWord($closure, $preserveSpaces = false)
```php
Manipulator::make('hello moto')->eachWord(function($word) {
    return strrev($word);
});
// ollehotom

$string = Manipulator::make('hello moto')->eachWord(function($word) {
    return strrev($word);
}, true);
// olleh otom
```

### getPossessive
```php
Manipulator::make('Bob')->getPossessive();
// Bob's
Manipulator::make('Silas')->getPossessive();
// Silas'
```

### htmlEntities($flags = ENT_HTML5, $encoding = 'UTF-8', $doubleEncode = true)
```php
Manipulator::make('&')->htmlEntities();
// &amp;
```

### htmlEntitiesDecode($flags = ENT_HTML5, $encoding = 'UTF-8')
```php
Manipulator::make('&amp;')->htmlEntitiesDecode();
// &
```

### htmlSpecialCharacters($flags = ENT_HTML5, $encoding = 'UTF-8', $doubleEncode = true)
```php
Manipulator::make('&<>')->htmlSpecialCharacters();
// &amp;&lt;&gt;
```

### lowercaseFirst
```php
Manipulator::make('HELLO')->lowercaseFirst();
// hELLO
```

### make($string)
```php
// Named constructor
Manipulator::make('string');
```

### pad($length, $string, $type = null)
```php
Manipulator::make('Hello')->pad(2, '!!', STR_PAD_RIGHT);
// Hello!!
```

### prepend($string)
```php
Manipulator::make('is the one.')->prepend('Neo ');
// Neo is the one.
```

### pluralize($items = null)
```php
Manipulator::make('Potato')->pluralize();
// Potatoes
```

You can optionally pass an array or numeric value to `pluaralize` to determine if the given string should be pluaralized.

```php
$dogs = ['Zoe', 'Spot', 'Pickles'];
Manipulator::make('Dog')->pluralize($dogs);
// Dogs

$cats = ['Whiskers'];
Manipulator::make('Cat')->pluralize($cats);
// Cat
```

### remove($string, $caseSensitive = true)
```php
Manipulator::make('Dog Gone')->remove('Gone');
// Dog
```

### removeSpecialCharacters($exceptions = [])
```php
Manipulator::make('Hello!!')->removeSpecialCharacters();
// Hello
Manipulator::make('Hello!!')->removeSpecialCharacters(['!']);
// Hello!!
```

### repeat($multiplier = 1)
```php
Manipulator::make('la')->repeat(3);
// lalala
```

### replace($find, $replace = '', $caseSensitive = true)
```php
Manipulator::make('Pickles are good.')->replace('good', 'terrible');
// Pickles are terrible.
```

### reverse
```php
Manipulator::make('Whoa!')->reverse();
// !aohW
```

### snakeToCamel
```php
Manipulator::make('snake_case')->snakeToCamel();
// snakeCase
```

### snakeToClass
```php
Manipulator::make('class_name')->snakeToClass();
// ClassName
```

### stripTags($allowed = '')
```php
Manipulator::make('<i>Hello</i>')->stripTags();
// Hello
```

### toCamelCase
```php
Manipulator::make('camel case')->toCamelCase();
// camelCase
```

### toL33t
```php
Manipulator::make('Hack The Planet!')->toL33t();
// (-)@{|< +/-/€ |O7@|\|€][!
```

### toLower
```php
Manipulator::make('LOWER')->toLower();
// lower
```

### toSlug
```php
Manipulator::make('This is a slug!')->toSlug();
// this-is-a-slug
```

### toSnakeCase
```php
Manipulator::make('snake case')->toSnakeCase();
// snake_case
```

### toString
This method just returns the string.

### toUpper
```php
Manipulator::make('upper')->toUpper();
// UPPER
```

### trim
```php
Manipulator::make('  trimmed  ')->trim();
// trimmed
```

### trimBeginning
```php
Manipulator::make('  trimmed')->trimBeginning();
// trimmed
```

### trimEnd
```php
Manipulator::make('trimmed  ')->trimEnd();
// trimmed
```

### truncate($length = 100, $append = '...')
```php
Manipulator:make('This is a sentence and will be truncated.')->truncate(10, '...');
// This is a ...
```

### urlDecode
```php
Manipulator::make('hello%21')->urlDecode();
// hello!
```

### urlEncode
```php
Manipulator::make('hello!')->urlEncode();
// hello%21
```
## Chainable

All of these methods (minus `toString`) can be chained.

```php
Manipulator::make('hello')->toUpper()->reverse();
// OLLEH
```

## Contribute
Contributions are very welcome! 

1. Follow the [PSR-2 Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
2. Send a pull request.

That's pretty much it! 