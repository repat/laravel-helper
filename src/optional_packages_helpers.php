<?php

if (!function_exists('markdown2html')) {
    /**
     * Converts Markdown text into HTML code with `league/commonmark`
     *
     * @param  string $markdown
     * @return string
     */
    function markdown2html(string $markdown) : string
    {
        $converter = new \League\CommonMark\CommonMarkConverter;
        return $converter->convertToHtml($markdown);
    }
}

if (!function_exists('translated_attributes')) {
    /**
     * Uses Reflection to get the translated attributes of
     * `dimsav/laravel-translatable` Models
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
