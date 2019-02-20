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
