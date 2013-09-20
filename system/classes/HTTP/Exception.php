<?php defined('SYSPATH') OR die('No direct script access.');

class HTTP_Exception extends Kohana_HTTP_Exception {

    public function get_response()
    {
        // Lets log the Exception, Just in case it's important!
        Kohana_Exception::log($this);

        if (Kohana::$environment >= Kohana::DEVELOPMENT)
        {
            // Show the normal Kohana error page.
            return parent::get_response();
        }
        else
        {
//          Generate a nicer looking "Oops" page.

            $view = View::factory('master');
            $view->content = View::factory('404');
            $view->header = View::factory('header');
            $view->footer = View::factory('footerlight');

            $response = Response::factory()
                ->status($this->getCode())
                ->body($view->render());

            return $response;
        }
    }
}