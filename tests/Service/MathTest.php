<?php

declare(strict_types=1);

namespace Calculation\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use Calculation\CommissionTask\Service\Math;

class MathTest extends TestCase
{
    /**
     * @var Math
     */
    private $math;

    public function setUp()
    {
        $this->math = new Math(2);
    }

    /**
     * @param string $leftOperand
     * @param string $rightOperand
     * @param string $expectation
     *
     * @dataProvider dataProviderForAddTesting
     */
    public function testAdd(string $leftOperand, string $rightOperand, string $expectation)
    {
        $this->assertEquals(
            $expectation,
            $this->math->add($leftOperand, $rightOperand)
        );
    }

    public function dataProviderForAddTesting(): array
    {
        return [
            'add 2 natural numbers' => ['1', '2', '3'],
            'add negative number to a positive' => ['-1', '2', '1'],
            'add natural number to a float' => ['1', '1.05123', '2.05'],
        ];
    }

    /**
     * @dataProvider dataProviderForRoundUpTesting
     */
    public function testRoundUp($number, $expectation)
    {
        $this->assertEquals(
            $expectation,
            $this->math->roundUp($number)
        );
    }

    public function dataProviderForRoundUpTesting(): array
    {
        return [
            'round up 0.023' => ['0.023', '0.03'],
            'round up 1.111' => ['1.111', '1.12'],
        ];
    }
}
