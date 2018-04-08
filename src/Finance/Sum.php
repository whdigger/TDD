<?php

namespace Finance;


class Sum implements IExpression
{
    /**
     * @var Money
     */
    public $augend;
    
    /**
     * @var Money
     */
    public $addend;
    
    public function __construct(Money $augend, Money $addend)
    {
        $this->augend = $augend;
        $this->addend = $addend;
    }
    
    public function reduce(Bank $bank, string $to)
    {
        $amount = $this->augend->amount + $this->addend->amount;
        return new Money($amount, $to);
    }
}