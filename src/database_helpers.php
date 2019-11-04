<?php

if (! function_exists('mysql_headers')) {
    /**
     * Returns the headers of a MySQL/MariaDB table
     * or empty array in case of error
     *
     * @param  string  $table
     * @param  boolean $assoc
     * @return array
     */
    function mysql_headers(string $table, bool $assoc = false) : array
    {
        $describeObjects = \DB::select(\DB::raw('DESCRIBE `' . $table . '`'));
        $tableHeader = [];

        if ($assoc === true) {
            foreach ($describeObjects as $obj) {
                $tableHeader[$obj->Field] = $obj->Field;
            }
        } else {
            foreach ($describeObjects as $obj) {
                $tableHeader[] = $obj->Field;
            }
        }

        return $tableHeader;
    }
}

if (! function_exists('print_db_session')) {
    /**
     * Prints the session from the DB
     *
     * @param  string $table
     * @return void
     */
    function print_db_session(string $table = 'sessions') : void
    {
        print_r(
            unserialize(
                base64_decode(
                    \DB::table($table)
                        ->where('user_id', auth()->id())
                        ->first()
                        ->payload
                )
            )
        );
    }
}

if (! function_exists('get_free_slug')) {
    /**
     * Looks up a free slug for the `$fqcn` eloquent model,
     * Suggesting `$toSlug` for field `$field`
     * Optionally, can ignore `$id`, which is usually `id` but can
     * be replaced by primary key `$pk`
     *
     * Will add integer starting at 1 in case `str_slug($toSlug)` is taken already
     *
     * @param  string $toSlug
     * @param  string $field
     * @param  string $fqcn
     * @param  int|null $id
     * @param  string $pk
     * @return string
     */
    function get_free_slug(string $toSlug, string $field, string $fqcn, ?int $id = null, string $pk = 'id') : string
    {
        //init
        $counter = 1;

        // first suggestion
        $slug = str_slug($toSlug);

        // make eloquent model
        $query = resolve($fqcn)::where($field, $slug);

        // exclude $id if set
        if (isset($id)) {
            $query = $query->where($pk, '<>', $id);
        }

        // search for a free slug
        while (! empty($query->first())) {
            $slug = str_slug($toSlug) . $counter;
            $counter++;
            $query = resolve($fqcn)::where($field, $slug);
            if (isset($id)) {
                $query = $query->where($pk, '<>', $id);
            }
        }

        return $slug;
    }
}

if (! function_exists('table_headers')) {
    /**
     * Gets table headers the Laravel way via the Schema builder
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return array
     */
    function table_headers(\Illuminate\Database\Eloquent\Model $model) : array
    {
        return $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
    }
}

if (! function_exists('insert_bindings')) {
    /**
     * Uses toSql() and getBindings() to get full SQL Query
     *
     * @param  \Illuminate\Database\Query\Builder $query
     * @return string
     */
    function insert_bindings(\Illuminate\Database\Query\Builder $query) : string
    {
        $querySql = str_replace(['?'], ['\'%s\''], $query->toSql());
        return vsprintf($querySql, $query->getBindings());
    }
}
