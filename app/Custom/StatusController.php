<?php

namespace App\Custom;

class StatusController
{
     /**
     * message error not entry data product
     *
     * @return Array
     */
    public static function notFoundMessage():Array
    {

        return [
            'code'    => 404,
            'message' => 'Note not found',
            'success' => false,
        ];

    }

    /**
     * Message data yes entry Product
     *
     * @param String $code
     * @param String $message
     * @param Boolean $status
     * @param Int $count
     * @param Array $count
     * @return Array
     */

    public static function successfulMessage($code, $message, $status, $count, $payload):Array
    {

        return [
            'code'    => $code,
            'message' => $message,
            'success' => $status,
            'count'   => $count,
            'data'    => $payload,
        ];

    }

}
