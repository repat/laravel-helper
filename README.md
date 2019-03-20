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

### Database
#### `mysql_headers($table, $assoc = false)`
Returns an array of MySQL headers/columns or empty array in case of an error. If the second parameter is set `true` (default is `false`) it returns an associative array.

```php
print_r(mysql_headers("test_table"));
// returns: Array( [0] => head1, [1] => head2 )

print_r(mysql_headers("test_table", $assoc = true));
// returns: Array( [head1] => head1, [head2] => head2)
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

## Undocumented
### array
* `array_delete_value()`
* `contains_duplicates()`

### date
* `days_this_month()`
* `days_this_year()`
* `days_next_month()`
* `days_left_in_month()`
* `days_left_in_year()`
* `timezone_list()`

### database
* `print_db_session()`
* `get_free_slug()`

### html
* `linkify()`
* `embedded_video_url()`
* `extract_inline_img()`

### misc
* `human_filesize()`
* `generate_password()`
* `zenith()`
* `permutations()`
* `auto_cast()`
* `operating_system()`
* `toggle()`

### networking
* `http_status_code()`
* `domain_slug()`
* `scrub_url()`

### object
* `object2array()`
* `morph_map()`
* `morph_map_key()`

### optional packages
* `markdown2html()`
* `translated_attributes()`

### string
* `str_bytes()`
* `str_replace_once()`
* `title_case_wo_underscore()`
* `hyphen2_`
* `_2hypen()`
* `regex_list()`
* `to_ascii()`

## Contributors
* https://github.com/bertholf

## License
* MIT, see [LICENSE](https://github.com/repat/laravel-helper/blob/master/LICENSE)

## Version
* Version 0.1.12

## Contact
#### repat
* Homepage: https://repat.de
* e-mail: repat@repat.de
* Twitter: [@repat123](https://twitter.com/repat123 "repat123 on twitter")

[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=repat&url=https://github.com/repat/laravel-helper&title=laravel-helper&language=&tags=github&category=software)
