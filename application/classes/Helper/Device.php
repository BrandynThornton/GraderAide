<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_Device {

    private static $phone = NULL;
    private static $tablet = NULL;
    private static $mobile = NULL;
    private static $iOSv = NULL;

    public static function is_phone()
    {
        if (self::$phone === NULL)
        {
            self::parse_user_agent();
        }

        return self::$phone;
    }

    public static function iOSv()
    {
        if (self::$iOSv === NULL)
        {
            self::parse_user_agent();
        }

        return self::$iOSv;
    }

    public static function is_tablet()
    {
        if (self::$tablet === NULL)
        {
            self::parse_user_agent();
        }

        return self::$tablet;
    }

    public static function is_mobile()
    {
        if (self::$mobile === NULL)
        {
            self::parse_user_agent();
        }

        return self::$mobile;
    }

    private static function parse_user_agent()
    {
        self::$phone = FALSE;
        self::$tablet = FALSE;
        self::$mobile = FALSE;
        self::$iOSv = 0;

        $ua = strtolower($_SERVER['HTTP_USER_AGENT']);

        if (strpos($ua, 'ipad') !== FALSE)
        {
            self::$tablet = TRUE;
            self::setiOSv($ua);
        }

        elseif (strpos($ua, 'iphone') !== FALSE)
        {
            self::$phone = TRUE;
            self::setiOSv($ua);
        }
        elseif (strpos($ua, 'android') !== FALSE)
        {
            if (strpos($ua, 'mobile') !== FALSE)
            {
                self::$phone = TRUE;
            }
            else
            {
                self::$tablet = TRUE;
            }
        }

        elseif (strpos($ua, 'windows phone') !== FALSE)
        {
            self::$phone = TRUE;
        }

        elseif (strpos($ua, 'windows') !== FALSE && strpos($ua, 'touch') !== FALSE)
        {
            self::$tablet = TRUE;
        }

        elseif (strpos($ua, 'rim tablet') !== FALSE)
        {
            self::$tablet = TRUE;
        }

        elseif (strpos($ua, 'bb10') !== FALSE)
        {
            self::$phone = TRUE;
        }

        elseif (strpos($ua, 'blackberry') !== FALSE)
        {
            self::$phone = TRUE;
        }

        elseif (strpos($ua, 'nokian9') !== FALSE)
        {
            self::$phone = TRUE;
        }

        self::$mobile = self::$phone || self::$tablet;
    }

    private static function setiOSv($ua)
    {
        if (preg_match('/; CPU.*OS (\d_\d)/i', $ua, $matches))
        {
            self::$iOSv = (float) str_replace('_','.',$matches[1]);
        }
    }

}