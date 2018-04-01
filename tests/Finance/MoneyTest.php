<?php

use Finance\Dollar;
use Finance\Franc;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testEquality()
    {
        $this->assertTrue((new Dollar(5))->equals(new Dollar(5)));
        $this->assertFalse((new Dollar(5))->equals(new Dollar(6)));
        $this->assertTrue((new Franc(5))->equals(new Dollar(5)));
        $this->assertFalse((new Franc(5))->equals(new Dollar(6)));
    }
}
