<?php

use Finance\Bank;
use Finance\Money;
use Finance\Sum;
use PHPUnit\Framework\TestCase;

class BankTest extends TestCase
{
    public function testSimpleAddition()
    {
        $five = Money::dollar(5);
        $sum = $five->plus($five);
        $bank = new Bank;
        $reduced = $bank->reduce($sum, 'USD');
        $this->assertEquals(Money::dollar(10), $reduced);
    }
    
    public function testReduceSum()
    {
        $sum = new Sum(Money::dollar(3), Money::dollar(4));
        $bank = new Bank;
        $result = $bank->reduce($sum, 'USD');
        $this->assertTrue(Money::dollar(7)->equals($result));
    }
    
    public function testReduceMoney()
    {
        $bank = new Bank;
        $result = $bank->reduce(Money::dollar(1), 'USD');
        $this->assertTrue(Money::dollar(1)->equals($result));
    }
    
    public function testReduceMoneyDifferentCurrency()
    {
        $bank = new Bank;
        $bank->addRate('CHF', 'USD', 2);
        
        $result = $bank->reduce(Money::franc(2), 'USD');
        $this->assertEquals(Money::dollar(1), $result);
        // fwrite(STDERR, print_r($this->currency . ' ' . $to, TRUE));
    }
    
    public function testIdentityRate()
    {
        $this->assertEquals(1, (new Bank())->rate('USD', 'USD'));
    }
    
    public function testMixedAddition()
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);
        
        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);
        $result = $bank->reduce($fiveBucks->plus($tenFrancs), 'USD');
        $this->assertEquals(Money::dollar(10), $result);
    }
}