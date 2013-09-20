<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_Array {

    public static function add_non_empty( & $arr, $value)
    {
        if ( ! empty($value))
        {
            $arr[] = $value;
        }
    }
}