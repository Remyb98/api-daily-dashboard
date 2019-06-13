<?php


namespace App\Controller;

use App\Service\CalendarService;
use App\Service\NewsService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * Class TestController
 * @package App\Controller
 * Just a stupid controller for test during dev
 * should be deleted at the end :)
 */
class TestController extends FOSRestController
{

    /**
     * @Rest\Get("/")
     * @Rest\View()
     */
    public function sayHello()
    {
        $var = [
            "a" => 1,
            "b" => 2,
            "c" => 3,
            "d" => 4,
            "id" => [
                "author" => "Remy",
                "time" => new \DateTime(),
            ],
        ];

        return $var;
    }

    /**
     * @Rest\Get("/news")
     * @Rest\View()
     * @param NewsService $newsService
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function testNews(NewsService $newsService)
    {
        $data = $newsService->getNews();
        return $data;
    }

    /**
     * @Rest\Get("/calendars")
     * @Rest\View()
     * https://calendar.google.com/calendar/ical/7o582tftsgac104iaolk7p4l4o%40group.calendar.google.com/private-1645c274b41fc16cab63f91c20651c89/basic.ics
     */
    public function testCalendar(CalendarService $calendarService)
    {
        return $calendarService->discover("https://calendar.google.com/calendar/ical/7o582tftsgac104iaolk7p4l4o%40group.calendar.google.com/private-1645c274b41fc16cab63f91c20651c89/basic.ics");
    }
}
