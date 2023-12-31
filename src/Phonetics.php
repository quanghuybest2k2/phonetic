<?php

namespace Phonetic;

use Phonetic\Nysiis;
use Phonetic\FormatValidationTrait;

class Phonetics
{
    use FormatValidationTrait;

    const FORMAT_TXT = 'txt';
    const FORMAT_ARRAY = 'array';
    const FORMAT_JSON = 'json';

    /**
     * Phân tích các ký tự của một chuỗi và hiển thị chúng theo định dạng đã cho.
     *
     * @param string $string Chuỗi đầu vào
     * @param string $format Định dạng đầu ra (txt, array hoặc json)
     * @param string $language Ngôn ngữ cho dữ liệu phân tích (mặc định: en_us)
     * @return mixed Dữ liệu phân tích theo định dạng đã chọn
     */
    public static function symbols(string $string, string $format = self::FORMAT_TXT, string $language = Language::EN_US)
    {
        self::validateFormat($format);

        $words = array_unique(explode(' ', strtolower(preg_replace("/[^\w\s]/", "", $string))));
        // có dấu phẩy
        // $words = array_unique(explode(' ', strtolower(preg_replace("/[^\w\s,]/", "", $string))));
        $results = [];

        foreach ($words as $word) {
            $file_path = __DIR__ . '/data/' . $language . '/' . $word[0] . '.json';

            if (file_exists($file_path)) {
                $json = file_get_contents($file_path);
                $res = json_decode($json, true);
                /* $phoneticWord = $word;
                 * nếu không có trong data thì lấy từ đó luôn
                 * vd: Huy sẽ là Huy luôn, vì không có trong data
                 */
                if (isset($res[$word])) {
                    $phoneticWord = $res[$word];
                } else {
                    $phoneticWord = $word;
                }
            } else {
                $phoneticWord = $word;
            }

            switch ($format) {
                case self::FORMAT_TXT:
                    $results[] = $phoneticWord;
                    break;

                case self::FORMAT_ARRAY:
                    $results[$word] = explode(',', $phoneticWord);
                    break;

                case self::FORMAT_JSON:
                    $results[$word] = explode(',', $phoneticWord);
                    break;

                default:
                    # code...
                    break;
            }
        }

        if ($format == 'array') {
            return $results;
        }

        if ($format == 'json') {
            return json_encode($results);
        }
        return implode(' ', $results);
    }

    /**
     * Chuyển đổi một chuỗi thành mã âm thanh Soundex và hiển thị hoặc trả về theo định dạng đã chọn.
     *
     * @param string $string Chuỗi đầu vào
     * @param string $format Định dạng đầu ra (txt, array hoặc json)
     * @return mixed Mã âm thanh Soundex theo định dạng đã chọn
     */
    public static function soundex(string $string, string $format = self::FORMAT_TXT)
    {
        self::validateFormat($format);

        $words = array_unique(explode(' ', strtolower(preg_replace("/[^\w\s]/", "", $string))));

        $results = [];

        foreach ($words as $word) {

            switch ($format) {
                case self::FORMAT_TXT:
                    echo '[ ' . $word . ' ] => ' . soundex($word) . '<br>';
                    break;

                case self::FORMAT_ARRAY:
                    $results[$word] = soundex($word);
                    break;

                case self::FORMAT_JSON:
                    $results[$word] = soundex($word);
                    break;

                default:
                    # code...
                    break;
            }
        }

        if ($format == self::FORMAT_ARRAY) {
            return $results;
        }

        if ($format == self::FORMAT_JSON) {
            return json_encode($results);
        }
    }

    /**
     * Chuyển đổi một chuỗi thành mã âm thanh Metaphone và hiển thị hoặc trả về theo định dạng đã chọn.
     *
     * @param string $string Chuỗi đầu vào
     * @param string $format Định dạng đầu ra (txt, array hoặc json)
     * @return mixed Mã âm thanh Metaphone theo định dạng đã chọn
     */
    public static function metaphone(string $string, string $format = self::FORMAT_TXT)
    {
        self::validateFormat($format);

        $words = array_unique(explode(' ', strtolower(preg_replace("/[^\w\s]/", "", $string))));

        $results = [];

        foreach ($words as $word) {

            switch ($format) {
                case self::FORMAT_TXT:
                    echo '[ ' . $word . ' ] => ' . metaphone($word) . '<br>';
                    break;

                case self::FORMAT_ARRAY:
                    $results[$word] = metaphone($word);
                    break;

                case self::FORMAT_JSON:
                    $results[$word] = metaphone($word);
                    break;

                default:
                    # code...
                    break;
            }
        }

        if ($format == self::FORMAT_ARRAY) {
            return $results;
        }

        if ($format == self::FORMAT_JSON) {
            return json_encode($results);
        }
    }

    /**
     * Phân tích các ký tự của một chuỗi và hiển thị chúng theo định dạng đã cho.
     *
     * @param string $string Chuỗi đầu vào
     * @param string $format Định dạng đầu ra (txt, array hoặc json)
     * @param string $language Ngôn ngữ cho dữ liệu phân tích (mặc định: en_us)
     * @return mixed Dữ liệu phân tích theo định dạng đã chọn
     * @throws \InvalidArgumentException Nếu định dạng không hợp lệ
     */
    public static function nysiis(string $string, string $format = self::FORMAT_TXT)
    {
        self::validateFormat($format);

        $words = array_unique(explode(' ', strtolower(preg_replace("/[^\w\s]/", "", $string))));

        $results = [];

        foreach ($words as $word) {

            $encodedWord = Nysiis::encode($word);

            switch ($format) {
                case self::FORMAT_TXT:
                    // echo '[ ' . $word . ' ] => ' . Nysiis::encode($word) . '<br>';
                    echo "[ {$word} ] => {$encodedWord}<br>";
                    break;

                case self::FORMAT_ARRAY:
                    $results[$word] = $encodedWord;
                    break;

                case self::FORMAT_JSON:
                    $results[$word] = $encodedWord;
                    break;

                default:
                    # code...
                    break;
            }
        }

        if ($format == self::FORMAT_ARRAY) {
            return $results;
        }

        if ($format == self::FORMAT_JSON) {
            return json_encode($results);
        }
    }
    //
}
