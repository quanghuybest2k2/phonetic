<?php

namespace Phonetic;

trait FormatValidationTrait
{
    /**
     * Kiểm tra định dạng có hợp lệ hay không.
     *
     * @param string $format Định dạng cần kiểm tra
     * @throws \InvalidArgumentException Nếu định dạng không hợp lệ
     */
    private static function validateFormat(string $format)
    {
        if (!in_array($format, [Phonetics::FORMAT_TXT, Phonetics::FORMAT_ARRAY, Phonetics::FORMAT_JSON])) {
            throw new \InvalidArgumentException("Sai định dạng: {$format}. Chỉ hỗ trợ txt, array và json.");
        }
    }
}
