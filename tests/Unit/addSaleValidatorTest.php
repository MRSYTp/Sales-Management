<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Validators\addSaleValidator;

class AddSaleValidatorTest extends TestCase
{
    #[DataProvider('validationDataProvider')]
    public function testValidation(array $input, bool $expectedResult): void
    {
        $validator = new addSaleValidator();
        $result = $validator->validate($input);
        $this->assertSame($expectedResult, $result);
    }

    public static function validationDataProvider(): array
    {
        return [
            'valid data' => [
                ['customer_name' => 'Ali', 'customer_phone' => '09123456789', 'sale_date' => '1700000000', 'total_price' => '500'],
                true,
            ],
            'valid data without customer phone' => [
                ['customer_name' => 'Ali', 'customer_phone' => '', 'sale_date' => '1700000000', 'total_price' => '500'],
                true,
            ],
            'missing customer_name' => [
                ['customer_phone' => '09123456789', 'sale_date' => '1700000000', 'total_price' => '500'],
                false,
            ],
            'empty customer_name' => [
                ['customer_name' => '', 'customer_phone' => '09123456789', 'sale_date' => '1700000000', 'total_price' => '500'],
                false,
            ],
            'invalid phone (not numeric)' => [
                ['customer_name' => 'Ali', 'customer_phone' => 'abcd', 'sale_date' => '1700000000', 'total_price' => '500'],
                false,
            ],
            'invalid phone (wrong length)' => [
                ['customer_name' => 'Ali', 'customer_phone' => '09123', 'sale_date' => '1700000000', 'total_price' => '500'],
                false,
            ],
            'invalid sale_date (not numeric)' => [
                ['customer_name' => 'Ali', 'customer_phone' => '09123456789', 'sale_date' => 'abcd', 'total_price' => '500'],
                false,
            ],
            'zero total_price' => [
                ['customer_name' => 'Ali', 'customer_phone' => '09123456789', 'sale_date' => '1700000000', 'total_price' => '0'],
                false,
            ],
            'negative total_price' => [
                ['customer_name' => 'Ali', 'customer_phone' => '09123456789', 'sale_date' => '1700000000', 'total_price' => '-10'],
                false,
            ],
        ];
    }
}
