<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_Transaction {

    private static $statuslookup = array(

        'Empty'                 => 'ignore',
        'FeePending'            => 'ignore',
        'FeeError'              => 'ignore',
        'LimitsExceeded'        => 'ignore',
        'Transfer'              => 'ignore',
        'ToSpending'            => 'ignore',
        'ProcessingError'       => 'ignore',
        'Failed'                => 'ignore',

        'Rejected'              => 'cancelled',
        'Cancelled'             => 'cancelled',
        'MerchantCancel'        => 'cancelled',
        'VPCancel'              => 'cancelled',

        'ApprovalPending'       => 'pending',
        'ProcessingPending'     => 'pending',

        'Processed'             => 'processed'
        
    );

    public static function get_status_category($status)
    {
        if (isset(self::$statuslookup[$status]))
        {
            return self::$statuslookup[$status];
        }

        return NULL;
    }

    public static function get_class($status, $source)
    {
        if ($source == 'Parent') return 'parent-purchase';

        $category = self::get_status_category($status);

        if ($category == 'cancelled') return 'cancelled';

        if ($category == 'pending') return 'pending';

        return NULL;
    }

}