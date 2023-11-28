# Phonetic

Convert english to ipa

# Installation

Open your terminal and run:

`composer require quanghuybest2k2/phonetic`

# Usage

Example

```php

use Phonetic\Phonetics;

require __DIR__ . '/vendor/autoload.php';

$word = "Firewall is good Huy";

// txt
$phoneticSymbols = Phonetics::symbols($word, 'txt');
echo $phoneticSymbols;

echo '<br/>';
// array
$phoneticArray = Phonetics::symbols($word, 'array');
print_r($phoneticArray);

// json
$phoneticJson = json_encode(Phonetics::symbols($word, 'json'));
echo $phoneticJson;

/*
output:
ˈfaɪɹwɑɫ ˈɪz ˈɡʊd huy
Array ( [firewall] => Array ( [0] => ˈfaɪɹwɑɫ ) [is] => Array ( [0] => ˈɪz ) [good] => Array ( [0] => ˈɡʊd ) [huy] => Array ( [0] => huy ) ) "{\"firewall\":[\"\\u02c8fa\\u026a\\u0279w\\u0251\\u026b\"],\"is\":[\"\\u02c8\\u026az\"],\"good\":[\"\\u02c8\\u0261\\u028ad\"],\"huy\":[\"huy\"]}"
*/
```

## NYSIIS encoding

```php
Phonetics::nysiis($word);
/*
output:
FARAALL
[ is ] => A
[ good ] => GAAD
[ huy ] => HY
*/
```
