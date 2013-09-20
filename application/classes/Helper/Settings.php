<?php

class Helper_Settings {
    public static function override($settings) {
        $overrideFile = realpath('.').DIRECTORY_SEPARATOR.'overrides.php';

        if(file_exists($overrideFile)) {
            $overrides = Kohana::load($overrideFile);

            if(!empty($overrides)) {
                foreach ($overrides as $key => $value) {
                    if(isset($settings[$key])) {
                        $settings[$key] = $value;
                    }
                }
            }
        }

        return $settings;
    }

    public  static  function  getPath($file,$path = '.') {
        return realpath($path).DIRECTORY_SEPARATOR.$file;
    }

    public static function is_dev()
    {
        return (Kohana::$environment === Kohana::DEVELOPMENT);
    }
}