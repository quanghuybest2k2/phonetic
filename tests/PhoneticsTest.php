<?php

namespace Phonetic;

use PHPUnit\Framework\TestCase;

class PhoneticsTest extends TestCase
{
    public function testSymbolsTxtFormatWithEN_US()
    {
        $inputString = "Firewall is good Huy";
        $expectedOutput = "/ˈfaɪɹwɑɫ/ /ˈɪz/, /ɪz/ /ˈɡʊd/, /ɡɪd/ huy";

        $actualOutput = Phonetics::symbols($inputString, Phonetics::FORMAT_TXT, Language::EN_US);

        $this->assertEquals($expectedOutput, $actualOutput);
    }
    public function testSymbolsTxtFormatWithEN_UK()
    {
        $inputString = "Firewall is good Huy";
        $expectedOutput = "/fˈa‍ɪ‍əwɔːl/ /ˈɪz/ /ɡˈʊd/ huy";

        $actualOutput = Phonetics::symbols($inputString, Phonetics::FORMAT_TXT, Language::EN_UK);

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
