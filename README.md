# laravel-helper
[![Latest Version on Packagist](https://img.shields.io/packagist/v/repat/laravel-helper.svg?style=flat-square)](https://packagist.org/packages/repat/laravel-helper)
[![Total Downloads](https://img.shields.io/packagist/dt/repat/laravel-helper.svg?style=flat-square)](https://packagist.org/packages/repat/laravel-helper)

**laravel-helper** is a package full of helper functions I found useful when developing applications with Laravel. All functions are wrapped with a `functions_exists()` in case of conflicts.

Also have a look at
* https://laravel.com/docs/5.7/helpers
* http://calebporzio.com/11-awesome-laravel-helper-functions/
* https://packagist.org/packages/illuminated/helper-functions

Ideas what should go in here? Write a pull request or email!

## Installation
`$ composer require repat/laravel-helper`

## Documentation

### Array
#### `array_equal($arr1, $arr2)`
Determines if 2 arrays have the same items, independent of order.
```php
$arr1 = [1, 2, 3];
$arr2 = [3, 2, 1];

array_equal($arr1, $arr2);
// returns: true

$arr3 = [4, 5, 6];
array_equal($arr1, $arr3);
// returns: false
```

#### `array_key2value($array)`
Returns an array where key == value. Syntactic sugar for  `array_combine($array, $array);`
```php
$array = [1, 3, 5];

print_r(array_key2value($array));
// returns: Array( [1] => 1, [3] => 3, [5] => 5 )
```

#### `array_delete_value($array, $value)`
Deletes all elements from `$array` that have value `$value`. Essentially syntactic sugar for `array_diff()`.

```php
$array = ['foo', 'bar'];

print_r(array_delete_value($array, 'foo'));
// returns  Array( [1] => "bar" )
```

#### `contains_duplicates($array)`
Checks if there are duplicates in given array.

```php
contains_duplicates([1, 1]);
// returns: true
contains_duplicates([1, 2]);
// returns: false
```

### Database
#### `mysql_headers($table, $assoc = false)`
Returns an array of MySQL headers/columns or empty array in case of an error. If the second parameter is set `true` (default is `false`) it returns an associative array.

```php
print_r(mysql_headers("test_table"));
// returns: Array( [0] => head1, [1] => head2 )

print_r(mysql_headers("test_table", $assoc = true));
// returns: Array( [head1] => head1, [head2] => head2)
```

#### `table_headers($model)`
Returns the database table headers, similar to `mysql_headers()`, but based on an object of a Eloquent Model.

```php
use App\Models\User;

$user = User::first();

print_r(table_headers($user));
// returns: Array( 1 => id, 2 => name, ...)
```

#### `print_db_session($table = 'sessions')`
`print_r()` the session of current user.

```php
print_db_session();
// returns:
// Array
// (
//     [_token] => 7Au0aYkJVxQVA3xQBfdJwKNaWxUv0UVJKublCqMn
//     [locale] => en
//     ...
// )
```

#### `get_free_slug($toSlug, $field, $fqcn, $id, $pk)`
Returns a unique slug for an Eloquent Model given the following parameters:

* `$toSlug`: suggestion for the slug
* `$field`: name of the database field, usually `slug`
* `$fqcn`: Fully qualified class name of Eloquent Model
* `$id`: id to exclude (e.g. it's own on update)
* `$pk`: primary key of the database table, defaults to `id`

Will append a number if `$toSlug` is already taken.

```php
use App\Model\User;

$user = User::first();

$user->id;
// returns: 1
$user->slug;
// returns: foobar

get_free_slug('foobar', 'slug', User::class, 1, 'id');
// returns: foobar1
```

### Date
#### `days_in_month($month = null, $year = null)`
Returns amount of days in given month or year. Defaults to current month and year.

```php
days_in_month();
// returns: 31 (for e.g. May)

days_in_month($april = 4);
// returns: 30

days_in_month($feb = 2, $year = 2020);
// returns: 29 (2020 is a leap year)
```

#### `days_this_month()`
Returns amount of days of the current month.

```php
days_this_month();
// returns: 31 (for e.g. May)
```

#### `days_next_month()`
Returns amount of days of the next month.

```php
days_next_month();
// returns: 30 (for e.g. May because June has 30)
```

#### `days_this_year()`
Returns amount of days of the current year.

```php
days_this_year();
// returns: 365 (because it's not a leap year)
```

#### `days_left_in_month()`
Returns amount of days left in current month.

```php
days_left_in_month();
// returns: 29 (on 1st April)
```

#### `days_left_in_year()`
Returns amount of days left in current year.

```php
days_left_in_year();
// returns: 274 (on 1st April 2019)
```

#### `timezone_list()`
Returns a list of all timezones.

```php
timezone_list();
// returns:
// [
// "Pacific/Pago_Pago" => "(UTC-11:00) Pacific/Pago_Pago",
// "Pacific/Niue" => "(UTC-11:00) Pacific/Niue",
// "Pacific/Midway" => "(UTC-11:00) Pacific/Midway",
// ...
// "Pacific/Chatham" => "(UTC+13:45) Pacific/Chatham",
// "Pacific/Kiritimati" => "(UTC+14:00) Pacific/Kiritimati",
// "Pacific/Apia" => "(UTC+14:00) Pacific/Apia",
// ];
```

#### `tomorrow()`
Similar to `today()` or `now()`, this function returns a Carbon instance for tomorrow.

```php
tomorrow();
// returns: Carbon\Carbon @1554156000 {#5618
//     date: 2019-04-20 00:00:00.0 Europe/Amsterdam (+02:00),
//   }
```

#### `seconds2minutes($seconds)`
Returns `i:s` string with 60+ minutes instead of showing the hours as well.

```php
seconds2minutes(42);
// returns: 00:42

seconds2minutes(90);
// returns: 01:30

seconds2minutes(4223);
// returns: 70:23
```

### Object

#### `morph_map()`
Returns the morphMap from `AppServiceProvider` set with `Relation::morphMap()`.

```php
morph_map();
// returns:Array
// (
//     [user] => App\Models\User
// )
```

#### `morph_map_key($fqcn)`
Reverse lookup for a class in the morphMap of the `AppServiceProvider` set with `Relation::morphMap()`.

```php
use App\Models\User;

morph_map_key(User::class);
// returns: 'user'
```

#### `object2array($object)`
Array representation of an object, e.g. an Eloquent Model.

```php
use App\Models\User;

object2array(User::first());
// returns: [
//      "casts" => [
//        "someday_at" => "datetime",
//       // ...
//      ],
//      "incrementing" => true,
//      "exists" => true,
//      "wasRecentlyCreated" => false,
//      "timestamps" => true,
// ]
```

#### `cache_get_or_add($key, $callable)`
Returns Cache for given key or adds the return value from the callable to the cache and then returns it.

```php
use App\Models\Post;

$posts = cache_get_or_add('posts', function() {
    return Post::orderBy('created_at', 'desc')->get();
});
```

### Misc
#### `toggle($switch)`
If given `true`, returns `false` and vice-versa.

```php
toggle(false);
// returns: true

toggle(true);
// returns: false
```

#### `generate_password($size = 15)`
Returns a random password. Syntactic sugar for `str_random()`.

```php
generate_password();
// returns: IZeJx3MeUdDhzE2
```

#### `auto_cast($value)`
Returns the value with the right type so e.g. you can compare type safe with `===`.

```php
gettype(auto_cast('42'));
// returns: integer
gettype(auto_cast('42.0'));
// returns: double
gettype(auto_cast('true'));
// returns: boolean
```

#### `human_filesize($size)`
Returns a human readable form for given bytes. Goes up to [Yottabyte](https://en.wikipedia.org/wiki/Yottabyte).

```php
human_filesize(4223);
// returns: 4.12kB
```

#### `permutations($array)`
Returns a generator with all possible permutations of given array values.

Based on [eddiewoulds port](https://stackoverflow.com/a/43307800/2517690) port of [python code](https://docs.python.org/2/library/itertools.html#itertools.permutations).

```php
$gen = permutations(['foo', 'bar', 'biz']);

iterator_to_array($gen)
// returns: [
   //   [
   //     "foo",
   //     "bar",
   //     "biz",
   //   ],
   //   [
   //     "foo",
   //     "biz",
   //     "bar",
   //   ],
   //   [
   //     "bar",
   //     "foo",
   //     "biz",
   //   ],
   //   [
   //     "bar",
   //     "biz",
   //     "foo",
   //   ],
   //   [
   //     "biz",
   //     "foo",
   //     "bar",
   //   ],
   //   [
   //     "biz",
   //     "bar",
   //     "foo",
   //   ],
   // ]
```

#### `zenith($type)`
Wrapper around magic numbers for the [Zenith](https://en.wikipedia.org/wiki/Zenith). The types can be:

* `astronomical`: 108.0
* `nautical`: 102.0
* `civil`: 96.0
* default: 90+50/60 (~90.83)

```php
zenith('civil');
// returns: 96.0
```

#### `operating_system()`
Returns on of the following constants (also see under constants):

* `macos`
* `windows`
* `linux`
* `bsd`

```php
operating_system();
// returns: linux
LINUX
// returns: linux
```

### Networking
#### `route_path($path)`
Get the path to the Laravel routes folder, similar to `app_path()`, see [Helpers Documentation](https://laravel.com/docs/5.8/helpers). It will append `$path` but it's not mandatory.

```php
route_path();
// returns: /var/www/htdocs/laravel/routes

route_path('web.php');
// returns: /var/www/htdocs/laravel/routes/web.php
```

#### `named_routes($path, $verb)`
Returns array of all named routes in a routes file or `null` on error. It's possible to pass an HTTP verb/method defined in `HTTP_VERBS_LARAVEL` (see below).

```php
named_routes('/var/www/htdocs/laravel/routes/web.php');
// returns: [
// 'laravel.get'
// 'laravel.post'
// ]

named_routes('/var/www/htdocs/laravel/routes/web.php', 'get');
// returns: [
// 'laravel.get'
// ]
```

#### `scrub_url($url)`
Removes the protocol, www and trailing slashes from a URL. You can then e.g. test HTTP vs. HTTPS connections.

```php
scrub_url('https://www.repat.de/');
// returns: 'repat.de'

scrub_url('https://blog.fefe.de/?ts=a262bcdf');
// returns: 'blog.fefe.de/?ts=a262bcdf'
```

#### `http_status_code($url)`
Returns just the status code by sending an empty request with [curl](https://curl.haxx.se/). Follows redirect so it will only return the last status code and not e.g. 301 Redirects. Requires `ext-curl`.

```php
http_status_code('httpstat.us/500');
// returns: 500

http_status_code('http://repat.de'); // with 301 redirect to https://repat.de
// returns: 200
```

#### `parse_signed_request($request, $clientSecret, $algo)`
Parses a HMAC signed request. Copied from [Data Deletion Request Callback - Facebook for Developers](https://developers.facebook.com/docs/apps/delete-data). `$algo` defaults to `sha256`.

```php
$requestString = null; // TODO
parse_signed_request($requestString, env('FACEBOOK_CLIENT_SECRET'));
```

#### `domain_slug($domain)`
Validates a domain and creates a slug. Does not work for subdomains, see `sluggify_domain()` instead. Returns `null` on a parsing error.

```php
domain_slug('blog.fefe.de')
//returns: blogfefede
domain_slug('blogfefe.de')
//returns: blogfefede
```

##### `current_route_name()`
If the current route has a name, otherwise return `null`.

```php
// in routes/web.php
// Route::name('dev.foo')->get('foo', 'Dev\TestController@foo');
// Route::get('bar', 'Dev\TestController@bar');

// in Dev/TestController@foo
current_route_name();
// returns: dev.foo

// in Dev/TestController@foo
current_route_name();
// returns: null
```

### String
#### `str_icontains($haystack, $needle)`
Similar to [Str::contains()](https://laravel.com/docs/5.7/helpers#method-str-contains) but case _insensitive_.

```php
str_icontains('FOOBAR', 'foo');
// returns: true

str_icontains('foobar', 'foo');
// returns: true

str_icontains('foobar', 'FOO');
// returns: true

str_icontains('foobar', 'test');
// returns: false
```

#### `to_ascii($string)`
Removes all non [ASCII](https://en.wikipedia.org/wiki/ASCII) characters and returns the rest.

```php
to_ascii('René');
// returns: Ren
```

#### `hyphen2_($string)`
Replaces all hyphen ("-") characters with underscore ("\_")

```php
hyphen2_('foo-bar');
// returns: foo_bar
```

#### `_2hypen($string)`
Replaces all underscore ("\_") characters with hyphen ("-")

```php
hyphen2_('foo_bar');
// returns: foo-bar
```

#### `str_replace_once($search, $replace, $string)`
Same signature as `str_replace()`, but as name suggests, replaces only the first occurrence of `$search`.

```php
str_replace_once('foo', 'bar', 'foofoo');
// returns: 'barfoo'
```

#### `title_case_wo_underscore($string)`
[Title Case](https://en.wikipedia.org/wiki/Letter_case#Title_case) but without underscores.

```php
title_case_wo_underscore('foo_bar');
// returns: Foo Bar

// vs.
// title_case('foo_bar')
// returns: Foo_Bar
```

#### `lorem_ipsum()`
Returns an example of the [Lorem Ipsum](https://en.wikipedia.org/wiki/Lorem_ipsum) placeholder text.

```php
lorem_ipsum();
// returns:
// Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
```

#### `sluggify_domain($domain)`
Returns a slug version of the domain by exchanging full stops with underscores. `str_slug()` does not work with subdomains, as it removes full stops completely.

```php
sluggify_domain('blog.fefe.de');
// returns: blog_fefe_de
str_slug('blog.fefe.de');
// returns: blogfefede

sluggify_domain('blogfefe.de');
// returns: blogfefe_de
str_slug('blogfefe.de');
// returns: blogfefede // same as subdomain on fefe.de
```

#### `str_remove($string, $remove)`
Removes given string(s), numbers or array of strings. Syntactic sugar for `str_replace($remove, '', $string)`.

```php
str_remove('foobar', 'bar');
// returns: foo
str_remove('foobar42', ['foo', 'bar']);
// returns: 42
str_remove('foobar42', 42);
// returns: foobar
```

#### `str_bytes($string)`
Returns the amount of bytes in a string.

```php
str_bytes('foobar');
// returns: 6
str_bytes('fooßar');
// returns: 8
```

#### `regex_list($array)`
Creates a string with regex for an OR separated list.

```php
regex_list(['foo', 'bar', '42'])
// returns: \bfoo|\bbar|\b42
```

#### `base64_url_decode($url)`
Decodes a base64-encoded URL. Copied from [Data Deletion Request Callback - Facebook for Developers](https://developers.facebook.com/docs/apps/delete-data)

```php
base64_url_decode('aHR0cHM6Ly9yZXBhdC5kZQ==');
// returns: https://repat.de
```

#### `str_right($string, $until)`
Substring from the right until given string, see also `str_left()`. Will return the input string if `$until` is not present.

```php
str_right('https://vimeo.com/165053513', '/');
// returns: 165053513
```

#### `str_left($string, $before)`
Syntactic sugar for [`str_before`](https://laravel.com/docs/5.8/helpers#method-str-before) to be consistent with `str_right()`.

### Optional Packages
Optional packages suggested by this are required for these functions to work.

#### `markdown2html($markdown)`
Uses [league/commonmark](https://commonmark.thephpleague.com/) to transform Markdown into HTML.

* `$ composer require league/commonmark`

```php
markdown2html('# Header');
// returns: <h1>Header</h1>\n
```

#### `translated_attributes($fqcn)`
Uses [dimsav/laravel-translatable](https://github.com/dimsav/laravel-translatable) and Reflection to get the `translatedAttributes` attribute of a Model.

* `$ composer require dimsav/laravel-translatable`

```php
use App\Models\Product;

translated_attributes(Product::class);
// returns: ['title', 'description'];
```

#### `domain($url)`
Uses [layershifter/tld-extract](https://github.com/layershifter/tld-extract) to return the domain only from a URL, removing protocol, subdomain and path.

* `$ composer require layershifter/tld-extract`

```php
domain('https://repat.de/about?foo=bar');
// returns: repat.de
```

### HTML
#### `linkify($string, $protocols = ['http', 'https', 'mail'], $attributes)`
Returns the string with all URLs for given protocols made into links. Optionally, attributes for the [a tag](https://www.w3.org/TR/html4/struct/links.html) can be passed.

```php
linkify('https://google.com is a search engine');
// returns: <a  href="https://google.com">google.com</a> is a search engine

linkify('https://google.com is a search engine', ['https'], ['target' => '_blank']);
// returns: <a target="_blank" href="https://google.com">google.com</a> is a search engine
```

#### `embedded_video_url($url)`
Returns the embedded version of a given [YouTube](https://youtube.com) or [Vimeo](https://vimeo.com) URL.

```php
embedded_video_url('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
// returns: https://www.youtube.com/embed/dQw4w9WgXcQ

embedded_video_url('https://vimeo.com/50491748');
// returns: https://player.vimeo.com/video/50491748
```

#### `ul_li_unpack($array, $separator)`
Unpacks an associated array into an [unordered list](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/ul). Default separator is `:`.

```php
ul_li_unpack(['foo' => 'bar']);
// returns: <ul><li>foo: bar</li></ul>

ul_li_unpack(['foo' => 'bar'], '=>');
// returns: <ul><li>foo=> bar</li></ul>
```

#### `extract_inline_img($text, $storagePath, $srcPath, $optimize)`
Extracts an inline image from a text, saves it on the harddrive and puts in the filename with the [src](https://developer.mozilla.org/de/docs/Web/HTML/Element/img) attribute. Can use the [spatie/laravel-image-optimizer](https://github.com/spatie/laravel-image-optimizer) to optimize images after upload but it's disabled by default.

* `$ composer require spatie/laravel-image-optimizer`

```php
extract_inline_img("<img src='data:image/jpeg;base64,...>", '/var/www/htdocs/laravel/storage/foobar', 'public/images', true);
// returns: <img src="public/images/fj3209fjew93.jpg">
```

### Constants
* `DAYS_PER_YEAR`: 365
* `PARETO_HIGH`: 80
* `PARETO_LOW`: 20
* `MARIADB_DEFAULT_STRLEN`: 191
* `HTTP_1_0_VERBS`: [get, head, post]
* `HTTP_1_1_VERBS`: [get, head, post, connect, delete, options, put, trace]
* `HTTP_VERBS`: [get, head, post, connect, delete, options, put, trace, patch]
* `HTTP_VERBS_LARAVEL`: [all, get, head, post, delete, options, put, patch]
* `REGEX_WORD_BOUNDARY`: \\b
* `REGEX_IMG_BASE64_SRC`: Regular Expression used to find a base64 encoded image in HTML text
* `REGEX_IMG_BASE64_REPLACE`: Regular Expression used to replace a base64 encoded image in HTML text
* `REGEX_FIRST_RESULT_KEY`: 1
* `MACOS`: macos
* `WINDOWS`: windows
* `LINUX`: linux
* `BSD`: bsd

## Contributors
* https://github.com/bertholf

## License
* MIT, see [LICENSE](https://github.com/repat/laravel-helper/blob/master/LICENSE)

## Version
* Version 0.1.24

## Contact
#### repat
* Homepage: https://repat.de
* e-mail: repat@repat.de
* Twitter: [@repat123](https://twitter.com/repat123 "repat123 on twitter")

[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=repat&url=https://github.com/repat/laravel-helper&title=laravel-helper&language=&tags=github&category=software)
