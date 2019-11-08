<?php

namespace App\Controller;

use App\Form\CalculateDistanceDTO;
use App\Form\CalculateDistanceType;
use App\Model\Point;
use App\Utils\Calculator;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CalculateDistanceController extends AbstractController
{
    /**
     *
     * Pour
     * @Route("/", name="index")
     */
    public function index(Client $client)
    {
        return $this->json(array("Welcome"));

    }


    /**
     * @param Request $request
     * @Route("/calculate/distance", name="calculate_distance")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Exception
     */
    public function distanceBetween2Points(Request $request)
    {
        $content = $request->getContent();
        $data= json_decode($content);
        if($data==null)
            throw new \Exception("distanceBetween2Points: data is null or malformed ");

        if(!isset($data->points))
            throw new \Exception("distanceBetween2Points: data is null or malformed : Array Points is invalid or null ");

        if(!is_array($data->points))
            throw new \Exception("distanceBetween2Points: data is null or malformed : Array Points is invalid or null ");

        if(count($data->points)<2 or count($data->points)>2)
            throw new \Exception("distanceBetween2Points: required exactly two points");

        $distance=Calculator::calculeDistanceByGeoPoints(
            new Point($data->points[0]->lat,$data->points[0]->lng),
            new Point($data->points[1]->lat,$data->points[1]->lng)
        );
        return $this->json(array("distance"=>$distance));
    }
}
