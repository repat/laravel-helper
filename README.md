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

### Date
#### `days_in_month($month, $year)`
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

### Object

#### `morph_map()`
Returns the morphMap from ApplicationServiceProvider.

```php
morph_map();
// returns:Array
// (
//     [user] => App\Models\User
// )
```

#### `morph_map_key($fqcn)`
Reverse lookup for a class in the morphMap of the ApplicationServiceProvider.

```php
use App\Models\User;

morph_map_key(User::class);
// returns: 'user'
```

### Misc
#### `togggle($switch)`
If given true, returns false and vice-versa.

```php
toggle(false);
// returns: true

toggle(true);
// returns: false
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
//
str_icontains('foobar', 'test');
// returns: false
```

#### `lorem_ipsum()`
Returns an example of the [Lorem Ipsum](https://en.wikipedia.org/wiki/Lorem_ipsum) placeholder text.

```php
lorem_ipsum();
// returns:
// Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
```

## Undocumented
### database
* `print_db_session()`
* `get_free_slug()`

### html
* `linkify()`
* `embedded_video_url()`
* `extract_inline_img()`
* `ul_li_unpack()`

### misc
* `human_filesize()`
* `generate_password()`
* `zenith()`
* `permutations()`
* `auto_cast()`
* `operating_system()`

### networking
* `http_status_code()`
* `domain_slug()`
* `scrub_url()`
* `parse_signed_request()`

### object
* `object2array()`
* `cache_get_or_add()`

### optional packages
* `markdown2html()`
* `translated_attributes()`

### string
* `str_bytes()`
* `str_replace_once()`
* `title_case_wo_underscore()`
* `hyphen2_()`
* `_2hypen()`
* `regex_list()`
* `to_ascii()`
* `base64_url_decode()`

## Contributors
* https://github.com/bertholf

## License
* MIT, see [LICENSE](https://github.com/repat/laravel-helper/blob/master/LICENSE)

## Version
* Version 0.1.16

## Contact
#### repat
* Homepage: https://repat.de
* e-mail: repat@repat.de
* Twitter: [@repat123](https://twitter.com/repat123 "repat123 on twitter")

[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=repat&url=https://github.com/repat/laravel-helper&title=laravel-helper&language=&tags=github&category=software)
