<?php
namespace TheStringler\Manipulator;

class Manipulator
{
    /**
     * @var string
     */
    protected $string;

    /**
     * @param string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }

    /**
     * Append to the string.
     *
     * @param  string
     * @return object
     */
    public function append($string)
    {
        return new static($this->string . $string);
    }

    /**
     * Convert a camel-case string to snake-case.
     *
     * @return object
     */
    public function camelToSnake()
    {
        $modifiedString = '';

        foreach (str_split($this->string, 1) as $character) {
            $modifiedString .= ctype_upper($character) ? '_' . $character : $character;
        }

        return new static(strtolower($modifiedString));
    }

    /**
     * Capitalize the string.
     *
     * @return object
     */
    public function capitalize()
    {
        return new static(ucfirst($this->string));
    }

    /**
     * Capitalize each word in the string.
     *
     * @return object
     */
    public function capitalizeEach()
    {
        $modifiedString = '';

        foreach (explode(' ', $this->string) as $word) {
            $modifiedString .= ucfirst($word) . ' ';
        }

        return new static(trim($modifiedString));
    }

    /**
     * Make the first letter of the string
     * lowercase.
     *
     * @return object
     */
    public function lowercaseFirst()
    {
        return new static(lcfirst($this->string));
    }

    /**
     * @return object
     */
    public static function make($string)
    {
        return new static($string);
    }

    /**
     * Prepend the string.
     *
     * @param  string
     * @return object
     */
    public function prepend($string)
    {
        return new static($string . $this->string);
    }

    /**
     * Remove from string.
     *
     * @param  string
     * @return object
     */
    public function remove($string)
    {
        return new static($this->replace($string)->toString());
    }

    /**
     * Replace
     *
     * @param  string $find
     * @param  string $replace
     * @return object
     */
    public function replace($find, $replace = '')
    {
        return new static(str_replace($find, $replace, $this->string));
    }

    /**
     * Reverse
     *
     * @return object
     */
    public function reverse()
    {
        return new static(strrev($this->string));
    }

    /**
     * Convert snake-case to camel-case.
     *
     * @return object
     */
    public function snakeToCamel()
    {
        $modifiedString = $this->replace('_', ' ')
            ->capitalizeEach()
            ->lowercaseFirst()
            ->remove(' ')
            ->toString();

        return new static($modifiedString);
    }

    /**
     * Convert a string to camel-case.
     *
     * @return object
     */
    public function toCamelCase()
    {
        $modifiedString = '';

        foreach (explode(' ', $this->string) as $word) {
            $modifiedString .= ucfirst(strtolower($word));
        }

        return new static(lcfirst(str_replace(' ', '', $modifiedString)));
    }

    /**
     * Convert the string to lowercase.
     *
     * @return object
     */
    public function toLower()
    {
        return new static(strtolower($this->string));
    }

    /**
     * Convert string to snake-case
     *
     * @return obect
     */
    public function toSnakeCase()
    {
        $modifiedString = $this->toLower()
            ->replace(' ', '_')
            ->toString();

        return new static($modifiedString);
    }

    /**
     * Return the string.
     *
     * @return string
     */
    public function toString()
    {
        return $this->string;
    }

    /**
     * Capitalize entire string.
     *
     * @return object
     */
    public function toUpper()
    {
        return new static(strtoupper($this->string));
    }

    /**
     * Trim
     *
     * @return object
     */
    public function trim()
    {
        return new static(trim($this->string));
    }

    /**
     * Trim the beginning of the string.
     *
     * @return object
     */
    public function trimBeginning()
    {
        return new static(ltrim($this->string));
    }

    /**
     * Trim the end of the string.
     *
     * @return object
     */
    public function trimEnd()
    {
        return new static(rtrim($this->string));
    }

}
