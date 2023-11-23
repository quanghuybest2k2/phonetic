<?php

namespace Phonetic;

class Arpabet
{

	const FORMAT_TXT = 'txt';
	const FORMAT_ARRAY = 'array';
	const FORMAT_JSON = 'json';
	const LANGUAGE_DEFAULT = 'en_us';

	public $string;

	public $ipa = [
		'ɑ' => 'AA',
		'æ' => 'AE',
		'ʌ' => 'AH',
		'ɔ' => 'AO',
		'aʊ' => 'AW',
		'ə' => 'AX',
		'ɚ' => 'ER',
		'ɝ' => 'ER',
		'aɪ' => 'AY',
		'ɛ' => 'EH'
	];

	public function __construct(string $string)
	{

		$this->string = $string;
		return 'PO';
	}

	public function getIPA()
	{

		$this->string = Phonetics::symbols($this->string, $format = self::FORMAT_ARRAY, $language = self::LANGUAGE_DEFAULT);
		var_dump($this->string);
	}

	public function encode()
	{
		foreach ($this->string as $key => $value) {
			$symbols = str_split($value);
			for ($i = 0; $i < count($symbols); $i++) {
				$symbols[$i] = $this->ipa[$symbols[$i]];
			}
			$this->string[$i] = implode($symbols);
		}
	}
}
