<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_Currency {

	public static function format($amount)
	{
		return __('currency_symbol').$amount;
	}

    public static function conversion($from_currency,$to_currency,$amount, $default = NULL)
    {
        try{
            $amount = urlencode($amount);
            $from_currency = urlencode($from_currency);
            $to_currency = urlencode($to_currency);

            $url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_currency=?$to_currency";
            $ch = curl_init();
            $timeout = 0;

            curl_setopt ($ch, CURLOPT_URL, $url);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $raw_data = curl_exec($ch);
            curl_close($ch);

            $data = explode('"', $raw_data);
            $data = explode(' ', $data['3']);

//          Remove any non numeric chars from converted currency
            return preg_replace('/[^0-9.]/', '', $data[0]);
        }
        catch(Exception $e){
            Logger::getLogger("error")->error($e->getMessage(), $e);
            return $default;
        }

    }

}// end class