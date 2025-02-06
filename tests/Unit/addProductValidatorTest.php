<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Validators\addProductValidator;

class AddProductValidatorTest extends TestCase
{
    #[DataProvider('validationDataProvider')]
    public function testValidation(array $input, bool $expectedResult): void
    {
        $validator = new addProductValidator();
        $result    =  $validator->validate($input);
        $this->assertSame($expectedResult, $result);
    }

    public static function validationDataProvider(): array
    {
        return [
            'valid data' => [
                ['name' => 'Product A', 'cost_price' => 100, 'sell_price' => 150],
                true,
            ],
            'missing name' => [
                ['cost_price' => 100, 'sell_price' => 150],
                false,
            ],
            'empty name' => [
                ['name' => '', 'cost_price' => 100, 'sell_price' => 150],
                false,
            ],
            'invalid cost price (not numeric)' => [
                ['name' => 'Product B', 'cost_price' => 'abc', 'sell_price' => 150],
                false,
            ],
            'zero cost price' => [
                ['name' => 'Product C', 'cost_price' => 0, 'sell_price' => 150],
                false,
            ],
            'negative cost price' => [
                ['name' => 'Product D', 'cost_price' => -10, 'sell_price' => 150],
                false,
            ],
            'invalid sell price (not numeric)' => [
                ['name' => 'Product E', 'cost_price' => 100, 'sell_price' => 'xyz'],
                false,
            ],
            'zero sell price' => [
                ['name' => 'Product F', 'cost_price' => 100, 'sell_price' => 0],
                false,
            ],
            'negative sell price' => [
                ['name' => 'Product G', 'cost_price' => 100, 'sell_price' => -50],
                false,
            ],
            'sell price less than cost price' => [
                ['name' => 'Product H', 'cost_price' => 150, 'sell_price' => 100],
                false,
            ],
        ];
    }
}
