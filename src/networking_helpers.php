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

if (!function_exists('domain_slug')) {
    /**
     * Gets hostname for full URL in a slug-friendly way
     *
     * @param string $domain
     * @return string|null
     */
    function domain_slug(string $domain) : ?string
    {
        // Trim slashes
        $url = trim($domain, '/');

        // if scheme not included, prepend it
        if (!preg_match('#^http(s)?://#', $url)) {
            $url = 'http://' . $url;
        }

        $urlParts = parse_url($url);

        // If parsing worked, str_slug() on host part of URL
        if ($urlParts !== false && !empty($urlParts)) {
            $domain = preg_replace('/^www\./', '', $urlParts['host']); // Remove www

            return str_slug($domain);
        }

        // something went wrong parsing
        return null;
    }
}

if (!function_exists('scrub_url')) {
    /**
     * Removes protocols, subdomains and slashes from URL
     *
     * @param string $url
     * @return string
     */
    function scrub_url(string $url) : string
    {
        $url = strtolower($url); // lowercase
        $url = trim($url, '/'); // Remove slashes
        $url = preg_replace('#^https?://#', '', $url); // Remove Scheme
        $url = preg_replace('/^www\./', '', $url); // Remove www

        return $url;
    }
}

if (!function_exists('parse_signed_request')) {
    /**
     * Parses a sha256 signed request JSON into array
     * Source: https://developers.facebook.com/docs/apps/delete-data
     *
     * @param  string $signedRequest
     * @param  string $secret
     * @param  string $algo
     * @return array
     */
    function parse_signed_request(string $signedRequest, string $secret, string $algo = 'sha256') : array
    {
        list($encodedSig, $payload) = explode('.', $signedRequest, 2);

        // decode the data
        $sig = base64_url_decode($encodedSig);
        $data = json_decode(base64_url_decode($payload), JSON_OBJECT_AS_ARRAY);

        // confirm the signature
        $expectedSig = hash_hmac($algo, $payload, $secret, $raw = true);
        if ($sig !== $expectedSig) {
            // Bad Signed JSON signature
            return null;
        }

        return $data;
    }
}
