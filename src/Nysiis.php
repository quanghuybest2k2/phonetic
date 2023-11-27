<?php

namespace Phonetic;

class Nysiis
{
	public $string;
	public $initial;

	public function __construct(string $string)
	{
		$this->string = strtolower($string);
		$this->initial = strtoupper($string[0]);

		$this->firstLetters();
		$this->lastLetters();
		$this->vowels();
		$this->consonants();
		$this->letterH();
		$this->letterW();
		$this->digraph();
		$this->lastChar();
	}
	/**
	 * Static method to encode a string using NYSIIS.
	 *
	 * @param string $string The input string to be encoded.
	 * @return string The NYSIIS encoded string.
	 */
	public static function encode(string $string)
	{
		$encode = new self($string);
		return $encode->results();
	}

	public function firstLetters()
	{
		$three = substr($this->string, 0, 3);
		if ($three === 'mac') {
			$this->string = substr_replace($this->string, 'mcc', 0, 3);
		}
		if ($three === 'sch') {
			$this->string = substr_replace($this->string, 'sss', 0, 3);
		}

		$two = substr($this->string, 0, 2);
		if ($two === 'pf' || $two === 'ph') {
			$this->string = substr_replace($this->string, 'ff', 0, 2);
			$this->initial = 'F';
		}
		if ($two === 'kn') {
			$this->string = substr_replace($this->string, 'nn', 0, 2);
			$this->initial = 'N';
		}

		$one = substr($this->string, 0, 1);
		if ($one === 'k') {
			$this->string = substr_replace($this->string, 'c', 0, 1);
			$this->initial = 'C';
		}
	}

	public function lastLetters()
	{
		$two = substr($this->string, -2);
		if ($two === 'ee' || $two === 'ie') {
			$this->string = substr_replace($this->string, 'y', -2, 2);
		}
		if ($two === 'nd' || $two === 'nt' || $two === 'rd' || $two === 'rt' || $two === 'dt') {
			$this->string = substr_replace($this->string, 'd', -2, 2);
		}
	}

	public function vowels()
	{
		$exploded = str_split($this->string);
		$vowels = ['a', 'e', 'i', 'o', 'u'];

		for ($i = 0; $i < count($exploded); $i++) {

			if ($exploded[$i] === 'e' && $exploded[$i + 1] === 'v') {
				$exploded[$i] = 'a';
				$exploded[$i + 1] = 'f';
			}

			if (in_array($exploded[$i], $vowels)) {
				$exploded[$i] = 'a';
			}
		}

		$this->string = implode($exploded);
	}

	public function consonants()
	{
		$exploded = str_split($this->string);

		for ($i = 0; $i < count($exploded); $i++) {

			if ($exploded[$i] === 'k' && $exploded[$i + 1] === 'n') {
				unset($exploded[$i]);
			}

			if ($exploded[$i] === 'q') {
				$exploded[$i] = 'g';
			}
			if ($exploded[$i] === 'z') {
				$exploded[$i] = 's';
			}
			if ($exploded[$i] === 'm') {
				$exploded[$i] = 'n';
			}
		}

		$this->string = implode($exploded);
	}

	public function letterH()
	{
		$exploded = str_split($this->string);
		$vowels = ['a', 'e', 'i', 'o', 'u'];

		for ($i = 0; $i < count($exploded); $i++) {
			if ($exploded[$i] === 'h') {
				if (in_array($exploded[$i + 1], $vowels) || in_array($exploded[$i - 1], $vowels)) {
				} else {
					unset($exploded[$i]);
				}
			}
		}

		$this->string = implode($exploded);
	}

	public function letterW()
	{
		$exploded = str_split($this->string);
		$vowels = ['a', 'e', 'i', 'o', 'u'];

		for ($i = 0; $i < count($exploded); $i++) {
			if ($exploded[$i] === 'w') {
				if (in_array($exploded[$i - 1], $vowels)) {
					unset($exploded[$i]);
				}
			}
		}

		$this->string = implode($exploded);
	}

	public function digraph()
	{
		$this->string = str_replace('sch', 'sss', $this->string);
		$this->string = str_replace('ph', 'ff', $this->string);
	}

	public function lastChar()
	{
		$exploded = str_split($this->string);

		if (end($exploded) === 's' || end($exploded) === 'a') {
			$last = count($exploded) - 1;
			unset($exploded[$last]);
		}

		if (end($exploded) === 'y' && prev($exploded) === 'a') {
			$last = count($exploded) - 2;
			unset($exploded[$last]);
		}

		$this->string = implode($exploded);
	}
	/**
	 * Get the final NYSIIS encoded string.
	 *
	 * @return string The final NYSIIS encoded string in uppercase.
	 */
	public function results()
	{
		return strtoupper($this->string);
	}
}
