<?php

declare(strict_types=1);

namespace Calculation\CommissionTask\Service;

class CurrencyConverter
{
    private $eurUsd = 1.1497;
    private $eurJpy = 129.53;

    public function convertToEur($amount, $currency)
    {
        if ($currency === 'EUR') {
            return $amount = $amount;
        } elseif ($currency === 'JPY') {
            return $amount = $amount / 129.53;
        } elseif ($currency === 'USD') {
            return $amount = $amount / 1.1497;
        }
    }

    public function convertFromEur($amount, $currency)
    {
        if ($currency === 'EUR') {
            return $amount = $amount;
        } elseif ($currency === 'JPY') {
            return $amount = round($amount * 129.53, 0);
        } elseif ($currency === 'USD') {
            return $amount = number_format($amount * 1.1497, 2);
        }
    }
}
