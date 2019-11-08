<?php


namespace App\Utils;


use App\Model\Point;

class Calculator
{

    const EARTH_RADIUS=6378137; // rayon de la terre en mettre

    /**
     * @param Point $pointA
     * @param Point $pointB
     * @return float;
     */
    public static function calculeDistanceByGeoPoints(Point $pointA,Point $pointB)
    {
        $rlo1 = deg2rad($pointA->getLongitude());
        $rla1 = deg2rad($pointA->getLatitude());
        $rlo2 = deg2rad($pointB->getLongitude());
        $rla2 = deg2rad($pointB->getLatitude());
        $dlo = ($rlo2 - $rlo1) / 2;
        $dla = ($rla2 - $rla1) / 2;
        $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo));
        $d = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $meter = (self::EARTH_RADIUS * $d);
        return $meter / 1000;

    }


}