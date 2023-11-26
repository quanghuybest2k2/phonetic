<?php

namespace Phonetic;

class MatchRatingApproach
{
    public $string;
    public $initial;

    public $doubles = [
        'AA' =>  'A',
        'BB' =>  'B',
        'CC' =>  'C',
        'DD' =>  'D',
        'EE' =>  'E',
        'FF' =>  'F',
        'GG' =>  'G',
        'HH' =>  'H',
        'II' =>  'I',
        'JJ' =>  'J',
        'KK' =>  'K',
        'LL' =>  'L',
        'MM' =>  'M',
        'NN' =>  'N',
        'OO' =>  'O',
        'PP' =>  'P',
        'QQ' =>  'Q',
        'RR' =>  'R',
        'SS' =>  'S',
        'TT' =>  'T',
        'UU' =>  'U',
        'VV' =>  'V',
        'WW' =>  'W',
        'XX' =>  'X',
        'YY' =>  'Y',
        'ZZ' =>  'Z'
    ];

    public function __construct(string $string)
    {
        $this->string = strtoupper($string);
        $this->initial = strtoupper($string[0]);
    }

    public function cleanDoubles()
    {
        foreach ($doubles as $key => $value) {
            $this->string = str_replace($key, $value, $this->string);
        }
    }
}
