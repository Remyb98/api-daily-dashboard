<?php


namespace App\Service;

use App\Entity\User;
use DateTime;
use DateTimeZone;
use Exception;
use ICal\ICal;

class CalendarService
{
    /**
     * Get User's calendar and parse them for get events.
     * @param User $user
     * @return array
     */
    public function getUserCalendar(User $user): array
    {
        $calendarsURL = $user->getCalendars();

        $calendars = [];
        foreach ($calendarsURL as $calendar) {
            array_push($calendars, $this->fetchEvents($calendar->getURL()));
        }
        return $calendars;
    }

    /**
     * Fetch calendars and get events into them.
     * @param string $url
     * @return array
     */
    private function fetchEvents(string $url): array
    {
        $calendar = new ICal($url);
        return $this->beautifyEvents($calendar->events());
    }

    /**
     * Convert dates from event to get a readable date
     * @param array $events
     * @return array
     */
    private function beautifyEvents(array $events): array
    {
        foreach ($events as $event) {
            $event->dtstart = $this->formatDate($event->dtstart);
            $event->dtend = $this->formatDate($event->dtend);
            $event->dtstamp = $this->formatDate($event->dtstamp);
            $event->created = ($event->created !== null)? $this->formatDate($event->created) : null;
            $event->lastmodified = ($event->lastmodified !== null)? $this->formatDate($event->lastmodified) : null;
            $event->start = $event->dtstart;
            $event->end = $event->dtstart;
        }
        return $events;
    }

    /**
     * Convert a weird date into a DateTime if an error occurred then return null
     * in 99 percents of cases the exception is throw because the date is incorrect.
     * @param string $date
     * @return DateTime|null
     */
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
