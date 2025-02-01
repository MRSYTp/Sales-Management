<?php 


namespace App\Interfaces;

interface ValidatorInterface
{

    public function validate(array $data) :  bool;
    public function getErrors() : array;
    
}