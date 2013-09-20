<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_String {

    public static function standardize($string)
    {
        return strtolower(trim($string));
    }

    public static function is_equal($string1, $string2)
    {
        return strcmp(self::standardize($string1), self::standardize($string2)) == 0;
    }


    public static function get($string, $default = NULL)
    {
        $value = NULL;

        if ( ! empty($string))
        {
            $value = trim($string);
        }
        else
        {
            if ( ! is_null($default))
            {
                $value = trim($default);
            }
        }

        return $value;
    }
}

