<?php

if (!function_exists('mysql_headers')) {
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
