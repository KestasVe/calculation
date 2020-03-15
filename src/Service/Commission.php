<?php

declare(strict_types=1);

namespace Calculation\CommissionTask\Service;

class Commission
{
    private $data;
    private $cashinFee = 0.03;
    private $maxCashinFee = 5;
    private $cashoutFee = 0.3;
    private $freeOfChargeCashout = 1000;
    private $freeCashoutOperations = 3;
    private $minimalLegalFee = 0.5;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getCommissions()
    {
        $mathOne = new Math(2);
        $converterOne = new CurrencyConverter();

        foreach ($this->data as $elem) {
            $userID = $elem[1];
            $currency = $elem[5];

            if ($elem[3] === 'cash_out' && $elem[2] === 'natural') {
                if (isset($feePaid[$userID])) { //check if user have already paid some commissions this week
                    if ($elem[6] <= $this->freeCashoutOperations && $elem[7] <= $this->freeOfChargeCashout) {
                        $fee = $mathOne->roundUp(0);
                        $feePaid[$userID] = $fee;
                    } elseif ($elem[6] > $this->freeCashoutOperations && $elem[7] <= $this->freeOfChargeCashout) {
                        $fee = $mathOne->roundUp($this->cashoutFee / 100 * $elem[4] - $feePaid[$userID]);
                        $feePaid[$userID] = $fee;
                    } elseif ($elem[6] <= $this->freeCashoutOperations && $elem[7] > $this->freeOfChargeCashout) {
                        $fee = $mathOne->roundUp($this->cashoutFee / 100 * ($elem[7] - $this->freeOfChargeCashout) - $feePaid[$userID]);
                        $feePaid[$userID] += $fee;
                    }
                } else {
                    if ($elem[6] <= $this->freeCashoutOperations && $elem[7] <= $this->freeOfChargeCashout) {
                        $fee = $mathOne->roundUp(0);
                        $feePaid[$userID] = $fee;
                    } elseif ($elem[6] > $this->freeCashoutOperations && $elem[7] <= $this->freeOfChargeCashout) {
                        $fee = $mathOne->roundUp($this->cashoutFee / 100 * $elem[4]);
                        $feePaid[$userID] = $fee;
                    } elseif ($elem[6] <= $this->freeCashoutOperations && $elem[7] > $this->freeOfChargeCashout) {
                        $fee = $mathOne->roundUp($this->cashoutFee / 100 * ($elem[7] - $this->freeOfChargeCashout));
                        $feePaid[$userID] = $fee;
                    }
                }
            } elseif ($elem[3] === 'cash_out' && $elem[2] === 'legal') {
                $fee = $mathOne->roundUp($this->cashoutFee / 100 * $elem[4]);
                $fee > $this->minimalLegalFee ? $fee : $fee = $mathOne->roundUp($this->minimalLegalFee);
            } else {
                $fee = $mathOne->roundUp($this->cashinFee / 100 * $elem[4]);
                $fee < $this->maxCashinFee ? $fee : $fee = $mathOne->roundUp($this->maxCashinFee);
            }
            echo $converterOne->convertFromEur($fee, $currency).PHP_EOL;
        }
    }
}
