<?php

use Finance\Bank;
use Finance\Money;
use Finance\Sum;
use PHPUnit\Framework\TestCase;

class SumTest extends TestCase
{
    public function testPlusReturnsSum()
    {
        $five = Money::dollar(5);
        $sum = $five->plus($five);
        $this->assertEquals($five, $sum->augend);
        $this->assertEquals($five, $sum->addend);
    }
    
    public function testSumPlusMoney()
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);
        
        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);
        $sum = (new Sum($fiveBucks, $tenFrancs))->plus($fiveBucks);
        $result = $bank->reduce($sum, 'USD');
        $this->assertEquals(Money::dollar(15), $result);
    }
    
    public function testSumTimesMoney()
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);
        
        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);
        $sum = (new Sum($fiveBucks, $tenFrancs))->times(2);
        $result = $bank->reduce($sum, 'USD');
        $this->assertEquals(Money::dollar(20), $result);
    }
}
