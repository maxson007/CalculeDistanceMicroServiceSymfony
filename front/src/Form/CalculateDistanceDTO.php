<?php


namespace App\Form;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints\ContainsPostalAddress;

final class CalculateDistanceDTO
{

    /**
     * IP V4
     * @Assert\NotBlank()
     * @Assert\Ip
     * @var string
     */
    public $ipAddress;

    /**
     * @Assert\NotBlank()
     * @ContainsPostalAddress()
     * @var string
     */
    public $postalAdress;
}