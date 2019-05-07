<?php

if (!function_exists('array_equal')) {
    /**
     * Determines if 2 arrays are equal based on the serialized string representation
     * modified version from http://php.net/manual/de/function.array-diff.php
     *
     * @param  array $arr1
     * @param  array $arr2
     * @return bool
     */
    function array_equal(array $arr1, array $arr2) : bool
    {
        if (count($arr1) !== count($arr2)) {
            // shortcut
            return false;
        }

        sort($arr1); // sort before comparing because
        sort($arr2); // order doesn't play a role

        // serialize to get string representation
        $arrStr1 = serialize($arr1);
        $arrStr2 = serialize($arr2);

        return (strcmp($arrStr1, $arrStr2) === 0);
    }
}

if (!function_exists('array_key2value')) {
    /**
     * Creates a new array with Key == Value
     * Syntactic sugar for `array_combine($array, $array);`
     *
     * @param  array $array
     * @return array
     */
    function array_key2value(array $array) : array
    {
        return array_combine($array, $array);
    }
}

if (!function_exists('array_delete_value')) {
    /**
     * Deletes all elements from `$array` that have value `$value`
     * Syntactic sugar for `array_diff($array, [$value])`
     *
     * @param  array $array
     * @param  mixed $value
     * @return array
     */
    function array_delete_value(array $array, $value) : array
    {
        return array_diff($array, [$value]);
    }
}

if (!function_exists('contains_duplicates')) {
    /**
     * Check duplicate values in given array
     *
     * @param array $array
     * @return bool
     */
    function contains_duplicates(array $array) : bool
    {
        return (count(array_unique($array)) < count($array));
    }
}

if (!function_exists('array_change_keys')) {
    /**
     * Exchanges keys in given array
     *
     * Source: https://fellowtuts.com/php/change-array-key-without-changing-order/
     *
     * @param  array $array
     * @param  array $keys
     * @return array
     */
    function array_change_keys(array $array, array $keys) : array
    {
        $newArr = [];
        foreach ($array as $previousKey => $valueOrNextArray) {
            $key = array_key_exists($previousKey, $keys) ? $keys[$previousKey] : $previousKey;
            $newArr[$key] = is_array($valueOrNextArray) ? array_change_keys($valueOrNextArray, $keys) : $valueOrNextArray;
        }
        return $newArr;
    }
}

if (!function_exists('array_key_replace')) {
    /**
     * Changes old key to new key.
     * Only for one dimensional arrays.
     *
     * @param  array $array
     * @param  mixed $oldKey
     * @param  mixed $newKey
     * @return array
     */
    function array_key_replace(array $array, $oldKey, $newKey) : array
    {
        $array[$newKey] = $array[$oldKey];
        unset($array[$oldKey]);
        return $array;
    }
}
