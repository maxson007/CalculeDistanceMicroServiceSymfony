<?php

namespace App\Controller;

use App\ApiProvider\CalculatorDistanceApi;
use App\ApiProvider\GeolocationApiGouv;
use App\ApiProvider\IPGeolocation;
use App\Form\CalculateDistanceDTO;
use App\Form\CalculateDistanceType;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     *
     * @Route("/", name="default")
     */
    public function index(Request $request, Client $client, CalculatorDistanceApi $calculatorDistanceApi)
    {

        $form = $this->createForm(CalculateDistanceType::class,new CalculateDistanceDTO());
        $distance=-2;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $dto = $form->getData();
            if(!$dto instanceof CalculateDistanceDTO)
                throw new \Exception();
            try{
                $reponse=$calculatorDistanceApi->getDistanceByIpAndPostalAdress($dto->ipAddress,$dto->postalAdress);
                $response=json_decode($reponse);
                $distance=$response->distance;
            }catch (\Exception $exception){
                $distance=-1;
            }

        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
            'distance'=>$distance
        ]);
    }
}
