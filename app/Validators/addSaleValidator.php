<?php 

namespace App\Validators;

class addSaleValidator extends baseValidator
{

    public function validate(array $data) : bool
    {
        $whitelist = ['customer_name', 'customer_phone', 'sale_date', 'total_price'];


        if (array_diff(array_keys($data), $whitelist) || array_diff($whitelist, array_keys($data))) {
            $this->addError('اطلاعات ارسال شده صحیح نیست');
            return !$this->hasError();
        }

        $this->validateCustomer($data['customer_name'] ?? null);
        $this->validatePhone($data['customer_phone']);
        $this->validateDate($data['sale_date'] ?? null);
        $this->validateTotalPrice($data['total_price'] ?? null);

        return !$this->hasError();
    }

    private function validateCustomer(?string $customer) : void
    {
        if ($customer === null || trim($customer) === '') {
            $this->addError('وارد کردن نام مشتری الزامی است.');
        }
    }

    private function validatePhone(?string $phone) : void
    {   
        if (!empty($phone)) {

            if (!is_numeric($phone) || strlen($phone) != 11) {
                $this->addError('شماره تلفن وارد شده صحیح نیست.');
            } 
        }

    }

    private function validateDate(?string $date) : void
    {
        if (!is_numeric($date) || empty($date)) {
            $this->addError('وارد کردن تاریخ فروش الزامی است.');
        }
    }

    private function validateTotalPrice(?string $totalPrice) : void
    {
        if (!is_numeric($totalPrice) || $totalPrice <= 0) {
            $this->addError('وارد کردن محصول الزامیست');
        }
    }



}