<?php 

namespace App\Validators;

class addSaleItemValidator extends baseValidator
{

    public function validate(array $data) : bool
    {
        $whitelist = ['id', 'totalPrice', 'sellPrice', 'quantity'];

        if (array_diff(array_keys($data), $whitelist) || array_diff($whitelist, array_keys($data))) {
            $this->addError('اطلاعات ارسال شده صحیح نیست');
            return !$this->hasError();
        }

        $this->validateID($data['id'] ?? null);
        $this->validateTotalPrice($data['totalPrice'] ?? null);
        $this->validateSellPrice($data['sellPrice'] ?? null);
        $this->validateQuantity($data['quantity'] ?? null);

        return !$this->hasError();
    }


    private function validateID(?string $id) : void
    {
        if (!is_numeric($id) || empty($id) || $id <= 0) {
            $this->addError('داده وارد شده برای محصول صحیح نیست');
        }
    }

    private function validateTotalPrice(?string $totalPrice) : void
    {
        if (!is_numeric($totalPrice) || $totalPrice <= 0) {
            $this->addError('داده وارد شده برای محصول صحیح نیست');
        }
    }

    private function validateSellPrice(?string $sellPrice) : void
    {
        if (!is_numeric($sellPrice) || $sellPrice <= 0) {
            $this->addError('داده وارد شده برای محصول صحیح نیست');
        }
    }

    private function validateQuantity(?string $quantity) : void
    {
        if (!is_numeric($quantity) || $quantity <= 0) {
            $this->addError('داده وارد شده برای محصول صحیح نیست');
        }
    }

}