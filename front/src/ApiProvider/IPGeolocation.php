<?php


namespace App\ApiProvider;


use App\Model\Point;
use GuzzleHttp\Client;

class IPGeolocation
{
    const URL_API='https://geo.ipify.org/api/v1';

    private $apiKey;

    /**
     * @var Client
     */
    private $client;

    /**
     * IPGeolocation constructor.
     * @param $apiKey
     * @param Client $client
     */
    public function __construct($apiKey, Client $client)
    {
        $this->apiKey = $apiKey;
        $this->client = $client;
    }


    /**
     * @param string $ipAdress
     * @return Point|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getGeoPointByIP(string $ipAdress)
    {
        if(empty($ipAdress))
            throw new \Exception("getGeoPointByIP");

        try{
            $response=$this->client->request('GET', self::URL_API, [
                'query' => ['apiKey' => $this->apiKey,'ipAddress'=>$ipAdress ]
            ]);
            $ipGeoloc=json_decode($response->getBody()->getContents());

            return new Point($ipGeoloc->location->lat,$ipGeoloc->location->lng);

        }catch (\Exception $exception){

        }
        return null;
    }

}