# laravel-helper

Some helper functions I found useful when developing applications with Laravel. All functions are wrapped with a `functions_exists()` in case of conflicts.

Also have a look at
* https://laravel.com/docs/5.7/helpers
* http://calebporzio.com/11-awesome-laravel-helper-functions/

## Array
### `array_equal($arr1, $arr2)`
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

### `array_key2value($array)`
Returns an array where key == value. Syntactic sugar for  `array_combine($array, $array);`
```php
$array = [1, 3, 5];

print_r(array_key2value($array));
// returns: Array( [1] => 1, [3] => 3, [5] => 5 )
```

## Database
### `mysql_headers($table, $assoc = false)`
Returns an array of MySQL headers/columns or empty array in case of an error. If the second parameter is set `true` (default is `false`) it returns an associative array.

```php
print_r(mysql_headers("test_table"));
// returns: Array( [0] => head1, [1] => head2 )

print_r(mysql_headers("test_table", $assoc = true));
// returns: Array( [head1] => head1, [head2] => head2)
```

## Undocumented in README
* `array_delete_value()`
* `human_filesize()`
* `http_status_code()`
* `object2array()`
* `str_icontains()`
* `str_replace_once()`
* `title_case_wo_underscore()`
* `hyphen2_`
* `_2hypen()`
* `regex_list()`
