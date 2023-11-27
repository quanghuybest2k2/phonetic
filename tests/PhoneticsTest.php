<?php

namespace Phonetic;

use PHPUnit\Framework\TestCase;

class PhoneticsTest extends TestCase
{
    public function testSymbolsTxtFormat()
    {
        $inputString = "Hello World";
        $expectedOutput = "/həˈɫoʊ/, /hɛˈɫoʊ/ /ˈwɝɫd/ ";

        ob_start();
        Phonetics::symbols($inputString, Phonetics::FORMAT_TXT);
        $actualOutput = ob_get_clean();

        $this->assertEquals($expectedOutput, $actualOutput);
    }

    public function testSymbolsArrayFormat()
    {
        $inputString = "Hello World";
        $expectedOutput = [
            'hello' => [
                0 => '/həˈɫoʊ/',
                1 => ' /hɛˈɫoʊ/'
            ],
            'world' => [
                0 => '/ˈwɝɫd/'
            ]
        ];

        $actualOutput = Phonetics::symbols($inputString, Phonetics::FORMAT_ARRAY);

        $this->assertEquals($expectedOutput, $actualOutput);
    }

    public function testSymbolsJsonFormat()
    {
        $inputString = "Hello World";
        $expectedOutput = '{"hello":["\/h\u0259\u02c8\u026bo\u028a\/"," \/h\u025b\u02c8\u026bo\u028a\/"],"world":["\/\u02c8w\u025d\u026bd\/"]}';

        $actualOutput = Phonetics::symbols($inputString, Phonetics::FORMAT_JSON);

        $this->assertEquals($expectedOutput, $actualOutput);
    }
    //
}
