<?php


namespace App\Service;

use App\Entity\User;
use App\Exception\ApiKeyException;
use \Exception;
use Symfony\Component\HttpClient\NativeHttpClient;

class WeatherService
{

    private const WEATHER_API = "http://api.openweathermap.org/data/2.5/";

    private const PARAMETERS = [
        'forecast' => 'forecast',
        'current' => 'weather',
    ];

    private $apiKey;

    /**
     * WeatherService constructor.
     * @param $apiKey
     * @throws ApiKeyException
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        if ($this->apiKey === null) {
            throw new ApiKeyException();
        }
    }

    public function getUserWeatherSituation(User $user): array
    {
        $data = [
            'weather' => [],
            'forecast' => [],
        ];
        $weathers = $user->getWeathers();
        foreach ($weathers as $weather) {
            array_push(
                $data['weather'],
                $this->getCurrentWeather($weather->getZipcode(), $weather->getCountryCode())
            );
            array_push(
                $data['forecast'],
                $this->getForecast($weather->getZipcode(), $weather->getCountryCode())
            );
        }
        return $data;
    }

    private function getCurrentWeather(string $zipcode, string $countrycode): array
    {
        $httpClient = new NativeHttpClient();
        $getParameters = self::PARAMETERS['current'] . '?zip=' . $zipcode . ',' . $countrycode;
        $getParameters .= '&appid=' . $this->apiKey;
        try {
            $response = $httpClient->request('GET', self::WEATHER_API . $getParameters);
            if ($response->getStatusCode() !== 200) {
                throw new Exception();
            }
            $data = json_decode($response->getContent(), true);
            $data['weather'][0]['icon'] = 'http://openweathermap.org/img/wn/'.$data['weather'][0]['icon'].'@2x.png';
            $data = $this->clearWeatherKey($data);
        } catch (Exception $e) {
            $data = [];
        }

        return $data;
    }

    private function getForecast(string $zipcode, string $countrycode): array
    {
        $httpClient = new NativeHttpClient();
        $getParameters = self::PARAMETERS['forecast'] . '?zip=' . $zipcode . ',' . $countrycode;
        $getParameters .= '&appid=' . $this->apiKey;
        try {
            $response = $httpClient->request('GET', self::WEATHER_API . $getParameters);
            if ($response->getStatusCode() !== 200) {
                throw new Exception();
            }
            $data = json_decode($response->getContent(), true);
            for ($i = 0; $i < count($data['list']); $i++) {
                $data['list'][$i] = $this->clearWeatherKey($data['list'][$i]);
                $icon = $data['list'][$i]['weather'][0]['icon'];
                $data['list'][$i]['weather'][0]['icon'] = 'http://openweathermap.org/img/wn/'.$icon.'@2x.png';
            }
        } catch (Exception $e) {
            $data = [];
        }
        return $data;
    }

    private function clearWeatherKey($weather): array
    {
        unset($weather['coord']);
        unset($weather['sys']);
        unset($weather['visibility']);
        return $weather;
    }
}
