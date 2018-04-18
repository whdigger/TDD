<?php

namespace Finance;


class Sum implements IExpression
{
    /**
     * @var IExpression
     */
    public $augend;
    
    /**
     * @var IExpression
     */
    public $addend;
    
    public function __construct(IExpression $augend, IExpression $addend)
    {
        $this->augend = $augend;
        $this->addend = $addend;
    }
    
    public function reduce(Bank $bank, string $to)
    {
        $amount = $this->augend->reduce($bank, $to)->amount + $this->addend->reduce($bank, $to)->amount;
        
        return new Money($amount, $to);
    }
    
    public function plus(IExpression $addend)
    {
        return null;
    }
}