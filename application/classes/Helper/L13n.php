<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_L13n {

    private static $allowed_countries = array(
        'us',
        'ca',
        'gb'
    );

    private static $allowed_regions = array(
        'en-us',
        'en-ca',
        'en-gb'
    );

    public static function get_country($region = NULL)
    {
        if (is_null($region))
        {
            $region = Session::instance()->get('region');
        }

        $country = strtoupper(trim(substr($region, strlen($region)-2, strlen($region))));

        if (self::country_allowed($country)){
            return strtoupper($country);
        }
        else{
            return 'US'; // default to US
        }
    }

    public static function country_allowed($country)
    {
        $valid = FALSE;

        if ( ! empty($country)){
            $valid = in_array(Helper_String::standardize($country), self::$allowed_countries);
        }

        return  $valid;
    }

    public static function region_allowed($region)
    {
        $valid = FALSE;

        if ( ! empty($region)){
            $valid = in_array(Helper_String::standardize($region), self::$allowed_regions);
        }

        return  $valid;
    }


}// end class