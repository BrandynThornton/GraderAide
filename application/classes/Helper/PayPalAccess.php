<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_PayPalAccess {

    private static $app_id = 'ATfSdBCc5KanxC_O3IPhanP2ULdFS8ebY2sUKj8Na_fFMOWK3Qy4cmVUNFCo';

    private static $scopes = 'openid profile email address phone';

    private static $button_setting = <<<"SETTINGS"
{
                'appid'         : '%1s',
                'scopes'        : '%2s',
                'containerid'   : 'paypalbutton',
                'theme'         : 'neutral',
                'returnurl'     : '%3s',
                'locale'        : '%4s'
            }
SETTINGS
;

    private static $registration_url = 'registration/paypalsignup';

    private static $login_url = 'login/paypal';

    private static function get_settings($return_url)
    {
        return sprintf(self::$button_setting, self::$app_id, self::$scopes, $return_url, strtolower(Session::instance()->get('region')));
    }

    public static function get_registration_settings()
    {
        $refatt = Session::instance()->get('refatt');

        $tracking = Session::instance()->get('tracking_info');

        $refid = Session::instance()->get('referralid');

        $return_url = Helper_Url::users(sprintf(self::$registration_url));

        if ( ! empty($refatt))
        {
            $return_url .= '?refatt='.$refatt;

            if ( ! empty($tracking))
            {
                $return_url .= '&tracking='.$tracking;
            }

            if ( ! empty($refid))
            {
                $return_url .= '&refid='.$refid;
            }

        }
        return self::get_settings($return_url);
    }

    public static function get_login_settings()
    {
        $return_url = self::$login_url;

        if ( ! empty($_GET['sid']))
        {
            $return_url .= '?sid='.Helper_String::get($_GET['sid']);
        }

        return self::get_settings(Helper_Url::users($return_url));
    }

    public static function get_login_query_str()
    {
        $query_str = '';

        if ( ! empty($_GET['sid']))
        {
            $query_str .= '?sid='.Helper_String::get($_GET['sid']);
        }

        return $query_str;
    }

}