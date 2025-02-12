<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Validators\addSaleItemValidator;
use PHPUnit\Framework\Attributes\DataProvider;

class addSaleItemValidatorTest extends TestCase
{
    #[DataProvider('validationDataProvider')]
    public function testValidation(array $input, bool $expectedResult): void
    {
        $validator = new addSaleItemValidator();
        $result = $validator->validate($input);
        $this->assertSame($expectedResult, $result);
    }

    public static function validationDataProvider(): array
    {
        return [
            'valid data' => [
                ['id' => '1', 'productName' => 'example product name', 'costPrice' => '111' ,  'totalPrice' => '500', 'sellPrice' => '200', 'quantity' => '2'],
                true,
            ],
            'missing id' => [
                ['totalPrice' => '500', 'sellPrice' => '200', 'quantity' => '2'],
                false,
            ],
            'missing totalPrice' => [
                ['id' => '1', 'sellPrice' => '200', 'quantity' => '2'],
                false,
            ],
            'missing sellPrice' => [
                ['id' => '1', 'totalPrice' => '500', 'quantity' => '2'],
                false,
            ],
            'missing quantity' => [
                ['id' => '1', 'totalPrice' => '500', 'sellPrice' => '200'],
                false,
            ],
            'id is not numeric' => [
                ['id' => 'abc', 'totalPrice' => '500', 'sellPrice' => '200', 'quantity' => '2'],
                false,
            ],
            'totalprice is not numeric' => [
                ['id' => '1', 'totalPrice' => 'abc', 'sellPrice' => '200', 'quantity' => '2'],
                false,
            ],
            'sellprice is not numeric' => [
                ['id' => '1', 'totalPrice' => '500', 'sellPrice' => 'abc', 'quantity' => '2'],
                false,
            ],
            'quantity is not numeric' => [
                ['id' => '1', 'totalPrice' => '500', 'sellPrice' => '200', 'quantity' => 'abc'],
                false,
            ],
            'negative totalPrice' => [
                ['id' => '1', 'totalPrice' => '-500', 'sellPrice' => '200', 'quantity' => '2'],
                false,
            ],
            'zero totalPrice' => [
                ['id' => '1', 'totalPrice' => '0', 'sellPrice' => '200', 'quantity' => '2'],
                false,
            ],
            'quantity is zero' => [
                ['id' => '1', 'totalPrice' => '500', 'sellPrice' => '200', 'quantity' => '0'],
                false,
            ],
            'quantity is negative' => [
                ['id' => '1', 'totalPrice' => '500', 'sellPrice' => '200', 'quantity' => '-2'],
                false,
            ],
            'zero costPrice' => [
                ['id' => '1', 'productName' => 'example product name', 'costPrice' => '0' ,  'totalPrice' => '500', 'sellPrice' => '200', 'quantity' => '2'],
                false,
            ],
            'empty costPrice' => [
                ['id' => '1', 'productName' => 'example product name', 'costPrice' => '' ,  'totalPrice' => '500', 'sellPrice' => '200', 'quantity' => '2'],
                false,
            ],
            'missing productName' => [
                ['id' => '1', 'costPrice' => '111' ,  'totalPrice' => '500', 'sellPrice' => '200', 'quantity' => '2'],
                false,
            ],
            'empty productName' => [
                ['id' => '1', 'productName' => '', 'costPrice' => '111' ,  'totalPrice' => '500', 'sellPrice' => '200', 'quantity' => '2'],
                false,
            ],
        ];
    }
}
