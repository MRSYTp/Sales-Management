<?php
namespace App\Validators;

class addProductValidator extends baseValidator
{

    public function validate(array $data) : bool
    {
        $this->validateName($data['name'] ?? null);
        $this->validateCostPrice($data['cost_price'] ?? null);
        $this->validateSellPrice($data['sell_price'] ?? null);
        $this->validatePriceRelation($data['cost_price'] ?? null, $data['sell_price'] ?? null);

        return !$this->hasError();
    }


    private function validateName(?string $name): void
    {
        if ($name === null || trim($name) === '') {
            $this->addError('وارد کردن نام محصول الزامی است.');
        }
    }

    private function validateCostPrice($costPrice): void
    {
        if ($costPrice === null || !is_numeric($costPrice)) {
            $this->addError('قیمت خرید باید یک عدد معتبر باشد.');
        } elseif ($costPrice <= 0) {
            $this->addError('قیمت خرید باید بزرگتر از صفر باشد.');
        }
    }

    private function validateSellPrice($sellPrice): void
    {
        if ($sellPrice === null || !is_numeric($sellPrice)) {
            $this->addError('قیمت فروش باید یک عدد معتبر باشد.');
        } elseif ($sellPrice <= 0) {
            $this->addError('قیمت فروش باید بزرگتر از صفر باشد.');
        }
    }


    private function validatePriceRelation($costPrice, $sellPrice): void
    {
        if ($costPrice !== null && $sellPrice !== null && is_numeric($costPrice) && is_numeric($sellPrice)) {
            if ($sellPrice < $costPrice) {
                $this->addError('قیمت فروش نباید کمتر از قیمت خرید باشد.');
            }
        }
    }
}
