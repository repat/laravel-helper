<?php

if (!function_exists('http_status_code')) {
    /**
     * Get only HTTP(S) status code for a URL
     *
     * @param string $url
     * @return int|bool
     */
    function http_status_code(string $url)
    {
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($handle, CURLOPT_HEADER, true);
        curl_setopt($handle, CURLOPT_NOBODY, true);
        $response = curl_exec($handle);
        return curl_getinfo($handle, CURLINFO_HTTP_CODE);
    }
}
