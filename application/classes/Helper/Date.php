<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_Date {

	private static $default_formatter = 'm-d-Y';

    private static $month_names = NULL;

    public static function format($date, $formatter = NULL, $localize = TRUE)
    {
        if ( ! isset($formatter))
        {
            $formatter = self::$default_formatter;
        }

        $timestamp = strtotime($date);

        if ($localize)
        {
            $timestamp = self::localize($timestamp);
        }

        $date = date($formatter, $timestamp);

        return $date;
    }

	public static function format_month_year($date, $localize = TRUE)
	{
        $month_num = self::format($date, "n", $localize);

        $month_name = self::month_name($month_num);

        $year_num = self::format($date, "Y", $localize);

        return $month_name.", ".$year_num;
	}

    public static function current_year()
    {
        $date = getdate();
        return $date['year'];
    }

    public static function dob_format($year, $month, $day)
    {
        $date = $year.'-'.$month.'-'.$day;
        return $date;
    }

    public static function format_day_month_name($date, $localize = TRUE)
    {
        $month_num = self::format($date, "n", $localize);

        $month_name = self::month_name($month_num);

        $day = self::format($date, "j", $localize);

        return $day." ".$month_name;
    }

    public static function format_tx_date_time($date_in, $localize = TRUE)
    {
        $date = self::format_day_month_name($date_in, $localize);

        if (Session::instance()->get('hour12', TRUE) == TRUE)
        {
            $time = self::format($date_in, "g:i A", $localize);
        }
        else
        {
            $time = self::format($date_in, "H:i", $localize);
        }

        return $date.", ".$time;
    }

    private static function month_name($month_num)
    {
        if (self::$month_names === NULL)
        {
            self::$month_names = __('months');
        }

        return self::$month_names[$month_num - 1];
    }

    private static function localize($timestamp)
    {
        $tz_offset = Session::instance()->get('tz_offset', 0);

        $local_timestamp = $timestamp + ($tz_offset * 60);

        return $local_timestamp;
    }

}