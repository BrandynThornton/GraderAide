<?php defined('SYSPATH') or die('No direct script access.');

class Helper_Request {
    private static $valueDelimiter = '&';
    private static $kvDelimiter = '=';

    private static function getValueFromCookie($content, $key, $default = null) {
        if(isset($content)) {
            $json = json_decode($content, True);

            if(isset($json)
                && isset($json[$key])) {
                return $json[$key];
            }

            if(strpos($content, self::$kvDelimiter) !== false) {
                $collection = explode(self::$valueDelimiter, $content);

                if(is_array ($collection)) {
                    foreach ($collection as $item) {
                        $parts = explode(self::$kvDelimiter, $item);

                        if(is_array($parts)
                            && count($parts) > 0) {
                            if($parts[0] === $key){
                                return isset($parts[1]) ? $parts[1] : $default;
                            }
                        }
                    }
                }
            }
        }

        return $default;
    }

    public static function get($key, $default = null) {
        return isset($_GET[$key]) ? trim($_GET[$key]) : (isset($_POST[$key]) ? trim($_POST[$key]) : $default);
    }

    public static function getFromCookie($name, $key = null, $default = null) {
        if(!isset($_COOKIE[$name])) {
            return $default;
        }

        $content = urldecode($_COOKIE[$name]);

        if(isset($key)) {
            return self::getValueFromCookie($content, $key, $default);
        }

        return isset($content) ? $content : $default;
    }
}