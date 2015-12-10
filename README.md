# laravel-helper

Some Helper functions I found useful when developing applications with laravel but didn't get around to make so pretty, I could submit them as a pull request.

### Helper::str_wo_folders($str)

Removes folders from `/folder1/folder2/file.ext`

Example:

```php
echo Helper::str_wo_folders("/folder1/folder2/file.ext") // file.ext
```

### Helper::getMySQLHeaders($table, $assoc)
Returns an array of MySQL Headers/Columns or false in case of an error. If `$assoc` is set `true` it returns an associative array.

```php
print_r(Helper::getMySQLHeaders("test_table");

// Array( [0] => head1, [1] => head2 )

print_r(Helper::getMySQLHeaders("test_table", true);

// Array( [head1] => head1, [head2] => head2 )
```
