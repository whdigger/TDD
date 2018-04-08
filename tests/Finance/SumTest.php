<?php

use Finance\Money;
use PHPUnit\Framework\TestCase;

class SumTest extends TestCase
{
    public function testPlusReturnsSum()
    {
        $five = Money::dollar(5);
        $sum = $five->plus($five);
        $this->assertEquals($five, $sum->augend);
        $this->assertEquals($five, $sum->addend) ;
    }
}
