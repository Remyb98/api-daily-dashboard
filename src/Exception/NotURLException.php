<?php


namespace App\Exception;

use Exception;

class NotURLException extends Exception
{
    public function errorMessage()
    {
        return "Not a valid URL";
    }
}