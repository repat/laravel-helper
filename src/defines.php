<?php
/*
|--------------------------------------------------------------------------
| Networking
|--------------------------------------------------------------------------
*/

if (! defined('HTTP_VERBS_LARAVEL')) {
    /**
     * All HTTP Verbs Laravel understand in a routes
     * @var array
     */
    define('HTTP_VERBS_LARAVEL', array_merge(HTTP_1_0_VERBS, ['all', 'delete', 'options', 'put']));
}

/*
|--------------------------------------------------------------------------
| Regex
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| Misc
|--------------------------------------------------------------------------
*/

if (! defined('MULTIPLE_TRANS')) {
    /**
     * Minimum for trans_choice() to trigger the plural version
     *
     * @var int
     */
    define('MULTIPLE_TRANS', 2); // at least 2 is multiple
}
