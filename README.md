# laravel-helper

Some Helper functions I found useful when developing applications with Laravel.

### Helper::getMySQLHeaders($table, $assoc)
Returns an array of MySQL headers/columns or false in case of an error. If the second parameter is set `true` (default is `false`) it returns an associative array.

```php
print_r(Helper::getMySQLHeaders("test_table");

// returns: Array( [0] => head1, [1] => head2 )


// const ASSOC_ARRAY = true in Helper.php

print_r(Helper::getMySQLHeaders("test_table", Helper::ASSOC_ARRAY);

// returns: Array( [head1] => head1, [head2] => head2 )
```
