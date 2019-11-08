<?php


namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsPostalAddress extends  Constraint
{
    public $message = 'Le format de l\'addresse: "{{ string }}" est incorrecte';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }

}