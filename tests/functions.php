<?php
namespace TheStringler\Tests;

use TheStringler\Manipulator\Manipulator as Manipulator;

class Functions extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException TheStringler\Manipulator\Exceptions\CreatingStringException
     */
    public function test_that_an_exception_is_thrown_when_creating_the_object()
    {
        Manipulator::make(['not', 'a', 'string']);
    }

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

    public function test_that_character_is_replaced_when_case_sensitive_is_false()
    {
        $string = Manipulator::make('Removed Hello removed')->replace('removed', 'Hello', false);
        $this->assertEquals('Hello Hello Hello', $string);
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

    public function test_string_is_url_encoded()
    {
        $string = Manipulator::make('hello!')->urlEncode();
        $this->assertEquals('hello%21', $string);
    }

    public function test_url_string_is_decoded()
    {
        $string = Manipulator::make('hello%21')->urlDecode();
        $this->assertEquals('hello!', $string);
    }

    public function test_that_html_is_converted_to_their_entities()
    {
        $string = Manipulator::make('&')->htmlEntities();
        $this->assertEquals('&amp;', $string);
    }

    public function test_that_html_entities_are_converted_back()
    {
        $string = Manipulator::make('&amp;')->htmlEntitiesDecode();
        $this->assertEquals('&', $string);
    }

    public function test_that_string_is_converted_to_html_special_characters()
    {
        $string = Manipulator::make('&<>')->htmlSpecialCharacters();
        $this->assertEquals($string, '&amp;&lt;&gt;');
    }

    public function test_string_is_repeated()
    {
        $this->assertEquals('lalala', Manipulator::make('la')->repeat(3));
    }

    public function test_that_special_characters_are_removed()
    {
        $string = Manipulator::make('Hello!')->removeSpecialCharacters();
        $this->assertEquals($string, 'Hello');
    }

    public function test_that_special_characters_are_removed_with_exceptions()
    {
        $string = Manipulator::make('Hello-Moto!!')->removeSpecialCharacters(['-']);
        $this->assertEquals($string, 'Hello-Moto');
    }

    public function test_that_a_string_is_converted_to_a_slug()
    {
        $string = Manipulator::make('This is a slug!')->toSlug();
        $this->assertEquals($string, 'this-is-a-slug');
    }

    public function test_that_a_string_is_truncated_and_appended_to()
    {
        $string = Manipulator::make('This is a sentence and will be truncated.')->truncate(10);
        $this->assertEquals($string, 'This is a ...');
    }

    public function test_that_tags_are_stripped()
    {
        $string = Manipulator::make('<div><i>Hello, Moto!</i></div>')->stripTags('<div>');
        $this->assertEquals($string, '<div>Hello, Moto!</div>');
    }

    public function test_that_possessive_string_is_returned()
    {
        $string = Manipulator::make('Bob ')->getPossessive();
        $this->assertEquals($string, 'Bob\'s');

        $string = Manipulator::make('Silas')->getPossessive();
        $this->assertEquals($string, 'Silas\'');
    }

    public function test_that_string_is_pluralized()
    {
        $string = Manipulator::make('potato')->pluralize();
        $this->assertEquals($string, 'potatoes');
    }

    public function test_that_a_string_with_1_or_less_items_is_not_pluralized()
    {
        $num_of_potatoes = 1;
        $string = Manipulator::make('potato')->pluralize($num_of_potatoes)->toString();
        $final = "I have $num_of_potatoes $string.";
        $this->assertEquals($final, 'I have 1 potato.');
    }

    public function test_that_a_string_with_2_or_more_items_is_pluralized()
    {
        $num_of_potatoes = 10;
        $string = Manipulator::make('potato')->pluralize($num_of_potatoes)->toString();
        $final = "I have $num_of_potatoes $string.";
        $this->assertEquals($final, 'I have 10 potatoes.');
    }

    public function test_that_a_string_with_2_or_more_items_is_pluralized_when_passed_an_array()
    {
        $num_of_potatoes = ['one', 'two', 'three'];
        $string = Manipulator::make('potato')->pluralize($num_of_potatoes)->toString();
        $final = "I have a bunch of $string.";
        $this->assertEquals($final, 'I have a bunch of potatoes.');
    }

    public function test_that_the_string_is_padded()
    {
        $string = Manipulator::make('Hello')->pad(7, '!!', STR_PAD_RIGHT);
        $this->assertEquals($string, 'Hello!!');
    }

    public function test_that_a_snake_case_string_is_converted_to_class_name()
    {
        $string = Manipulator::make('class_name')->snakeToClass();
        $this->assertEquals($string, 'ClassName');
    }
}
