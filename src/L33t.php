<?php

namespace TheStringler\Manipulator;


class L33t {
	/**
	 * Letters
	 *
	 * @link http://www.gamehouse.com/blog/leet-speak-cheat-sheet/
	 * @var array
	 */
	protected static $letters = [
		'a' => ['4', '@', '^'],
		'b' => ['8', 'ß', '13', '!3'],
		'c' => ['[', '¢', '{', '©'],
		'd' => [')', 'T)', '|)'],
		'e' => ['3', '£', '€', '[-'],
		'f' => ['|=', 'ƒ', 'ph'],
		'g' => ['&', '6', '9'],
		'h' => ['#', '/-/', '[-]', '(-)'],
		'i' => ['1', '[]', '|', '!'],
		'j' => [',_|', '_|'],
		'k' => ['>|', '|<', '/<'],
		'l' => ['1', '7', '|_', '|'],
		'm' => ['/\/\\', 'JVI', '^^', '|V|'],
		'n' => ['^/', '|\\|', '<\\>'],
		'o' => ['0', 'oh', 'Ø'],
		'p' => ['|*', '|O', '|7'],
		'q' => ['(_,)', '()_'],
		'r' => ['|2', '®', 'Я'],
		's' => ['5', '$'],
		't' => ['7', '+', ']['],
		'u' => ['(_)', '|_|'],
		'v' => ['\\/'],
		'w' => ['\\/\\/', 'VV', '\\X/'],
		'x' => ['><', '>|<', '}{'],
		'y' => ['`/`', '\\|/', '¥'],
		'z' => ['2', '-/_', '%'],
	];

	public static function makeItL33t($character) {
		$lower = strtolower($character);

		if(array_key_exists($lower, self::$letters)) {
			return self::$letters[$lower][array_rand(self::$letters[$lower])];
		}

		return $character;
	}
}