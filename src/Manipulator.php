<?php namespace TheStringler\Manipulator;

use Doctrine\Common\Inflector\Inflector;
use TheStringler\Manipulator\L33t;
use TheStringler\Manipulator\Exceptions\CreatingStringException;

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
     * @throws CreatingStringException
     */
    public function __construct($string)
    {
        if(!is_string($string)) {
            throw new CreatingStringException('Cannot create string. Type ' . gettype($string) . ' was passed.');
        }

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

        return new static(mb_strtolower($modifiedString));
    }

	/**
	 * Convert a camel-case string to class-case.
	 *
	 * @return object
	 */
    public function camelToClass()
    {
	    return new static($this->capitalize()->toString());
    }

    /**
     * Capitalize the string.
     *
     * @link https://gist.github.com/lfbittencourt/881f55c2d95810568ed7
     * @return object
     */
    public function capitalize()
    {
        return new static(mb_strtoupper(mb_substr($this->string, 0, 1)) . mb_substr($this->string, 1));
    }

    /**
     * Capitalize each word in the string.
     *
     * @return object
     */
    public function capitalizeEach()
    {
        return new static(trim(mb_convert_case($this->string, MB_CASE_TITLE)));
    }

	/**
	 * Perform an action on each character in the string.
	 *
	 * @param $closure
	 * @return object
	 */
    public function eachCharacter($closure) {
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
	 * @return object
	 */
    public function eachWord($closure, $preserveSpaces = false) {
	    $modifiedString = '';

	    foreach(explode(' ', $this->string) as $word) {
		    $modifiedString .= $closure($word);
		    $modifiedString .= $preserveSpaces ? ' ' : '';
	    }

	    return new static(trim($modifiedString));
    }

    /**
     * Get Possessive Version of String
     *
     * @return object
     */
    public function getPossessive()
    {
        $modifiedString = $this->trimEnd();

        if(mb_substr($modifiedString, -1) === 's') {
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
     * @return object
     */
    public function htmlEntitiesDecode($flags = ENT_HTML5, $encoding = 'UTF-8')
    {
        return new static(html_entity_decode($this->string, $flags, $encoding));
    }

    /**
     * HTML Entities
     *
     * @param  constant  $flags
     * @param  string    $encoding
     * @param  boolean   $doubleEncode
     * @return object
     */
    public function htmlEntities($flags = ENT_HTML5, $encoding = 'UTF-8', $doubleEncode = true)
    {
        return new static(htmlentities($this->string, $flags, $encoding, $doubleEncode));
    }

    /**
     * HTML Special Characters
     *
     * @param  constant  $flags
     * @param  string    $encoding
     * @param  boolean   $doubleEncode
     * @return object
     */
    public function htmlSpecialCharacters($flags = ENT_HTML5, $encoding = 'UTF-8', $doubleEncode = true)
    {
        return new static(htmlspecialchars($this->string, $flags, $encoding, $doubleEncode));
    }

    /**
     * Make the first letter of the string
     * lowercase.
     *
     * @link https://gist.github.com/lfbittencourt/881f55c2d95810568ed7
     * @return object
     */
    public function lowercaseFirst()
    {
        return new static(mb_strtolower(mb_substr($this->string, 0, 1)) . mb_substr($this->string, 1));
    }

    /**
     * Named Constructor
     *
     * @param string
     * @return object
     */
    public static function make($string)
    {
        return new static($string);
    }

    /**
     * Pad
     *
     * @param int
     * @param string
     * @param constant
     * @return object
     */
    public function pad($length, $string, $type = null)
    {
        return new static(str_pad($this->string, $length, $string, $type));
    }

    /**
     * Pluaralize String
     *
     * @param mixed
     * @return object
     */
    public function pluralize($items = null)
    {
        /**
         * Optional parameter to determine if a string
         * should be pluralized.
         */
        if(!is_null($items)) {
            $count = is_numeric($items) ? $items : count($items);

            if($count <= 1) {
                return $this;
            }
        }

        return new static(Inflector::pluralize($this->string));
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
     * @param boolean
     * @return object
     */
    public function remove($string, $caseSensitive = true)
    {
        return new static($this->replace($string, '', $caseSensitive)->toString());
    }

    /**
     * Remove non-alphanumeric characters.
     *
     * @param array
     * @return object
     */
    public function removeSpecialCharacters($exceptions = [])
    {
        $regEx  = "/";
        $regEx .= "[^\w\d";

        foreach($exceptions as $exception) {
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
     * @return object
     */
    public function repeat($multiplier = 1)
    {
        return new static(str_repeat($this->string, $multiplier));
    }

    /**
     * Replace
     *
     * @param string $find
     * @param string $replace
     * @param bool   $caseSensitive
     * @return object
     */
    public function replace($find, $replace = '', $caseSensitive = true)
    {
        $replaced = $caseSensitive ? str_replace($find, $replace, $this->string) :
                                     str_ireplace($find, $replace, $this->string);

        return new static($replaced);
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
     * snakeToClass
     *
     * @return object
     */
    public function snakeToClass()
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
     * @return object
     */
    public function stripTags($allowed = '')
    {
        return new static(strip_tags($this->string, $allowed));
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
	 * @return object
	 */
    public function toL33t() {
	    $modifiedString = $this->eachCharacter(function($char) {
		   return L33t::makeItL33t($char);
	    })->toString();

	    return new static($modifiedString);
    }

    /**
     * Convert the string to lowercase.
     *
     * @return object
     */
    public function toLower()
    {
        return new static(mb_strtolower($this->string));
    }

    /**
     * Convert string to slug
     *
     * @return object
     */
    public function toSlug()
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
     * @return object
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
        return new static(mb_strtoupper($this->string));
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

    /**
     * Truncate
     *
     * @param int    $length
     * @param string $append
     * @return object
     */
    public function truncate($length = 100, $append = '...')
    {
        return new static(mb_substr($this->string, 0, $length) . $append);
    }

    /**
     * Decode URL
     *
     * @return object
     */
    public function urlDecode()
    {
        return new static(urldecode($this->string));
    }

    /**
     * Encode URL
     *
     * @return object
     */
    public function urlEncode()
    {
        return new static(urlencode($this->string));
    }
}
