<?php

namespace Phonetic;

class Caverphone
{
    protected $version = '1.0.0';
    protected $string;

    public function __construct(string $string, int $version = null)
    {
        $this->string = strtolower($string);
    }
}
