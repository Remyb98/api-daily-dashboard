<?php


namespace App\Controller;

use App\Entity\Calendar;
use App\Entity\User;
use App\Entity\Weather;
use App\Service\CalendarService;
use App\Service\NewsService;
use App\Service\WeatherService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class TestController
 * @package App\Controller
 * Just a stupid controller for test during dev
 * should be deleted at the end :)
 */
class TestController extends AbstractFOSRestController
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
     * @Rest\Get("/calendars/{url}")
     * @Rest\View()
     * @param CalendarService $calendarService
     * @return array
     */
    public function testCalendar(CalendarService $calendarService, string $url)
    {
        $user = new User();
        $calendar = new Calendar();
        $calendar
            /*->setURL('https://calendar.google.com/calendar/ical/7o582tftsgac104iaolk7p4l4o%40' .
                'group.calendar.google.com/private-1645c274b41fc16cab63f91c20651c89/basic.ics')*/
            ->setURL($url)
            ->setColor('#447474')
            ->setUser($user)
        ;
        $user->addCalendar($calendar);
        return $calendarService->getUserCalendar($user);
    }

    /**
     * @Rest\Get("/weathers/{zipcode}")
     * @Rest\View()
     * @param WeatherService $weatherService
     * @return array|mixed
     */
    public function testWeather(WeatherService $weatherService, string $zipcode)
    {
        $user = new User();
        $weather = new Weather();
        /*$weather
            ->setZipcode('93130')
            ->setCountryCode('fr')
            ->setUser($user)
        ;
        $user->addWeather($weather);*/
        $weather = new Weather();
        $weather
            ->setZipcode($zipcode)
            ->setCountryCode('fr')
            ->setUser($user)
        ;
        $user->addWeather($weather);
        return $weatherService->getUserWeatherSituation($user);
    }
}
