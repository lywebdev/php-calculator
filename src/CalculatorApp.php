<?php

declare(strict_types=1);

namespace App;

use App\Services\CalculatorService;
use App\Services\CLIHelperService;
use Exception;

final class CalculatorApp
{
    private CalculatorService $calculatorService;

    private CLIHelperService $cliHelperService;

    private const string OPERATION_ADDITION = '+';

    private const string OPERATION_SUBTRACTION = '-';

    private const string OPERATION_DIVISION = '/';

    private const string OPERATION_MULTIPLE = '*';

    private const array OPERATIONS = [
        self::OPERATION_ADDITION,
        self::OPERATION_SUBTRACTION,
        self::OPERATION_DIVISION,
        self::OPERATION_MULTIPLE,
    ];


    public function __construct()
    {
        $this->calculatorService = new CalculatorService();
        $this->cliHelperService = new CLIHelperService();
    }

    public function start(): void
    {
        echo "Welcome to the PHP calculator by Kulik Leonid!\n";
        $result = null;

        while (true) {
            if ($result === null) {
                $firstNumber = $this->requestFirstNumber();
            } else {
                $firstNumber = $result;
            }

            $operation = $this->requestOperation();

            $secondNumber = $this->requestSecondNumber();
            $result = null;

            switch ($operation) {
                case self::OPERATION_ADDITION:
                    $result = $this->calculatorService->addition($firstNumber, $secondNumber);
                    break;
                case self::OPERATION_SUBTRACTION:
                    $result = $this->calculatorService->subtraction($firstNumber, $secondNumber);
                    break;
                case self::OPERATION_DIVISION:
                    try {
                        $result = $this->calculatorService->division($firstNumber, $secondNumber);
                    } catch (Exception) {
                        echo "You can't divide by zero!\n";
                        continue 2;
                    }
                    break;
                case self::OPERATION_MULTIPLE:
                    $result = $this->calculatorService->multiple($firstNumber, $secondNumber);
                    break;
            }

            echo $result;
            echo "\n";
            $this->cliHelperService->confirmation('Do you want to continue?');
        }
    }

    private function requestFirstNumber(): float
    {
        echo 'Please enter your first number: ';
        $firstNumber = $this->cliHelperService->textInput();

        return (float) $firstNumber;
    }

    private function requestSecondNumber(): float
    {
        echo 'Please enter your second number: ';
        $secondNumber = $this->cliHelperService->textInput();

        return (float) $secondNumber;
    }

    private function requestOperation(): string
    {
        echo "Enter operation (+, -, /, *): ";

        $operation = $this->cliHelperService->textInput();
        if (!in_array($operation, self::OPERATIONS)) {
            echo "Unsupported operator, try again!\n";
            $operation = $this->requestOperation();
        }

        return $operation;
    }
}