# laravel-helper

### Helper::str_wo_folders($str)

Removes folders from `/folder1/folder2/file.ext`

Example:

```php
echo Helper::str_wo_folders("/folder1/folder2/file.ext") // file.ext
```

### Helper::getMySQLHeaders($table)
Returns an array of MySQL Headers/Columns or false in case of an error

```php
print_r(Helper::getMySQLHeaders("test_table");

// Array( [0] => head1, [1] => head2 )
```
