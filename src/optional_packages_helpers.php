<?php
if (!function_exists('translated_attributes')) {
    /**
     * Uses Reflection to get the translated attributes of
     * `astrotomic/laravel-translatable` Models
     *
     * @param string $fqcn
     * @return array
     */
    function translated_attributes(string $fqcn) : array
    {
        $reflect = new \ReflectionClass($fqcn);
        $reflectionObj = $reflect->getProperty('translatedAttributes');
        return $reflectionObj->getValue(app()->make($fqcn));
    }
}
