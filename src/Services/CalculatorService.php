<?php

declare(strict_types=1);

namespace App\Services;

use Exception;

final class CalculatorService
{
    public function addition(float $firstNumber, float $secondNumber): float
    {
        return round($firstNumber + $secondNumber, 4);
    }

    public function subtraction(float $firstNumber, float $secondNumber): float
    {
        return round($firstNumber - $secondNumber, 4);
    }

    public function multiple($firstNumber, float $secondNumber): float
    {
        return round($firstNumber * $secondNumber, 4);
    }

    /**
     * @throws Exception
     */
    public function division(float $firstNumber, float $secondNumber): float
    {
        if ($secondNumber == 0) {
            throw new Exception('Division by zero');
        }

        return round($firstNumber / $secondNumber, 4);
    }
}