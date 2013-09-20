<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_HTML {

    private static $scripts = array();

    private static $styles = array();

    public static function add_script($js)
    {
        self::$scripts[] = $js;
    }

    public static function prepend_script_file($file, $data = null)
    {
        $js = View::factory($file, $data);

        if(count(self::$scripts) > 0) {
            array_unshift(self::$scripts, $js);
        } else {
            self::$scripts[] = $js;
        }
    }

    public static function append_script_file($file, $data = null)
    {
        $js = View::factory($file, $data);

        self::$scripts[] = $js;
    }

    public static function get_scripts()
    {
        return self::$scripts;
    }

    public static function add_style($s)
    {
        self::$styles[] = $s;
    }

    public static function get_styles()
    {

        return self::$styles;
    }

    public static function get_users_name()
    {
        $name = Session::instance()->get('name');
        if ( ! isset($name) || Helper_String::is_equal($name,  'New Parent'))
        {
            $name = Session::instance()->get('username');
        }
        return $name;
    }


    public static function enable_timeout()
    {
        $settings = Kohana::$config->load('settings');
        $enabled = $settings->timeout_enabled;
        if (isset($enabled) && Helper_String::is_equal($enabled, 'true'))
        {
            return TRUE;
        }
        return FALSE;
    }

    public static function  user_agreement($text)
    {
        $text = isset($text) ? $text : __('terms_of_service');

        $user_agreement_link = Helper_Url::marketing('virtual-piggy-user-agreement');

        return '<a href="'.$user_agreement_link.'" target="_blank">'.$text.'</a>';
    }

    public static function  privacy_policy($text)
    {
        $text = isset($text) ? $text : __('privacy_policy');

        $privacy_policy__link = Helper_Url::marketing('virtual-piggy-privacy-policy');

        return '<a href="'.$privacy_policy__link.'" target="_blank">'.$text.'</a>';
    }

    public static function make_year_list($start_year, $end_year, $asc = FALSE)
    {
        $list = "";
        if ($asc)
        {
            for ($i = $start_year; $i <= $end_year; $i++)
            {
                $list .= "<option value=\"".$i."\">".$i."</option>\n";
            }
        }

        else
        {
            for ($i = $end_year; $i >= $start_year; $i--)
            {
                $list .= "<option value=\"".$i."\">".$i."</option>\n";
            }
        }

        return $list;
    }

    public static function make_month_list()
    {
        $months = __('months_short');
        ?>
        <option value="01"><?= $months[0] ?></option>
        <option value="02"><?= $months[1] ?></option>
        <option value="03"><?= $months[2] ?></option>
        <option value="04"><?= $months[3] ?></option>
        <option value="05"><?= $months[4] ?></option>
        <option value="06"><?= $months[5] ?></option>
        <option value="07"><?= $months[6] ?></option>
        <option value="08"><?= $months[7] ?></option>
        <option value="09"><?= $months[8] ?></option>
        <option value="10"><?= $months[9] ?></option>
        <option value="11"><?= $months[10] ?></option>
        <option value="12"><?= $months[11] ?></option>
    <?
    }

}