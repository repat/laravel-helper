<?php

if (!function_exists('days_in_month')) {
    /**
     * How many days are in given month, defaults to current
     *
     * @return int
     */
    function days_in_month(?int $month = null, ?int $year = null) : int
    {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }
}

if (!function_exists('days_this_month')) {
    /**
     * How many days are in current month (28/29/30/31)
     *
     * @return int
     */
    function days_this_month() : int
    {
        return days_in_month(now()->month, now()->year);
    }
}

if (!function_exists('days_next_month')) {
    /**
     * How many days are in next month (28/29/30/31)
     *
     * @return int
     */
    function days_next_month() : int
    {
        return days_in_month(now()->addMonth()->month, now()->addMonth()->year);
    }
}

if (!function_exists('days_this_year')) {
    /**
     * How many days are in current year, depending on leap year
     *
     * @return int
     */
    function days_this_year() : int
    {
        // leap year
        return date('L') == 1 ? DAYS_PER_LEAP_YEAR : DAYS_PER_YEAR;
    }
}

if (!function_exists('days_left_in_month')) {
    /**
     * How many days are left in current month
     *
     * @return int
     */
    function days_left_in_month() : int
    {
        return days_this_month() - now()->day;
    }
}

if (!function_exists('days_left_in_year')) {
    /**
     * How many days are left in current year
     *
     * @return int
     */
    function days_left_in_year() : int
    {
        return days_this_year() - now()->dayOfYear;
    }
}

if (!function_exists('timezone_list')) {
    /**
     * A list of timezones
     *
     * @return array
     */
    function timezone_list() : array
    {
        $regions = [
            DateTimeZone::AFRICA,
            DateTimeZone::AMERICA,
            DateTimeZone::ANTARCTICA,
            DateTimeZone::ASIA,
            DateTimeZone::ATLANTIC,
            DateTimeZone::AUSTRALIA,
            DateTimeZone::EUROPE,
            DateTimeZone::INDIAN,
            DateTimeZone::PACIFIC,
        ];

        $timezones = [];

        foreach ($regions as $region) {
            $timezones = array_merge($timezones, DateTimeZone::listIdentifiers($region));
        }

        $timezoneOffsets = [];

        foreach ($timezones as $timezone) {
            $tz = new DateTimeZone($timezone);
            $timezoneOffsets[$timezone] = $tz->getOffset(new DateTime);
        }

        // sort timezone by offset
        asort($timezoneOffsets);

        $timezoneList = [];

        foreach ($timezoneOffsets as $timezone => $offset) {
            $offsetPrefix = $offset < 0 ? '-' : '+';
            $offsetFormatted = gmdate('H:i', abs($offset));

            $prettyOffset = "UTC${offsetPrefix}${offsetFormatted}";

            $timezoneList[$timezone] = "(${prettyOffset}) $timezone";
        }

        return $timezoneList;
    }
}

if (!function_exists('tomorrow')) {
    /**
     * Carbon instance of tomorrow, similar to `today()`
     *
     * @return \Carbon\Carbon
     */
    function tomorrow() : \Carbon\Carbon
    {
        return \Carbon\Carbon::today()->addDay();
    }
}

if (!function_exists('yesterday')) {
    /**
     * Carbon instance of yesterday, similar to `today()`
     *
     * @return \Carbon\Carbon
     */
    function yesterday() : \Carbon\Carbon
    {
        return \Carbon\Carbon::today()->subDay();
    }
}

if (!function_exists('seconds2minutes')) {
    /**
     * Displays amount of given seconds in minutes like m:s
     *
     * @param int $seconds
     * @return string
     */
    function seconds2minutes(int $seconds) : string
    {
        $minutes = floor($seconds/MINUTE_IN_SECONDS);
        $secondsleft = $seconds%MINUTE_IN_SECONDS;
        if ($minutes < 10) {
            $minutes = '0' . $minutes;
        }
        if ($secondsleft < 10) {
            $secondsleft = '0' . $secondsleft;
        }
        return $minutes . ':' . $secondsleft;
    }
}

if (!function_exists('diff_in_days')) {
    /**
     * Difference in days
     *
     * @param  mixed $start
     * @param  mixed $end
     * @return null|int
     */
    function diff_in_days($start, $end) : ?int
    {
        $carbonFqcns = ['Carbon\Carbon', 'Illuminate\Support\Carbon'];

        if (is_object($start) && in_array(get_class($end), $carbonFqcns)) {
            $startC = $start;
        } elseif (is_string($start)) {
            try {
                $startC = \Carbon\Carbon::parse($start);
            } catch (\Exception $e) {
                return null;
            }
        } else {
            return null;
        }

        if (is_object($end) && in_array(get_class($end), $carbonFqcns)) {
            $endC = $end;
        } elseif (is_string($end)) {
            try {
                $endC = \Carbon\Carbon::parse($end);
            } catch (\Exception $e) {
                return null;
            }
        } else {
            return null;
        }

        return $startC->diffInDays($endC);
    }
}
