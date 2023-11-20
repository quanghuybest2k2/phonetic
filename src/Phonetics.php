<?php

namespace Phonetic;

class Phonetics
{
    const FORMAT_TXT = 'txt';
    const FORMAT_ARRAY = 'array';
    const FORMAT_JSON = 'json';
    const LANGUAGE_DEFAULT = 'en_us';

    /**
     * Phân tích các ký tự của một chuỗi và hiển thị chúng theo định dạng đã cho.
     *
     * @param string $string Chuỗi đầu vào
     * @param string $format Định dạng đầu ra (txt, array hoặc json)
     * @param string $language Ngôn ngữ cho dữ liệu phân tích (mặc định: en_us)
     * @return mixed Dữ liệu phân tích theo định dạng đã chọn
     */
    public static function symbols(string $string, string $format = self::FORMAT_TXT, string $language = self::LANGUAGE_DEFAULT)
    {
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
                    // Loại bỏ dấu "/" từ chuỗi phiên âm IPA
                    // $phoneticWord = str_replace('/', '', $phoneticWord);
                    // preg_match('/[^,\/]+/', $phoneticWord, $matches);
                    // $phoneticWord = $matches[0];
                } else {
                    $phoneticWord = $word;
                }
            } else {
                $phoneticWord = $word;
            }

            switch ($format) {
                case self::FORMAT_TXT:
                    // echo '[ ' . $word . ' ] => ' . $res[$word] . '<br>';
                    echo $phoneticWord . ' ';
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
    }
    //
}
