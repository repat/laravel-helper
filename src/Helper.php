<?php
namespace repat\LaravelHelper;

use DB;

class Helper
{
    
    const ASSOC_ARRAY = true;

    public static function getStringWithoutFolder($str) {
        $posOfLastSlash = strrpos($str, "/");
        return substr($str, $posOfLastSlash + 1, strlen($str));
    }
    
    public static function getMySQLHeaders($table, $assoc = false) {
        $describeObjects = DB::select(DB::raw("DESCRIBE `" . $table . "`"));
        $tableHeader = array();
        if ($assoc) {
            foreach ($describeObjects as $obj) {
                $tableHeader[$obj->Field] = $obj->Field;
            }
        } 
        else {
            foreach ($describeObjects as $obj) {
                $tableHeader[] = $obj->Field;
            }
        }
        if (empty($tableHeader)) {
            return false;
        }
        return $tableHeader;
    }

    public static function getFilesFromFolder($folder) {
        return array_diff(scandir($folder), array('..', '.'));
    }

    // the other method is more descriptive, but this resembles League\Flysystem
    public static function files($folder) {
       return self::getFilesFromFolder($folder);
    }

    // http://stackoverflow.com/a/20024776/2517690
    public static function getNumberOfRows($file) {

	$file->seek(PHP_INT_MAX);
	return $file->key();
    }
}

