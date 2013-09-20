<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronin
 * Date: 7/22/13
 * Time: 4:32 PM
 * To change this template use File | Settings | File Templates.
 */

class Kohana_Exception extends Kohana_Kohana_Exception {
    /**
     * Get a Response object representing the exception
     *
     * @uses    Kohana_Exception::text
     * @param   Exception  $e
     * @return  Response
     */
    public static function response(Exception $e)
    {
        Logger::getLogger("error")->error($e->getMessage(), $e);

        if (Kohana::$environment === Kohana::PRODUCTION)
        {
            $httpStatus = 500;
            $code = $e->getCode();

            try {
                if(is_numeric($code)
                    && $code > 100
                    && $code < 600) {
                    $httpStatus = $code;
                }
            } catch (Exception $fe) {
                Logger::getLogger("default")->error('something really bad happended parsing error', $fe);
            }

            // call default error page
            return Response::factory()
                ->status($httpStatus)
                ->headers('Location', URL::site('errors/404'));
        } else {
            return parent::response($e);
        }
    }
}