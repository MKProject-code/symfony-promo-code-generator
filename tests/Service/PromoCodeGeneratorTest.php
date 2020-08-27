<?php

namespace App\Tests\Service;

use App\Service\PromoCodeGenerator;
use PHPUnit\Framework\TestCase;

class PromoCodeGeneratorTest extends TestCase
{
    public function testGenerateRandomCodes(): void
    {
        $promoCodeGenerator = new PromoCodeGenerator();

        $result = $promoCodeGenerator->generateRandomCodes(true, 40, 32);
        self::assertIsArray($result);
        self::assertContainsOnly('string', $result);
        self::assertCount(32, $result);
        foreach ($result as $code) {
            self::assertEquals(40, strlen($code));
            self::assertTrue(ctype_alnum($code));
        }

        $result = $promoCodeGenerator->generateRandomCodes(false, 55, 25);
        self::assertIsArray($result);
        self::assertContainsOnly('string', $result);
        self::assertCount(25, $result);
        foreach ($result as $code) {
            self::assertEquals(55, strlen($code));
            self::assertTrue(ctype_digit($code));
        }
    }
}
