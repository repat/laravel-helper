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

if (!function_exists('permutations')) {
    /**
     * Returns a generator of all permutations of given array

     * Based on `eddiewould`s port of python code
     * https://stackoverflow.com/a/43307800/2517690
     * https://docs.python.org/2/library/itertools.html#itertools.permutations
     *
     * @param  array $pool
     * @param  null|array  $r
     * @return void|Generator
     */
    function permutations(array $pool, ?array $r = null) : Generator
    {
        $n = count($pool);

        if (is_null($r)) {
            $r = $n;
        }

        if ($r > $n) {
            return;
        }

        $indices = range(0, $n - 1);
        $cycles = range($n, $n - $r + 1, -1); // count down

        yield array_slice($pool, 0, $r);

        if ($n <= 0) {
            return;
        }

        while (true) {
            $exitEarly = false;
            for ($i = $r;$i--;$i >= 0) {
                $cycles[$i]-= 1;
                if ($cycles[$i] == 0) {
                    // Push whatever is at index $i to the end, move everything back
                    if ($i < count($indices)) {
                        $removed = array_splice($indices, $i, 1);
                        array_push($indices, $removed[0]);
                    }
                    $cycles[$i] = $n - $i;
                } else {
                    $j = $cycles[$i];
                    // Swap indices $i & -$j.
                    $iVal = $indices[$i];
                    $negJVal = $indices[count($indices) - $j];
                    $indices[$i] = $negJVal;
                    $indices[count($indices) - $j] = $iVal;
                    $result = [];
                    $counter = 0;
                    foreach ($indices as $indx) {
                        array_push($result, $pool[$indx]);
                        $counter++;
                        if ($counter == $r) {
                            break;
                        }
                    }
                    yield $result;
                    $exitEarly = true;
                    break;
                }
            }
            if (!$exitEarly) {
                break; // Outer while loop
            }
        }
    }
}

if (!function_exists('auto_cast')) {
    /**
     * Will automatically cast strings into float/int or bool values
     *
     * @param  mixed $value
     * @return mixed
     */
    function auto_cast($value)
    {
        if (is_string($value)) {
            if (is_numeric($value)) {
                if (str_contains($value, '.')) {
                    // float, real or double
                    return floatval($value);
                } else {
                    return intval($value);
                }
            } elseif (strtolower($value) === 'true' || strtolower($value) === 'false') {
                return boolval($value);
            }
        }
        return $value;
    }
}

if (!function_exists('operating_system')) {
    /**
     * Returns Operating System, see constants in `defines.php`
     *
     * @return string|null
     */
    function operating_system() : ?string
    {
        $uname = php_uname();
        if (str_contains($uname, 'Darwin')) {
            return MACOS;
        } elseif (str_contains($uname, 'Linux')) {
            return LINUX;
        } elseif (str_icontains($uname, 'bsd')) {
            return BSD;
        } elseif (str_contains($uname, 'Windows')) {
            return WINDOWS;
        }
        return null;
    }
}

if (!function_exists('toggle')) {
    /**
     * Returns opposite of input
     *
     * @param bool $switch
     * @return bool
     */
    function toggle(bool $switch) : bool
    {
        return ($switch === false) ? true : false;
    }
}
