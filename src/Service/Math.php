<?php

declare(strict_types=1);

namespace Calculation\CommissionTask\Service;

class Math
{
    private $scale;

    public function __construct(int $scale)
    {
        $this->scale = $scale;
    }

    public function add(string $leftOperand, string $rightOperand): string
    {
        return bcadd($leftOperand, $rightOperand, $this->scale);
    }

    public function roundUp($number)
    {
        $pow = pow(10, $this->scale);

        return number_format(ceil($number * $pow) / $pow, $this->scale);
    }
}
