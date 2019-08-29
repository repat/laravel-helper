<?php
/*
|--------------------------------------------------------------------------
| Misc
|--------------------------------------------------------------------------
*/

if (! defined('PARETO_HIGH')) {
    /**
     * Pareto Principle/Distribution aka 80/20 rule
     * @var int
     */
    define('PARETO_HIGH', 80);
}

if (! defined('PARETO_LOW')) {
    /**
     * Pareto Principle/Distribution aka 80/20 rule
     * @var int
     */
    define('PARETO_LOW', 20);
}

if (! defined('MARIADB_DEFAULT_STRLEN')) {
    /**
     * MariaDB (or older MySQL) default String Length
     * https://laravel-news.com/laravel-5-4-key-too-long-error
     *
     * @var int
     */
    define('MARIADB_DEFAULT_STRLEN', 191);
}

if (! defined('MULTIPLE_TRANS')) {
    /**
     * Minimum for trans_choice() to trigger the plural version
     *
     * @var int
     */
    define('MULTIPLE_TRANS', 2); // at least 2 is multiple
}

if (! defined('ONE_HUNDRED_PERCENT')) {
    /**
     * To avoid 100 being a Magic Number
     *
     * @var int
     */
    define('ONE_HUNDRED_PERCENT', 100);
}

if (! defined('NBSP')) {
    /**
     * Non-Breaking Space, hard to spot invisible char
     * @var string
     */
    define('NBSP', "\xc2\xa0");
}

/*
|--------------------------------------------------------------------------
| Networking
|--------------------------------------------------------------------------
*/

if (! defined('HTTP_1_0_VERBS')) {
    /**
     * HTTP 1.0 Verbs (rfc1945)
     * @var array
     */
    define('HTTP_1_0_VERBS', ['get', 'head', 'post']);
}

if (! defined('HTTP_1_1_VERBS')) {
    /**
     * HTTP 1.1 Verbs (rfc2616)
     * @var array
     */
    define('HTTP_1_1_VERBS', array_merge(HTTP_1_0_VERBS, ['connect', 'delete', 'options', 'put', 'trace']));
}

if (! defined('HTTP_VERBS')) {
    /**
     * All HTTP Verbs including PATCH (rfc5789)
     * @var array
     */
    define('HTTP_VERBS', array_merge(HTTP_1_1_VERBS, ['patch']));
}

if (! defined('HTTP_VERBS_LARAVEL')) {
    /**
     * All HTTP Verbs Laravel understand in a routes
     * @var array
     */
    define('HTTP_VERBS_LARAVEL', array_merge(HTTP_1_0_VERBS, ['all', 'delete', 'options', 'put']));
}

if (! defined('WEAK_CIPHERS')) {
    /**
     * Ciphers that should not be used
     * @var array
     */
    define('WEAK_CIPHERS', [
        'TLS_DHE_RSA_WITH_AES_256_GCM_SHA384',
        'TLS_DHE_RSA_WITH_AES_256_CBC_SHA256',
        'TLS_DHE_RSA_WITH_AES_256_CBC_SHA',
        'TLS_DHE_RSA_WITH_CAMELLIA_256_CBC_SHA',
        'TLS_DHE_RSA_WITH_CAMELLIA_128_CBC_SHA',
        'TLS_DHE_RSA_WITH_AES_128_CBC_SHA256',
        'TLS_DHE_RSA_WITH_AES_128_CBC_SHA',
        'TLS_DHE_RSA_WITH_AES_128_GCM_SHA256',
        'TLS_DHE_RSA_WITH_3DES_EDE_CBC_SHA',
        'SSL_DHE_RSA_WITH_AES_128_CBC_SHA',
        'SSL_DHE_RSA_WITH_AES_256_CBC_SHA',
        'SSL_DHE_RSA_WITH_CAMELLIA_256_CBC_SHA',
        'SSL_DHE_RSA_WITH_CAMELLIA_128_CBC_SHA',
        'SSL_DHE_RSA_WITH_3DES_EDE_CBC_SHA'
    ]);
}
/*
|--------------------------------------------------------------------------
| Regex
|--------------------------------------------------------------------------
*/

if (! defined('REGEX_WORD_BOUNDARY')) {
    /**
     * Word boundry
     * @var string
     */
    define('REGEX_WORD_BOUNDARY', '\b');
}

if (! defined('REGEX_IMG_BASE64_SRC')) {
    /**
     * String to parse a base64 encoded inline image
     * @var string
     */
    define('REGEX_IMG_BASE64_SRC', '/src=\"data:image\/([a-zA-Z]*);base64,([^\"]*)\"/');
}

if (! defined('REGEX_IMG_BASE64_REPLACE')) {
    /**
     * String to replace a base64 encoded inline image
     * @var string
     */
    define('REGEX_IMG_BASE64_REPLACE', '/src=(\"data:image\/[a-zA-Z]*;base64,[^\"]*)\"/');
}

if (! defined('REGEX_FIRST_RESULT_KEY')) {
    /**
     * Key for the first result of `preg_match_all`
     * @var int
     */
    define('REGEX_FIRST_RESULT_KEY', 1);
}
/*
|--------------------------------------------------------------------------
| Operating Systems
|--------------------------------------------------------------------------
*/

if (! defined('MACOS')) {
    /**
     * Operating System: MacOS(Darwin)
     * @var string
     */
    define('MACOS', 'macos');
}

if (! defined('WINDOWS')) {
    /**
     * Operating System: Windows
     * @var string
     */
    define('WINDOWS', 'windows');
}

if (! defined('LINUX')) {
    /**
     * Operating System: Linux
     * @var string
     */
    define('LINUX', 'linux');
}

if (! defined('BSD')) {
    /**
     * Operating System: BSD
     * @var string
     */
    define('BSD', 'bsd');
}

/*
|--------------------------------------------------------------------------
| Hex Colors
|--------------------------------------------------------------------------
*/

if (! defined('HEX_RED')) {
    /**
     * Hex Color for red
     * @var string
     */
    define('HEX_RED', '#ff0000');
}

if (! defined('HEX_GREEN')) {
    /**
     * Hex Color for red
     * @var string
     */
    define('HEX_GREEN', '#00ff00');
}

if (! defined('HEX_BLUE')) {
    /**
     * Hex Color for red
     * @var string
     */
    define('HEX_BLUE', '#0000ff');
}

if (! defined('HEX_WHITE')) {
    /**
     * Hex Color for red
     * @var string
     */
    define('HEX_WHITE', '#ffffff');
}

if (! defined('HEX_BLACK')) {
    /**
     * Hex Color for red
     * @var string
     */
    define('HEX_BLACK', '#000000');
}
