<?php

/*
|--------------------------------------------------------------------------
| Dates
|--------------------------------------------------------------------------
*/

/**
 * Days in a normal year (not leap-year)
 * @var int
 */
define('DAYS_PER_YEAR', 365);

/*
|--------------------------------------------------------------------------
| Misc
|--------------------------------------------------------------------------
*/

/**
 * Pareto Principle/Distribution aka 80/20 rule
 * @var int
 */
define('PARETO_HIGH', 80);

/**
 * Pareto Principle/Distribution aka 80/20 rule
 * @var int
 */
define('PARETO_LOW', 20);

/*
|--------------------------------------------------------------------------
| Networking
|--------------------------------------------------------------------------
*/

/**
 * HTTP 1.0 Verbs (rfc1945)
 * @var array
 */
define('HTTP_1_0_VERBS', ['get', 'head', 'post']);

/**
 * HTTP 1.1 Verbs (rfc2616)
 * @var array
 */
define('HTTP_1_1_VERBS', array_merge(HTTP_1_0_VERBS, ['connect', 'delete', 'options', 'put', 'trace']));

/**
 * All HTTP Verbs including PATCH (rfc5789)
 * @var array
 */
define('HTTP_VERBS', array_merge(HTTP_1_1_VERBS, ['patch']));

/**
 * All HTTP Verbs Laravel understand in a routes
 * @var array
 */
define('HTTP_VERBS_LARAVEL', array_merge(HTTP_1_0_VERBS, ['all', 'delete', 'options', 'put']));

/*
|--------------------------------------------------------------------------
| Regex
|--------------------------------------------------------------------------
*/

/**
 * Word boundry
 * @var string
 */
define('REGEX_WORD_BOUNDARY', '\b');

/**
 * String to parse a base64 encoded inline image
 * @var string
 */
define('REGEX_IMG_BASE64_SRC', '/src=\"data:image\/([a-zA-Z]*);base64,([^\"]*)\"/');

/**
 * String to replace a base64 encoded inline image
 * @var string
 */
define('REGEX_IMG_BASE64_REPLACE', '/src=(\"data:image\/[a-zA-Z]*;base64,[^\"]*)\"/');

/**
 * Key for the first result of `preg_match_all`
 * @var int
 */
define('REGEX_FIRST_RESULT_KEY', 1);

/*
|--------------------------------------------------------------------------
| Operating Systems
|--------------------------------------------------------------------------
*/

/**
 * Operating System: MacOS(Darwin)
 * @var string
 */
define('MACOS', 'macos');

/**
 * Operating System: Windows
 * @var string
 */
define('WINDOWS', 'windows');

/**
 * Operating System: Linux
 * @var string
 */
define('LINUX', 'linux');

/**
 * Operating System: BSD
 * @var string
 */
define('BSD', 'bsd');
