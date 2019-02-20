<?php

if (!function_exists('str_icontains')) {
    /**
     * `str_contains()` case insensitive
     *
     * @param  string $needle
     * @param  string $haystack
     * @return bool
     */
    function str_icontains(string $needle, string $haystack) : bool
    {
        return (strpos(strtolower($haystack), strtolower($needle)) === false);
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
    function str_replace_once(string $search, string $replace, string $subject) : string
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
