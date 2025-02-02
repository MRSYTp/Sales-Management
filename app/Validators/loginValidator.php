<?php 

namespace App\Validators;

class loginValidator extends baseValidator{

    public function validate (array $params) : bool
    {
        $this->checkEmail($params['email']);
        $this->checkPassword($params['password']);
        return !$this->hasError();
    }

    public static function Validpassword(string $Currentpassword , string $DBPassword) : bool
    {
        return password_verify($Currentpassword , $DBPassword);
        
    }

    private function checkEmail(string $email) : void
    {
        if (empty($email)) {
            $this->addError('ایمیل را وارد کنید');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->addError('ایمیل وارد شده صحیح نیست');
        }
    }
    private function checkPassword(string $password) : void
    {
        if (empty($password)) {
            $this->addError('پسورد را وارد کنید');
        }
        if (strlen($password) < 6) {
            $this->addError('پسورد نباید کم تر از 6 حرف باشد');
        }
    }

}