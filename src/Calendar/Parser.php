<?php


namespace App\Calendar;

use App\Exception\NotURLException;

class Parser
{

    private const EVENT_REGEX = '`BEGIN:VEVENT(.+)END:VEVENT`Us';

    /**
     * Parser constructor.
     * @param string $url
     * @throws NotURLException
     */
    public function __construct(string $url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) && file_exists($url)) {
            throw new NotURLException();
        }
        $events = $this->parseAllEvent(file_get_contents($url));
        var_dump($events);
        $this->parseEvent($events);
    }

    private function parseAllEvent(string $calendar): array
    {
        preg_match_all(self::EVENT_REGEX, $calendar, $events);
        return $events[0];
    }

    private function parseEvent(array $events)
    {
        $parsedEvents = [];
        $events = str_replace("\r\n", "", $events);
        foreach ($events as $event) {
            $eventClean = new Event();
            var_dump($event);
        }
    }
}
