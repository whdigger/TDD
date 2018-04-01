<?php

use Finance\Franc;
use PHPUnit\Framework\TestCase;

class DollarTest extends TestCase
{
    public function testMultiplication(): void
    {
        $five = new Franc(5);
        $this->assertEquals(new Franc(10), $five->times(2));
        $this->assertEquals(new Franc(15), $five->times(3));
    }
    
    public function testEquality()
    {
        $this->assertTrue((new Franc(5))->equals(new Dollar(5)));
        $this->assertFalse((new Franc(5))->equals(new Dollar(6)));
    }
}
