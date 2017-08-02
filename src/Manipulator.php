<?php namespace TheStringler\Manipulator;

use Doctrine\Common\Inflector\Inflector;
use TheStringler\Manipulator\L33t;

/**
 * Class Manipulator
 * @package TheStringler\Manipulator
 */
class Manipulator
{
    /**
     * @var string
     */
    protected $string;

    /**
     * @param string
     */
    public function __construct(string $string)
    {
        $this->string = $string;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->string;
    }

    /**
     * Append to the string.
     *
     * @param string $string
     * @return object|Manipulator
     */
    public function append(string $string) : Manipulator
    {
        return new static($this->string . $string);
    }

    /**
     * Convert a camel-case string to snake-case.
     *
     * @return object|Manipulator
     */
    public function camelToSnake() : Manipulator
    {
        $modifiedString = '';

        foreach (str_split($this->string, 1) as $character) {
            $modifiedString .= ctype_upper($character) ? '_' . $character : $character;
        }

        return new static(mb_strtolower($modifiedString));
    }

    /**
     * Convert a camel-case string to class-case.
     *
     * @return object|Manipulator
     */
    public function camelToClass() : Manipulator
    {
        return new static($this->capitalize()->toString());
    }

    /**
     * Capitalize the string.
     *
     * @link https://gist.github.com/lfbittencourt/881f55c2d95810568ed7
     * @return object|Manipulator
     */
    public function capitalize() : Manipulator
    {
        return new static(mb_strtoupper(mb_substr($this->string, 0, 1)) . mb_substr($this->string, 1));
    }

    /**
     * Capitalize each word in the string.
     *
     * @return object|Manipulator
     */
    public function capitalizeEach() : Manipulator
    {
        return new static(trim(mb_convert_case($this->string, MB_CASE_TITLE)));
    }

    /**
     * Perform an action on each character in the string.
     *
     * @param $closure
     * @return object|Manipulator
     */
    public function eachCharacter(\Closure $closure) : Manipulator
    {
        $modifiedString = '';

        foreach (str_split($this->string) as $character) {
            $modifiedString .= $closure($character);
        }

        return new static($modifiedString);
    }

    /**
     * Perform an action on each word in the string.
     *
     * @param $closure
     * @param bool $preserveSpaces
     * @return object|Manipulator
     */
    public function eachWord(\Closure $closure, bool $preserveSpaces = false) : Manipulator
    {
        $modifiedString = '';

        foreach (explode(' ', $this->string) as $word) {
            $modifiedString .= $closure($word);
            $modifiedString .= $preserveSpaces ? ' ' : '';
        }

        return new static(trim($modifiedString));
    }

    /**
     * Get Possessive Version of String
     *
     * @return object|Manipulator
     */
    public function getPossessive() : Manipulator
    {
        $modifiedString = $this->trimEnd();

        if (mb_substr($modifiedString, -1) === 's') {
            $modifiedString .= '\'';
        } else {
            $modifiedString .= '\'s';
        }

        return new static($modifiedString);
    }

    /**
     * Decode HTML Entities
     *
     * @param  constant $flags
     * @param  string   $encoding
     * @return object|Manipulator
     */
    public function htmlEntitiesDecode($flags = ENT_HTML5, string $encoding = 'UTF-8') : Manipulator
    {
        return new static(html_entity_decode($this->string, $flags, $encoding));
    }

    /**
     * HTML Entities
     *
     * @param  constant  $flags
     * @param  string    $encoding
     * @param  boolean   $doubleEncode
     * @return object|Manipulator
     */
    public function htmlEntities($flags = ENT_HTML5, string $encoding = 'UTF-8', bool $doubleEncode = true) : Manipulator
    {
        return new static(htmlentities($this->string, $flags, $encoding, $doubleEncode));
    }

    /**
     * HTML Special Characters
     *
     * @param  constant  $flags
     * @param  string    $encoding
     * @param  boolean   $doubleEncode
     * @return object|Manipulator
     */
    public function htmlSpecialCharacters($flags = ENT_HTML5, string $encoding = 'UTF-8', bool $doubleEncode = true) : Manipulator
    {
        return new static(htmlspecialchars($this->string, $flags, $encoding, $doubleEncode));
    }

    /**
     * Make the first letter of the string
     * lowercase.
     *
     * @link https://gist.github.com/lfbittencourt/881f55c2d95810568ed7
     * @return object|Manipulator
     */
    public function lowercaseFirst() : Manipulator
    {
        return new static(mb_strtolower(mb_substr($this->string, 0, 1)) . mb_substr($this->string, 1));
    }

    /**
     * Named Constructor
     *
     * @param string
     * @return object|Manipulator
     */
    public static function make(string $string) : Manipulator
    {
        return new static($string);
    }

    /**
     * Pad
     *
     * @param int
     * @param string
     * @param constant
     * @return object|Manipulator
     */
    public function pad(int $length, string $string, $type = null) : Manipulator
    {
        return new static(str_pad($this->string, $length, $string, $type));
    }

    /**
     * Pluralize String
     *
     * @param mixed
     * @return object|Manipulator
     */
    public function pluralize($items = null) : Manipulator
    {
        /**
         * Optional parameter to determine if a string
         * should be pluralized.
         */
        if (!is_null($items)) {
            $count = is_numeric($items) ? $items : count($items);

            if ($count <= 1) {
                return $this;
            }
        }

        return new static(Inflector::pluralize($this->string));
    }

    /**
     * Prepend the string.
     *
     * @param  string
     * @return object|Manipulator
     */
    public function prepend(string $string) : Manipulator
    {
        return new static($string . $this->string);
    }

    /**
     * Perfrom an action on the nth character.
     *
     * @param  int
     * @param  Closure
     * @return object|Manipulator
     */
    public function nthCharacter(int $nth, \Closure $closure) : Manipulator
    {
        $count = 1;
        $modifiedString = '';

        foreach (str_split($this->string) as $character) {
            $modifiedString .= $count === $nth ? $closure($character) : $character;
            $count++;
        }

        return new static($modifiedString);
    }

    /**
     * Perform an action on the nth word.
     *
     * @param  int
     * @param  Closure
     * @param  boolean
     * @return object|Manipulator
     */
    public function nthWord(int $nth, \Closure $closure, bool $preserveSpaces = true) : Manipulator
    {
        $count = 1;
        $modifiedString = '';

        foreach (explode(' ', $this->string) as $word) {
            $modifiedString .= $count === $nth ? $closure($word) : $word;
            $modifiedString .= $preserveSpaces ? ' ' : '';
            $count++;
        }

        return new static(trim($modifiedString));
    }

    /**
     * Remove from string.
     *
     * @param  string
     * @param boolean
     * @return object|Manipulator
     */
    public function remove(string $string, bool $caseSensitive = true) : Manipulator
    {
        return new static($this->replace($string, '', $caseSensitive)->toString());
    }

    /**
     * Remove non-alphanumeric characters.
     *
     * @param array
     * @return object|Manipulator
     */
    public function removeSpecialCharacters(array $exceptions = []) : Manipulator
    {
        $regEx  = "/";
        $regEx .= "[^\w\d";

        foreach ($exceptions as $exception) {
            $regEx .= "\\" . $exception;
        }

        $regEx .= "]/";

        $modifiedString = preg_replace($regEx, '', $this->string);

        return new static($modifiedString);
    }

    /**
     * Repeat a string.
     *
     * @param  integer $multiplier
     * @return object|Manipulator
     */
    public function repeat(int $multiplier = 1) : Manipulator
    {
        return new static(str_repeat($this->string, $multiplier));
    }

    /**
     * Replace
     *
     * @param string $find
     * @param string $replace
     * @param bool   $caseSensitive
     * @return object|Manipulator
     */
    public function replace(string $find, string $replace = '', bool $caseSensitive = true) : Manipulator
    {
        $replaced = $caseSensitive ? str_replace($find, $replace, $this->string) :
                                     str_ireplace($find, $replace, $this->string);

        return new static($replaced);
    }

    /**
     * Reverse
     *
     * @return object|Manipulator
     */
    public function reverse() : Manipulator
    {
        return new static(strrev($this->string));
    }

    /**
     * Convert snake-case to camel-case.
     *
     * @return object|Manipulator
     */
    public function snakeToCamel() : Manipulator
    {
        $modifiedString = $this->replace('_', ' ')
            ->capitalizeEach()
            ->lowercaseFirst()
            ->remove(' ')
            ->toString();

        return new static($modifiedString);
    }

    /**
     * snakeToClass
     *
     * @return object|Manipulator
     */
    public function snakeToClass() : Manipulator
    {
        $modifiedString = $this->replace('_', ' ')
            ->toLower()
            ->capitalizeEach()
            ->replace(' ', '')
            ->toString();

        return new static($modifiedString);
    }

    /**
     * Strip HTML/PHP Tags
     *
     * @param string $allowed
     * @return object|Manipulator
     */
    public function stripTags(string $allowed = '') : Manipulator
    {
        return new static(strip_tags($this->string, $allowed));
    }

    /**
     * Convert a string to camel-case.
     *
     * @return object|Manipulator
     */
    public function toCamelCase() : Manipulator
    {
        $modifiedString = '';

        foreach (explode(' ', $this->string) as $word) {
            $modifiedString .= self::make($word)->toLower()->capitalize()->toString();
        }

        $final = self::make($modifiedString)
            ->replace(' ', '')
            ->lowercaseFirst()
            ->toString();

        return new static($final);
    }

    /**
     * Make a string L33t.
     *
     * @return object|Manipulator
     */
    public function toL33t() : Manipulator
    {
        return new static($this->eachCharacter(function ($char) {
            return L33t::makeItL33t($char);
        })->toString());
    }

    /**
     * Convert the string to lowercase.
     *
     * @return object|Manipulator
     */
    public function toLower() : Manipulator
    {
        return new static(mb_strtolower($this->string));
    }

    /**
     * Convert string to slug
     *
     * @return object|Manipulator
     */
    public function toSlug() : Manipulator
    {
        $modifiedString = $this->toLower()
            ->replace(' ', '-')
            ->removeSpecialCharacters(['-'])
            ->toString();

        return new static($modifiedString);
    }

    /**
     * Convert string to snake-case
     *
     * @return object|Manipulator
     */
    public function toSnakeCase() : Manipulator
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
    public function toString() : string
    {
        return $this->string;
    }

    /**
     * Capitalize entire string.
     *
     * @return object|Manipulator
     */
    public function toUpper() : Manipulator
    {
        return new static(mb_strtoupper($this->string));
    }

    /**
     * Trim
     *
     * @return object|Manipulator
     */
    public function trim() : Manipulator
    {
        return new static(trim($this->string));
    }

    /**
     * Trim the beginning of the string.
     *
     * @return object|Manipulator
     */
    public function trimBeginning() : Manipulator
    {
        return new static(ltrim($this->string));
    }

    /**
     * Trim the end of the string.
     *
     * @return object|Manipulator
     */
    public function trimEnd() : Manipulator
    {
        return new static(rtrim($this->string));
    }

    /**
     * Truncate
     *
     * @param int    $length
     * @param string $append
     * @return object|Manipulator
     */
    public function truncate(int $length = 100, string $append = '...') : Manipulator
    {
        return new static(mb_substr($this->string, 0, $length) . $append);
    }

    /**
     * Decode URL
     *
     * @return object|Manipulator
     */
    public function urlDecode() : Manipulator
    {
        return new static(urldecode($this->string));
    }

    /**
     * Encode URL
     *
     * @return object|Manipulator
     */
    public function urlEncode() : Manipulator
    {
        return new static(urlencode($this->string));
    }

    /**
     * Return String in SnakeCase
     * @return object|Manipulator
     */
    public function toSnake() : Manipulator
    {
        $newModified = null;

        $this->string = lcfirst($this->ucAll());
        
        foreach (str_split($this->string, 1) as $character) {
            $newModified .= ctype_upper($character) ? '_' . $character : $character;
        }

        return self::make($newModified)->toLower()->replace(' ', '_')->replace('-', '_')->replace('__', '_');
    }

    /**
     * Returns string with each word is first letter capitalized
     * except if it is camelCase (which is treated as one word)
     * @return object|Manipulator
     */
    protected function ucAll()
    {
        $temp = preg_split('/(\W)/', $this->string, -1, PREG_SPLIT_DELIM_CAPTURE);
        if (count($temp) > 1) {
            foreach ($temp as $key => $word) {
                $temp[$key] = ucfirst(strtolower($word));
            }
        }
        return new static(join('', $temp));
    }
}
