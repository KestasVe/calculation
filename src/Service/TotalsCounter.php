<?php

declare(strict_types=1);

namespace Calculation\CommissionTask\Service;

class TotalsCounter
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getTotalData()
    {
        $converterOne = new CurrencyConverter();
        $totalData = [];

        foreach ($this->data as $elem) {
            $userID = $elem[1];
            $userAmount = $converterOne->convertToEur($elem[4], $elem[5]);
            $currency = $elem[5];
            $userCashoutsCount = $elem[6];

            if ($userCashoutsCount > 0) {
                $total[$userID] += $userAmount;
                array_push($elem, $total[$userID]);
            } else {
                $total[$userID] = $userAmount;
                array_push($elem, $total[$userID]);
            }
            array_push($totalData, $elem);
        }

        return $totalData;
    }
}
