<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_Card {

	public static function get_card_type($number)
	{
        if (preg_match('/^5[1-5][0-9]{14}$/', $number))
            return "MasterCard";

        if (preg_match('/^4[0-9]{12}([0-9]{3})?$/', $number))
            return "Visa";

        if (preg_match('/^3[47][0-9]{13}$/', $number))
            return "AmericanExpress";

        if (preg_match('/^3(0[0-5]|[68][0-9])[0-9]{11}$/', $number))
            return "Diners Club";

        if (preg_match('/^6011[0-9]{12}$/', $number))
            return "Discover";

        if (preg_match('/^(3[0-9]{4}|2131|1800)[0-9]{11}$/', $number))
            return "JCB";
        return FALSE;
	}

    public static function get_error($error)
    {
        $card_errors = __('payment_method_errors');

        if (isset($card_errors[$error]))
        {
            return $card_errors[$error];
        }

        return $card_errors['general'];
    }

}// end class