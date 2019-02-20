<?php

if (!function_exists('days_this_month')) {
    /**
     * How many days are in current month (28/29/30/31)
     *
     * @return int
     */
    function days_this_month() : int
    {
        return cal_days_in_month(CAL_GREGORIAN, now()->month, now()->year);
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
        return date('L') == 1 ? DAYS_PER_YEAR+1 : DAYS_PER_YEAR;
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
