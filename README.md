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
Manipulator::make('Out!')->append('Freak ');
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

All of these methods (minus `toString`) can be chained.

```php
Manipulator::make('hello')->toUpper()->reverse();
// OLLEH
```