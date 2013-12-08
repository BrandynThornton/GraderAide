<?php defined('SYSPATH') OR die('No direct script access.');

class Asset {

    public static $scripts = '';

    public static function add_script($script) {
        self::$scripts .= $script;
    }

}
