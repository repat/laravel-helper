<?php
namespace repat\LaravelHelper;

use DB;

class Helper {

  public static function str_wo_folders($str) {
	$posOfLastSlash = strrpos ($str, "/");
    return substr($str, $posOfLastSlash + 1, strlen($str));
  }

  public static function getMySQLHeaders($table) {
     $tableContent = DB::table($table)->get();
     $describeObjects = DB::select(DB::raw("DESCRIBE `" . $table . "`"));
     $tableHeader = array();
     foreach ($describeObjects as $obj) {
       $tableHeader[] = $obj->Field;
     }
     if (empty($tableHeader)){
         return false;
     }
     return $tableHeader;
  }
}

