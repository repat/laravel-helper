# laravel-helper
[![Latest Version on Packagist](https://img.shields.io/packagist/v/repat/laravel-helper.svg?style=flat-square)](https://packagist.org/packages/repat/laravel-helper)
[![Total Downloads](https://img.shields.io/packagist/dt/repat/laravel-helper.svg?style=flat-square)](https://packagist.org/packages/repat/laravel-helper)

**laravel-helper** is a package full of helper functions I found useful when developing applications with Laravel. All functions are wrapped with a `functions_exists()` in case of conflicts.

Also have a look at
* https://laravel.com/docs/10.x/helpers
* http://calebporzio.com/11-awesome-laravel-helper-functions (abandoned?)
* https://packagist.org/packages/illuminated/helper-functions
* https://packagist.org/packages/laravel/helper-functions

Ideas what should go in here? Write a pull request or email!

## Installation

`$ composer require repat/laravel-helper`

## Documentation

> ⚠️ The majority of helper functions are now in repat/php-helper which this package is based on. You can find the documentation at https://github.com/repat/php-helper

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

#### `insert_bindings($query)`

Inserts values into `?` from the `->toSql()` string.

```php
insert_bindings(DB::table('users')->where('id', 1));
// returns: SELECT * FROM `users` WHERE `id` = '1'
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

#### `cache_get_or_add($key, $callable)`

Returns Cache for given key or adds the return value from the callable to the cache and then returns it.

```php
use App\Models\Post;

$posts = cache_get_or_add('posts', function() {
    return Post::orderBy('created_at', 'desc')->get();
});
```

#### `dispatch_tinker($job)`

Dispatches jobs from the [tinker REPL](https://laravel.com/docs/6.x/artisan#tinker).

```php
dispatch_tinker(new \App\Jobs\CleanupJob());
// returns: 1 (id of job)
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

##### `all_routes()`

Returns an array of all routes like so:

```php
all_routes();
// returns:
//      "name" => 'route.test', // could be null
//      "methods" => [
//          "GET",
//          "HEAD",
//      ],
//      "uri" => "test",
//      "action" => "\App\Http\Controllers\TestController@test",
```

##### `route_exists($namedRoute)`

Checks if the given route is a named route in any routes file.

```php
route_exists('route.test');

// returns: true

route_exists('route.foobar')

// returns: false
```

### Optional Packages

Optional packages suggested by this are required for these functions to work.

#### `translated_attributes($fqcn)`

Uses [astrotomic/laravel-translatable](https://github.com/astrotomic/laravel-translatable) and Reflection to get the `translatedAttributes` attribute of a Model.

* `$ composer require astrotomic/laravel-translatable`

```php
use App\Models\Product;

translated_attributes(Product::class);
// returns: ['title', 'description'];
```

### HTML

#### `extract_inline_img($text, $storagePath, $srcPath, $optimize)`

Extracts an inline image from a text, saves it on the harddrive and puts in the filename with the [src](https://developer.mozilla.org/de/docs/Web/HTML/Element/img) attribute. Can use the [spatie/laravel-image-optimizer](https://github.com/spatie/laravel-image-optimizer) to optimize images after upload but it's disabled by default.

* `$ composer require spatie/laravel-image-optimizer`

```php
extract_inline_img("<img src='data:image/jpeg;base64,...>", '/var/www/htdocs/laravel/storage/foobar', 'public/images', true);
// returns: <img src="public/images/fj3209fjew93.jpg">
```

### Constants

* `HTTP_VERBS_LARAVEL`: [all, get, head, post, delete, options, put, patch]
* `REGEX_IMG_BASE64_SRC`: Regular Expression used to find a base64 encoded image in HTML text
* `REGEX_IMG_BASE64_REPLACE`: Regular Expression used to replace a base64 encoded image in HTML text
* `MULTIPLE_TRANS`: 2

## Contributors

* https://github.com/bertholf

## License

* MIT, see [LICENSE](https://github.com/repat/laravel-helper/blob/master/LICENSE)

## Version

* Version 0.6

## Contact

#### repat

* Homepage: https://repat.de
* e-mail: repat@repat.de
* Twitter: [@repat123](https://twitter.com/repat123 "repat123 on twitter")

[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=repat&url=https://github.com/repat/laravel-helper&title=laravel-helper&language=&tags=github&category=software)
