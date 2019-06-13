<?php


namespace App\Service;

use DateTime;
use DateTimeZone;
use Exception;
use ICal\ICal;

class CalendarService
{
    public function discover(string $url)
    {
        $calendar = new ICal($url);
        return $this->beautifyEvents($calendar->events());
    }

    private function beautifyEvents(array $events)
    {
        foreach ($events as $event) {
            $event->dtstart = $this->formatDate($event->dtstart);
            $event->dtend = $this->formatDate($event->dtend);
            $event->dtstamp = $this->formatDate($event->dtstamp);
            $event->created = $this->formatDate($event->created);
            if ($event->lastmodified !== null) {
                $event->lastmodified = $this->formatDate($event->lastmodified);
            }
        }
        return $events;
    }

    private function formatDate(string $date): ?DateTime
    {
        try {
            $formatted = new DateTime($date);
            $formatted->setTimezone(new DateTimeZone("Europe/Paris"));
            return $formatted;
        } catch (Exception $e) {
            return null;
        }
    }
}
