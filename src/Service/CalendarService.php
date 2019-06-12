<?php


namespace App\Service;

use App\Calendar\Parser;

class CalendarService
{
    public function discover(string $url)
    {
        $parser = new Parser($url);
        return 1;
    }
}
