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
