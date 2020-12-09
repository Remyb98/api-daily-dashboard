<?php


namespace App\Service;

use App\Exception\ApiKeyException;
use Symfony\Component\HttpClient\NativeHttpClient;
use Exception;

class NewsService
{
    private const NEWS_API = "https://newsapi.org/v2/top-headlines";

    private const NEWS_API_SEARCH = "https://newsapi.org/v2/everything";

    private const CATEGORIES = ['business', 'entertainment', 'health', 'science', 'sports', 'technology'];

    private $apiKey;

    /**
     * NewsService constructor.
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

    /**
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getNews()
    {
        $finalData = [];
        $httpClient = new NativeHttpClient();
        foreach (self::CATEGORIES as $CATEGORY) {
            $finalData[$CATEGORY]= [];
            $params = '?country=us&category=' . $CATEGORY;
            try {
                $response = $httpClient->request("GET", self::NEWS_API . $params, [
                    'headers' => [
                        'x-api-key' => $this->apiKey,
                    ]
                ]);
                if ($response->getStatusCode() !== 200) {
                    throw new Exception();
                }
                $data = json_decode($response->getContent(), true);
                if ($data['totalResults'] < 20) {
                    $articleMax = $data['totalResults'];
                } else {
                    $articleMax = 20;
                }
                for ($i = 0; $i < $articleMax; $i++) {
                    array_push($finalData[$CATEGORY], $data['articles'][$i]);
                }
            } catch (Exception $e) {
                $finalData[$CATEGORY] = [];
            }
        }
        return $finalData;
    }

    public function getNewsByKeyword(string $keyword, string $source="")
    {
        $finalData = [];
        $httpClient = new NativeHttpClient();
        $params = "?language=en&sortBy=publishedAt&q=" . $keyword;
        if ($source !== "") {
            $params .= "&sources=" . $source;
        }
        try {
            $response = $httpClient->request("GET", self::NEWS_API_SEARCH . $params, [
                'headers' => [
                    'x-api-key' => $this->apiKey,
                    ]
            ]);
            if ($response->getStatusCode() !== 200) {
                throw new Exception();
            }
            $data = json_decode($response->getContent(), true);
            $data["totalResults"] = ($data["totalResults"] > 10)? 10 : $data["totalResults"];
            $finalData = $data;
        } catch (Exception $e) {
            $finalData = [];
        }
        return $finalData;
    }
}
