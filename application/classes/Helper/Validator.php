<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_Validator {

    public static $validations = array(
//      Password must be alphanumeric, must include at least 6 characters, must include at least 1 number and 1 letter.
        'password'  => '/^(?=.*\\d)(?=.*[a-zA-Z])(?!.*\\s).{6,20}$/',
        'name'      => "/^[A-Z]'?[- a-zA-Z]( [a-zA-Z])*$/",
        'cvv'       => "/^[0-9]{3,4}$/",
        'cardname'  => "/^[a-zA-Z]*-[0-9]*$/",
        'guid'      => '/^(\{){0,1}[0-9a-fA-F]{8}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{12}(\}){0,1}$/'
    );

	public static function is_credit_card($number)
	{
        return count(Helper_Card::get_card_type($number)) > 0;
	}

    public static function is_name($input)
    {
        return preg_match(self::$validations['name'], $input);
    }

    public static function is_cvv($input)
    {
        return preg_match(self::$validations['cvv'], $input);
    }

    public static function is_cardname($input)
    {
        return preg_match(self::$validations['cardname'], $input);
    }

    public static function is_password($input)
    {
        return preg_match(self::$validations['password'], $input);
    }

    public static function is_guid($guid)
    {
        return preg_match(self::$validations['guid'], trim($guid));
    }

}// end class