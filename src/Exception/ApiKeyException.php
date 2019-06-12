<?php


namespace App\Exception;

use Exception;

class ApiKeyException extends Exception
{
    public function errorMessage()
    {
        return "Error with the API Key";
    }
}
