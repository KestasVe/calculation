<?php

declare(strict_types=1);

namespace Calculation\CommissionTask\Service;

class OperationsCounter
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getCountData()
    {
        $countData = [];

        foreach ($this->data as $elem) {
            $transactionWeek = date('oW', strtotime($elem[0]));
            $userID = $elem[1];
            $operationType = $elem[3];

            if ($operationType === 'cash_out') {
                if (isset($count[$userID]) && isset($week[$userID])) {
                    if ($week[$userID] === $transactionWeek) {
                        $week[$userID] = $transactionWeek;
                        ++$count[$userID];
                        array_push($elem, $count[$userID]);
                    } else {
                        $week[$userID] = $transactionWeek;
                        $count[$userID] = 0;
                        array_push($elem, $count[$userID]);
                    }
                } else {
                    $count[$userID] = 0;
                    $week[$userID] = $transactionWeek;
                    array_push($elem, $count[$userID]);
                }
            } elseif ($operationType === 'cash_in') {
                array_push($elem, 0);
            }
            array_push($countData, $elem);
        }

        return $countData;
    }
}
