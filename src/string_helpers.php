<?php

if (!function_exists('str_icontains')) {
    /**
     * `str_contains()` case insensitive
     *
     * @param  string $haystack
     * @param  string $needle
     * @return bool
     */
    function str_icontains(string $haystack, string $needle): bool
    {
        return (strpos(strtolower($haystack), strtolower($needle)) !== false);
    }
}

if (!function_exists('str_replace_once')) {
    /**
     * Replaces a string only once (vs. `str_replace()`)
     *
     * @param  string $search
     * @param  string $replace
     * @param  string $subject
     * @return string
     */
    function str_replace_once(string $search, string $replace, string $subject): string
    {
        $firstChar = strpos($subject, $search);
        if ($firstChar !== false) {
            $beforeStr = substr($subject, 0, $firstChar);
            $afterStr = substr($subject, $firstChar + strlen($search));
            return $beforeStr . $replace . $afterStr;
        } else {
            return $subject;
        }
    }
}

if (!function_exists('str_bytes')) {
    /**
     * Returns size of any text in bytes
     * Strings are expected to be in UTF-8 (incl ASCII) format
     *
     * @param string $str
     * @return int
     */
    function str_bytes(string $str): int
    {

        // Number of characters in string
        $strlen_var = strlen($str);

        // string bytes counter
        $d = 0;

        /*
         * Iterate over every character in the string,
         * escaping with a slash or encoding to UTF-8 where necessary
         */
        for ($c = 0; $c < $strlen_var; ++$c) {
            $ord_var_c = ord($str{$c});
            switch (true) {
                case (($ord_var_c >= 0x20) && ($ord_var_c <= 0x7F)):
                    // characters U-00000000 - U-0000007F (same as ASCII)
                    $d++;
                    break;
                case (($ord_var_c & 0xE0) == 0xC0):
                    // characters U-00000080 - U-000007FF, mask 110XXXXX
                    $d += 2;
                    break;
                case (($ord_var_c & 0xF0) == 0xE0):
                    // characters U-00000800 - U-0000FFFF, mask 1110XXXX
                    $d += 3;
                    break;
                case (($ord_var_c & 0xF8) == 0xF0):
                    // characters U-00010000 - U-001FFFFF, mask 11110XXX
                    $d += 4;
                    break;
                case (($ord_var_c & 0xFC) == 0xF8):
                    // characters U-00200000 - U-03FFFFFF, mask 111110XX
                    $d += 5;
                    break;
                case (($ord_var_c & 0xFE) == 0xFC):
                    // characters U-04000000 - U-7FFFFFFF, mask 1111110X
                    $d += 6;
                    break;
                default:
                    $d++;
            };
        }
        return $d;
    }
}

if (!function_exists('to_ascii')) {
    /**
     * Filters a raw string and only lets ACII characters through
     *
     * @param  string $rawstring
     * @return string
     */
    function to_ascii(string $rawstring): string
    {
        return filter_var($rawstring, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    }
}

/*
|--------------------------------------------------------------------------
| Need Comments
|--------------------------------------------------------------------------
 */

if (!function_exists('title_case_wo_underscore')) {
    function title_case_wo_underscore(string $string): string
    {
        return str_replace('_', ' ', title_case($string));
    }
}

if (!function_exists('hyphen2_')) {
    function hyphen2_(string $string): string
    {
        return str_replace('-', '_', $string);
    }
}

if (!function_exists('_2hyphen')) {
    function _2hyphen(string $string): string
    {
        return str_replace('_', '-', $string);
    }
}
if (!function_exists('regex_list')) {
    function regex_list(array $array): string
    {
        return REGEX_WORD_BOUNDARY . implode('|' . REGEX_WORD_BOUNDARY, $array);
    }
}
