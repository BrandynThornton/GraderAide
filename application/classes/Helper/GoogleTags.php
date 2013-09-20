<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_GoogleTags {

    private static $tags_keys= array(
        'PROD' => 'GTM-5XMSS3',
    );

    private static $gtm_snippet = <<<GTM
    <!-- Google Tag Manager -->
    <noscript>
        <iframe src="//www.googletagmanager.com/ns.html?id=%s"
            height="0" width="0" style="display:none;visibility:hidden">
        </iframe>
    </noscript>
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','%s');
    </script>
    <!-- End Google Tag Manager -->
GTM;

    private static $data_layer = <<<DATALAYER
    <script>
        dataLayer = [{%s
        }];
    </script>
DATALAYER;

    private static $data_val_defaults =<<<DATADEFAULTS
            'username': '%s',
            'region': '%s',
            'referrerAttribution': '%s',
            'trackingInfo': '%s',
            'referralId': '%s'

DATADEFAULTS;


    public static function get_scripts()
    {
        return self::get_default_data_layer().self::get_gtm_snippet();
    }

    private static function get_gtm_snippet()
    {
        $id = self::$tags_keys['PROD'];

        return PHP_EOL.sprintf(self::$gtm_snippet, $id, $id).PHP_EOL;
    }

    public static function get_default_data_layer()
    {
        return PHP_EOL.sprintf(self::$data_layer, self::get_data_default()).PHP_EOL;
    }


    private static function get_data_default()
    {
        $args[] = Helper_String::get(Session::instance()->get('username'), 'na');

        $args[] = strtolower(Helper_String::get(Session::instance()->get('region'), 'na'));

        $args[] = Helper_String::get(Session::instance()->get('refatt'), 'na');

        $args[] = Helper_String::get(Session::instance()->get('tracking_info'), 'na');

        $args[] = Helper_String::get(Session::instance()->get('referralid'), 'na');

        return PHP_EOL.vsprintf( self::$data_val_defaults, $args);
    }

    public static function get_events()
    {
        $events = array();

        Helper_Array::add_non_empty($events, Session::instance()->get_once('gtm_parent_added'));

        Helper_Array::add_non_empty($events, Session::instance()->get_once('gtm_child_added'));

        Helper_Array::add_non_empty($events, Session::instance()->get_once('gtm_payment_added'));

        if (count($events) > 0){
            return "\"".implode('","', $events)."\"";
        }
        return '';

        return $events;
    }

    public static function gtm_is_active()
    {
        return Kohana::$environment == Kohana::PRODUCTION;
    }
}