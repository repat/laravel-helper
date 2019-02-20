<?php

if (!function_exists('morph_map')) {
    /**
     * Returns Laravels MorphMap set in `AppServiceProvider`
     *
     * @return array
     */
    function morph_map() : array
    {
        return \Illuminate\Database\Eloquent\Relations\Relation::morphMap();
    }
}

if (!function_exists('morph_map_key')) {
    /**
     * Returns short version of $fqcn class
     * (Reverse search in morphMap)
     *
     * @param  string $fqcn
     * @return null|string
     */
    function morph_map_key(string $fqcn) : ?string
    {
        $morphMap = morph_map();
        $key = array_search($fqcn, $morphMap);
        return $key === false ? null : $key;
    }
}

if (!function_exists('object2array')) {
    /**
     * Transforms an object into an array
     *
     * @param  object|array $stdClassObject
     * @return array
     */
    function object2array($stdClassObject) : array
    {
        $array = [];
        $_array = is_object($stdClassObject) ? get_object_vars($stdClassObject) : $stdClassObject;
        foreach ($_array as $key => $value) {
            $value = is_array($value) || is_object($value) ? object2array($value) : $value;
            $array[$key] = $value;
        }
        return $array;
    }
}
