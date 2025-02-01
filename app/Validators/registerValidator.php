<?php 

namespace App\Validators;

use App\Validators\baseValidator;

class registerValidator extends baseValidator {

    public function validate(array $data) : bool
    {
        $this->validateName($data['username']);

        $this->validateEmail($data['email']);

        $this->validatePassword($data['password']);

        $this->validateConfirmPassword($data['password'], $data['passwordConfirm']);

        return !$this->hasError();
    }


    private function validateName(string $username) : void
    {
        if (empty($username)) {
            $this->addError( 'اسم را وارد کنید ');
        }
        if (strlen($username) < 3) {
            $this->addError('اسم شما نباید کم تر از 3 حرف باشد');
        }
    }

    private function validateEmail(string $email) : void
    {
        if (empty($email)) {
            $this->addError( 'ایمیل را وارد کنید');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->addError( 'ایمیل وارد شده صحیح نیست');
        }
    }

    private function validatePassword(string $password) : void
    {
        if (empty($password)) {
            $this->addError('پسورد را وارد کنید');
        }
        if (strlen($password) < 6) {
            $this->addError('پسورد نباید کم تر از 6 حرف باشد');
        }
    }

    private function validateConfirmPassword(string $password, string $passwordConfirm) : void
    {
        if (empty($passwordConfirm)) {
            $this->addError('تکرار پسورد را وارد کنید');
        }
        if ($password !== $passwordConfirm) {
            $this->addError('پسورد و تکرار پسورد باید یکسان باشند');
        }
    }

}