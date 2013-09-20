<?php defined('SYSPATH') OR die('No direct script access.');

class Helper_Style {
	
	public static $colors = array(
		'categories' => array(
            // Keep in order based on names in resource... this is lame but process light.
			'Beauty & Accessories'		  => 'beauty',
			'Books / Media / Education'   => 'books-media',
			'Charity'                     => 'charity',
			'Clothing & Shoes'            => 'clothing',
			'Restaurants & Entertainment' => 'restaurants',
			'Electronics / Video Games'   => 'electronics',
			'Online Gaming'               => 'online-gaming',
			'Gift Cards'                  => 'gift-card',
			'Home & Decor'                => 'home',
			'Grocery & Misc'              => 'grocery',
			'Sporting Goods'              => 'sporting-goods',
			'Toys'                        => 'toys',
			'Uncategorized'               => 'uncat',
		),
		'net-worth' => array(
			'Wallet'					  => "wallet",
			'Savings'					  => "savings",
			'Cards'						  => "cards"
		)
	);

	public static function get_class($key)
	{
		if (isset(self::$colors['categories'][$key]))
        {
			return self::$colors['categories'][$key];
		}
		
		if (isset(self::$colors['net-worth'][$key]))
        {
			return self::$colors['net-worth'][$key];
		}
		
		return self::$colors['categories']['Uncategorized'];
	}

    public static function categories()
    {
        return self::$colors['categories'];
    }

}// end class