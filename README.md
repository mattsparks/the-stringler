# The Stringler

A simple class to manipulate strings in an OO way. Inspired by [Spatie's String](https://github.com/spatie/string). Just built this for fun. Hope you like it.

## Install
Via composer:
```bash
composer require thestringler/manipulator
```

## Methods
### append
```php
Manipulator::make('Freak')->append(' Out!');
// Freak Out!
```

### camelToSnake
```php
Manipulator::make('camelCase')->camelToSnake();
// camel_case
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

### htmlEntities
```php
Manipulator::make('&')->htmlEntitiesDecode();
// &amp;
```

### htmlEntitiesDecode
```php
Manipulator::make('&amp;')->htmlEntitiesDecode();
// &
```

### htmlSpecialCharacters
```php
Manipulator::make('&<>')->htmlSpecialCharacters();
// &amp;&lt;&gt;
```

### lowercaseFirst
```php
Manipulator::make('HELLO')->lowercaseFirst();
// hELLO
```

### make
```php
// Named constructor
Manipulator::make('string');
```

### prepend
```php
Manipulator::make('is the one.')->prepend('Neo ');
// Neo is the one.
```

### remove
```php
Manipulator::make('Dog Gone')->remove('Gone');
// Dog
```

### removeSpecialCharacters
```php
Manipulator::make('Hello!!')->removeSpecialCharacters();
// Hello
```

### repeat
```php
Manipulator::make('la')->repeat(3);
// lalala
```

### replace
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

### toCamelCase
```php
Manipulator::make('camel case')->toCamelCase();
// camelCase
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

### truncate
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
Manipulator::make('hello!')->urlDecode();
// hello%21
```
## Chainable

All of these methods (minus `toString`) can be chained.

```php
Manipulator::make('hello')->toUpper()->reverse();
// OLLEH
```