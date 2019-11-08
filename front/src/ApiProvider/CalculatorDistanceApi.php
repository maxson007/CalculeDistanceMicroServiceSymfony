<?php


namespace App\ApiProvider;


use App\Model\Point;
use GuzzleHttp\Client;

class CalculatorDistanceApi
{
    const URL_API='http://webserver_api/calculate/distance';


    /**
     * @var Client
     */
    private $client;

    /**
     * @var IPGeolocation
     */
    private $iPGeolocation;

    /**
     * @var GeolocationApiGouv
     */
    private $apiGouv;

    /**
     * CalculatorDistanceApi constructor.
     * @param Client $client
     * @param IPGeolocation $iPGeolocation
     * @param GeolocationApiGouv $apiGouv
     */
    public function __construct(Client $client, IPGeolocation $iPGeolocation, GeolocationApiGouv $apiGouv)
    {
        $this->client = $client;
        $this->iPGeolocation = $iPGeolocation;
        $this->apiGouv = $apiGouv;
    }


    public function getDistanceByPoints(Point $point1, Point $point2){

        if($point2==null or $point2 == null) return 0;

        $jsonModel=new \stdClass();

        $jsonModel->points[0]=new \stdClass();
        $jsonModel->points[0]->lat=$point1->getLatitude();
        $jsonModel->points[0]->lng=$point1->getLongitude();
        $jsonModel->points[1]=new \stdClass();
        $jsonModel->points[1]->lat=$point2->getLatitude();
        $jsonModel->points[1]->lng=$point2->getLongitude();

      $response=  $this->client->request('POST',self::URL_API, [
            'body' => json_encode($jsonModel)
        ]);
       return $response->getBody()->getContents();
    }

    /**
     * @param $ip
     * @param $postalAdress
     * @return int|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDistanceByIpAndPostalAdress($ip, $postalAdress){

        return $this->getDistanceByPoints(
            $this->iPGeolocation->getGeoPointByIP($ip),
            $this->apiGouv->getGeoPointByPostalAddress($postalAdress)
        );
    }

}