<?php

declare(strict_types=1);

namespace Calculation\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use Calculation\CommissionTask\Service\CurrencyConverter;

class CurrencyConverterTest extends TestCase
{
    /**
     * @var CurrencyConverter
     */
    private $currencyConverter;

    public function setUp()
    {
        $this->currencyConverter = new CurrencyConverter();
    }

    /**
     * @dataProvider dataProviderForConvertToEurTesting
     */
    public function testConvertToEur($amount, $currency, $expectation)
    {
        $this->assertEquals(
            $expectation,
            $this->currencyConverter->convertToEur($amount, $currency)
        );
    }

    public function dataProviderForConvertToEurTesting(): array
    {
        return [
            'convert from JPY to EUR' => ['129.53', 'JPY', '1'],
            'convert from USD to EUR' => ['114.97', 'USD', '100'],
            'convert from EUR to EUR' => ['10', 'EUR', '10'],
        ];
    }

    /**
     * @dataProvider dataProviderForConvertFromEurTesting
     */
    public function testConvertFromEur($amount, $currency, $expectation)
    {
        $this->assertEquals(
            $expectation,
            $this->currencyConverter->convertFromEur($amount, $currency)
        );
    }

    public function dataProviderForConvertFromEurTesting(): array
    {
        return [
            'convert from EUR to JPY' => ['100', 'JPY', '12953'],
            'convert from EUR to USD' => ['100', 'USD', '114.97'],
            'convert from EUR to EUR' => ['10', 'EUR', '10.00'],
        ];
    }
}
