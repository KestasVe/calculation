<?php

use Calculation\CommissionTask\Service\FileReader;
use Calculation\CommissionTask\Service\OperationsCounter;
use Calculation\CommissionTask\Service\TotalsCounter;
use Calculation\CommissionTask\Service\Commission;

require_once 'src/start.php';

$readerOne = new FileReader($argv[1]);
$data = $readerOne->getData();

$operationsCounterOne = new OperationsCounter($data);
$data = $operationsCounterOne->getCountData();

$totalsCounterOne = new TotalsCounter($data);
$data = $totalsCounterOne->getTotalData();

$commissionOne = new Commission($data);
$commissionOne->getCommissions();