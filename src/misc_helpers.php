<?php

if (!function_exists('human_filesize')) {
    /**
     * Returns filesize of a file in a human readable (kilo, mega, giga etc)
     * form with 2 (or specified) decimals
     *
     * @param  int $bytes
     * @param  integer $decimals
     * @return string
     */
    function human_filesize(int $bytes, int $decimals = 2) : string
    {
        $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }
}

if (!function_exists('generate_password')) {
    /**
     * Syntactic Sugar for `str_random()`, default length is 15 characters
     *
     * @param  integer $length
     * @return string
     */
    function generate_password($length = 15) : string
    {
        return str_random($length);
    }
}

if (!function_exists('zenith')) {
    /**
     * Used for calculating when the sun sets
     *
     * `$type` can be `astronomical`, `nautical` or `civil`
     *
     * @param  string $type
     * @return float
     */
    function zenith(?string $type = null) : float
    {
        // What angle?
        switch ($type) {
            case 'astronomical': // Astronomical Twilight
                return 108.0;
            case 'nautical': // Nautical Twilight
                return 102.0;
            case 'civil': // Civil Twilight
                return 96.0;
            default: // Sunset
                return 90+50/60;
        }
    }
}
