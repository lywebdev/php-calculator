<?php

declare(strict_types=1);

namespace unit;

use App\Services\CalculatorService;
use Exception;
use PHPUnit\Framework\TestCase;

final class CalculatorServiceTest extends TestCase
{
    private CalculatorService $calculatorService;

    protected function setUp(): void
    {
        $this->calculatorService = new CalculatorService();
    }

    public function testAddition()
    {
        $this->assertEquals(10.0, $this->calculatorService->addition(5.5, 4.5));
        $this->assertEquals(-1.0, $this->calculatorService->addition(-5.0, 4.0));
        $this->assertEquals(1.0, $this->calculatorService->addition(5.0, -4.0));

        $this->assertEquals(5.0, $this->calculatorService->addition(5.0, 0.0));
        $this->assertEquals(0.0, $this->calculatorService->addition(0.0, 0.0));

        $this->assertEquals(5.5, $this->calculatorService->addition(2.5, 3.0));
        $this->assertEquals(-3.5, $this->calculatorService->addition(-1.5, -2.0));
        $this->assertEquals(4.5, $this->calculatorService->addition(2.5, 2.0));

        $this->assertEquals(PHP_INT_MAX + 1.0, $this->calculatorService->addition(PHP_INT_MAX, 1.0));

        $this->assertEquals(0.0, $this->calculatorService->addition(2.5, -2.5));
        $this->assertEquals(3.3, $this->calculatorService->addition(1.1, 2.2));
    }

    public function testSubtraction(): void
    {
        $this->assertEquals(1.1, $this->calculatorService->subtraction(3.3, 2.2));
        $this->assertEquals(0.0, $this->calculatorService->subtraction(2.0, 2.0));

        $this->assertEquals(-1.0, $this->calculatorService->subtraction(2.0, 3.0));
    }

    public function testMultiple(): void
    {
        $this->assertEquals(6.0, $this->calculatorService->multiple(2.0, 3.0));
        $this->assertEquals(0.0, $this->calculatorService->multiple(0.0, 3.0));

        $this->assertEqualsWithDelta(2.42, $this->calculatorService->multiple(1.1, 2.2), 0.0001, '');
    }

    /**
     * @throws Exception
     */
    public function testDivision(): void
    {
        $this->assertEquals(2.0, $this->calculatorService->division(6.0, 3.0));

        $this->assertEqualsWithDelta(1.1, $this->calculatorService->division(2.42, 2.2), 0.0001, '');

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Division by zero');
        $this->calculatorService->division(5.0, 0.0);
    }
}