# laravel-helper

Some Helper functions I found useful when developing applications with laravel but didn't get around to make so pretty, I could submit them as a pull request.

### Helper::getStringWithoutFolder($str)

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

### Helper::files($folder) or Helper::getFilesFromFolder($folder)
Returns an array of files in a folder without "." and "..". It doesn't atter if the string ends on "/" in either method.
```php
print_r(Helper::files("/home/user/"));
// Array( [0] => file1.ext, [1] => file2.ext )

print_r(Helper::getFilesFromFolder("/home/user"));
// Array( [0] => file1.ext, [1] => file2.ext )
```

### Helper::getNumberOfRows($file)
Gets the amount of rows efficiently from a `SplFileObject`
```php
file_put_contents("example.txt", "first \nsecond \nthird");
echo Helper::getNumberOfRows(new SplFileObject("example.txt"));
// 3
```
