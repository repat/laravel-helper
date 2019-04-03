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
