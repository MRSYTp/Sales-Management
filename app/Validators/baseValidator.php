<?php 

namespace App\Validators;

use App\Interfaces\ValidatorInterface;

class baseValidator implements ValidatorInterface
{
    private array $errors = [];

    protected function addError(string $value) : void
    {
        $this->errors[] = $value;

    }

    public function getErrors() : array
    {
        return $this->errors;

    }

    protected function hasError() : bool
    {
        return !empty($this->errors);
    }

    public function validate(array $data): bool
    {
        return false;
    }

}