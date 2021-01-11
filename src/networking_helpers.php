<?php

if (! function_exists('named_routes')) {
    /**
     * Returns array of all named routes in a routes file or null on error
     *
     * @param  string $filepath
     * @param  string|null $verb
     * @return null|array
     */
    function named_routes(string $filepath, ?string $verb = null) : ?array
    {
        if (! file_exists($filepath)) {
            return null;
        }

        $content = file_get_contents($filepath);

        $verb = strtolower($verb);
        $regex = '/name\(\'([0-9a-z\.\_]*)\'\)';

        if (! empty($verb) && ! in_array($verb, HTTP_VERBS_LARAVEL)) {
            return null;
        } elseif (! empty($verb)) {
            $regex .= '.*\-\>' . $verb . '\(/';
        }

        // filter with regex
        $results = [];
        $found = preg_match_all(str_finish($regex, '/'), $content, $results);

        return array_key_exists(REGEX_FIRST_RESULT_KEY, $results) ? $results[REGEX_FIRST_RESULT_KEY] : [];
    }
}

if (! function_exists('routes_path')) {
    /**
     * Get the path to the routes folder, similar to `app_path()` etc
     *
     * @param  string  $path
     * @return string
     */
    function routes_path(string $path = '') : string
    {
        return base_path() . '/routes' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (! function_exists('current_route_name')) {
    /**
     * If the current Route has a name, otherwise return `null`
     *
     * @return string|null
     */
    function current_route_name() : ?string
    {
        $route = \Route::getCurrentRoute();
        if (! empty($route)) {
            return $route->getName();
        }
        return null;
    }
}

if (! function_exists('all_routes')) {
    /**
     * Array of all Routes and their properties
     *
     * @return array
     */
    function all_routes() : array
    {
        $allRoutes = [];
        $routes = \Route::getRoutes();

        foreach ($routes as $route) {
            $allRoutes[] = [
                'name' => $route->getName(),
                'methods' => $route->methods(), // array
                'uri' => $route->uri(),
                'action' => $route->getActionName(),
            ];
        }

        return $allRoutes;
    }
}

if (! function_exists('route_exists')) {
    /**
     * Wrapper around all_routes()
     *
     * @param  string $routeName
     * @return bool
     */
    function route_exists(string $routeName) : bool
    {
        return in_array($routeName, array_map(function ($item) {
            return $item['name'];
        }, all_routes()));
    }
}
