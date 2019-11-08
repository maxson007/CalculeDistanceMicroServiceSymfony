<?php


namespace App\ApiProvider;


use App\Model\Point;
use GuzzleHttp\Client;

class GeolocationApiGouv
{
    const URL_API="https://api-adresse.data.gouv.fr/search/";

    /**
     * @var Client
     */
    private $client;

    /**
     * GeolocationApiGouv constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $address
     * @return Point|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getGeoPointByPostalAddress(string $address)
    {
        try{
            $response=$this->client->request('GET', self::URL_API, [
                'query' => ['q' => $address,'autocomplete'=>0 ]
            ]);
            $addressGeo=json_decode($response->getBody()->getContents());
            $features=$addressGeo->features;
            $coordinates=$features[0]->geometry->coordinates;
            return new Point($coordinates[1],$coordinates[0]);
        }catch (\Exception $exception){

        }
        return null;

    }

}