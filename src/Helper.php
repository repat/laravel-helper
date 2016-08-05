<?php
namespace repat\LaravelHelper;

use DB;

class Helper
{
    const ASSOC_ARRAY = true;

    public static function getMySQLHeaders($table, $assoc = false)
    {
        $describeObjects = DB::select(DB::raw("DESCRIBE `" . $table . "`"));
        $tableHeader = array();
        if ($assoc) {
            foreach ($describeObjects as $obj) {
                $tableHeader[$obj->Field] = $obj->Field;
            }
        } else {
            foreach ($describeObjects as $obj) {
                $tableHeader[] = $obj->Field;
            }
        }
        if (empty($tableHeader)) {
            return false;
        }
        return $tableHeader;
    }
}
