<?php

namespace App\Interfaces\ApiResponses;

interface ApiResponsesInterface
{
    public static function succes($message,$statusCode,$data);
    public static function error($message,$statusCode,$data);
}
