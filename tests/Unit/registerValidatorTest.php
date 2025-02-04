<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Validators\registerValidator;

final class RegisterValidatorTest extends TestCase
{


    #[DataProvider('validationDataProvider')]
    public function testValidation(array $input, bool $expectedResult): void
    {
        $validator = new registerValidator();
        $result    = $validator->validate($input);
        $this->assertSame($expectedResult, $result);
    }

    public static function validationDataProvider(): array
    {
        $baseData = [
            'username'        => 'TestUser',
            'email'           => 'test@example.com',
            'password'        => 'secret123',
            'passwordConfirm' => 'secret123',
        ];

        return [
            'valid data' => [
                $baseData,
                true,
            ],
            'extra key' => [
                array_merge($baseData, ['unexpected' => 'value']),
                false,
            ],
            'empty username' => [
                array_merge($baseData, ['username' => '']),
                false,
            ],
            'short username' => [
                array_merge($baseData, ['username' => 'ab']),
                false,
            ],
            'empty email' => [
                array_merge($baseData, ['email' => '']),
                false,
            ],
            'invalid email' => [
                array_merge($baseData, ['email' => 'invalid']),
                false,
            ],
            'empty password' => [
                array_merge($baseData, ['password' => '']),
                false,
            ],
            'short password' => [
                array_merge($baseData, ['password' => '123', 'passwordConfirm' => '123']),
                false,
            ],
            'empty passwordConfirm' => [
                array_merge($baseData, ['passwordConfirm' => '']),
                false,
            ],
            'mismatched passwords' => [
                array_merge($baseData, ['passwordConfirm' => 'differentPassword']),
                false,
            ],
        ];
    }
}
