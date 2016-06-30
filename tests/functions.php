<?php
namespace TheStringler\Tests;

use TheStringler\Manipulator\Manipulator as Manipulator;

class Functions extends \PHPUnit_Framework_TestCase
{

    public function test_string_is_appended()
    {
        $string = Manipulator::make('Hello')->append(' Dolly');
        $this->assertEquals('Hello Dolly', $string);
    }

    public function test_camel_case_is_converted_to_snake_case()
    {
        $string = Manipulator::make('camelCase')->camelToSnake();
        $this->assertEquals('camel_case', $string);
    }

    public function test_string_is_capitalized()
    {
        $this->assertEquals('Hello', Manipulator::make('hello')->capitalize());
    }

    public function test_all_words_in_a_string_are_capitalized()
    {
        $string = Manipulator::make('hello dolly')->capitalizeEach();
        $this->assertEquals('Hello Dolly', $string);
    }

    public function test_first_letter_in_string_is_capitalized()
    {
        $string = Manipulator::make('Hello Dolly')->lowercaseFirst();
        $this->assertEquals('hello Dolly', $string);
    }

    public function test_string_is_prepended()
    {
        $string = Manipulator::make('Dolly')->prepend('Hello ');
        $this->assertEquals('Hello Dolly', $string);
    }

    public function test_passed_string_is_removed()
    {
        $this->assertEquals('Hell', Manipulator::make('Hello')->remove('o'));
    }

    public function test_character_is_replaced()
    {
        $string = Manipulator::make('Hello')->replace('H', 'J');
        $this->assertEquals('Jello', $string);
    }

    public function test_that_string_is_reversed()
    {
        $string = Manipulator::make('Hello')->reverse();
        $this->assertEquals('olleH', $string);
    }

    public function test_that_snake_case_string_is_converted_to_camel_case()
    {
        $string = Manipulator::make('snake_case')->snakeToCamel();
        $this->assertEquals('snakeCase', $string);
    }

    public function test_that_string_is_converted_to_camel_case()
    {
        $this->assertEquals('camelCase', Manipulator::make('Camel Case')->toCamelCase());
    }

    public function test_that_string_is_converted_to_lowercase()
    {
        $this->assertEquals('lower', Manipulator::make('LOWER')->toLower());
    }

    public function test_that_string_is_converted_to_snake_case()
    {
        $string = Manipulator::make('Snake Case')->toSnakeCase();
        $this->assertEquals('snake_case', $string);
    }

    public function test_that_a_string_is_returned()
    {
        $string = Manipulator::make('String')->toString();
        $this->assertTrue(is_string($string));
    }

    public function test_string_is_converted_to_uppercase()
    {
        $string = Manipulator::make('upper')->toUpper();
        $this->assertEquals('UPPER', $string);
    }

    public function test_string_is_trimmed()
    {
        $string = Manipulator::make('  trimmed  ')->trim();
        $this->assertEquals('trimmed', $string);
    }

    public function test_string_is_trimmed_at_beginning()
    {
        $string = Manipulator::make('  trimmed')->trimBeginning();
        $this->assertEquals('trimmed', $string);
    }

    public function test_string_is_trimmed_at_end()
    {
        $string = Manipulator::make('trimmed  ')->trimEnd();
        $this->assertEquals('trimmed', $string);
    }
}
