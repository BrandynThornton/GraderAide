<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_Url {

	public static function users($path = '')
	{
		$settings = Kohana::$config->load('settings');
		return $settings->users_url.$path;
	}

	public static function images($path = '')
	{
		$settings = Kohana::$config->load('settings');
		return $settings->images_url.$path;
	}

    public static function brand_images($path = '')
    {
        $settings = Kohana::$config->load('settings');
        return $settings->brand_images_url.$path;
    }

	public static function api($path = '')
	{
		$settings = Kohana::$config->load('settings');
		return $settings->api_url.$settings->api_version.$path;
	}

    public static function marketing($path = '')
    {
        $settings = Kohana::$config->load('settings');
        return $settings->marketing_url.$path;
    }

    public static function marketing_child($path = '')
    {
        $settings = Kohana::$config->load('settings');
        return $settings->marketing_url_child.$path;
    }

    public static function promo_images($path = '')
    {
        return self::api('Admin/PromotionImage?offerIdentifier=');
    }
}