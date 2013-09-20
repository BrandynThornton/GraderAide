<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_Session{

    public static function set_login($response)
    {
        Session::instance()->set('user_id', $response['Identifier']);

        Session::instance()->set('username', $response['Username']);

        Session::instance()->set('type', $response['Type']);

        Session::instance()->set('region', $response['Region']);

        Session::instance()->set('token', $response['Token']);

        // In the future this will be passed from API
        if (Helper_String::is_equal($response['Region'], "en-GB"))
        {
            Session::instance()->set('hour12', FALSE);
        }
        else
        {
            Session::instance()->set('hour12', TRUE);
        }
    }

    public static function set_marketing($response)
    {
        self::set_else_delete('refatt', $response['ReferrerAttribution']);

        self::set_else_delete('tracking_info', $response['TrackingInfo']);

        self::set_else_delete('referralid', $response['ReferralId']);
    }

    public static function set_else_delete($key, & $value)
    {
        if ( ! empty($value)){
            Session::instance()->set($key, $value);
            return TRUE;
        }
        else{
            Session::instance()->delete($key);
            return FALSE;
        }
    }

    public static function minify()
    {
        $minify = Session::instance()->get('minify', NULL);

        if ($minify !== NULL)
            return $minify;

        return ( ! Helper_Settings::is_dev());
    }

}// end class