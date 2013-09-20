<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_CapturePlus {
	
	private static $keys = array(
		'US' => 'fg96-hw84-wr23-wj53&app=10034',
        'CA' => 'gb89-xf27-nf91-pu38&app=16481',
        'GB' => 'ke71-wm28-mw69-xz78&app=10388',
	);

	private static function get_key()
	{
		$country = Helper_L13n::get_country();

		if (isset(self::$keys[$country]))
		{
			return self::$keys[$country];
		}
		
		return self::$keys['US'];
	}

	public static function script()
	{
        $key_vals = explode('&', self::get_key(), 2);

		return sprintf('<script type="text/javascript" src="https://services.postcodeanywhere.co.uk/js/captureplus-1.35.min.js?key=%1s&%2s"></script>', $key_vals[0],$key_vals[1]);
	}

	public static function style()
	{
        $key_vals  = explode('&', self::get_key(), 2);

		return sprintf('<link rel="stylesheet" type="text/css" href="https://services.postcodeanywhere.co.uk/css/captureplus-1.35.min.css?key=%1s" />', $key_vals[0]);
	}

}// end class