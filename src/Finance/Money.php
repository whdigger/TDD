<?php

namespace Finance;

class Money implements IExpression
{
    public $amount;
    public $currency;
    
    public function __construct(int $amount, string $currency)
    {
        $this->currency = $currency;
        $this->amount = $amount;
    }
    
    public function equals(Money $money)
    {
        return
            $this->amount == $money->amount &&
            $this->currency == $money->currency;
    }
    
    public function times(int $multiplier)
    {
        return new static($this->amount * $multiplier, $this->currency);
    }
    
    /**
     * @param Money $addend
     *
     * @return IExpression
     */
    public function plus(Money $addend): IExpression
    {
        return new Sum($this, $addend);
    }
    
    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->currency;
    }
    
    /**
     * @param int $amount
     *
     * @return Money
     */
    public static function dollar(int $amount): Money
    {
        return new Money($amount, 'USD');
    }
    
    /**
     * @param int $amount
     *
     * @return Money
     */
    public static function franc(int $amount): Money
    {
        return new Money($amount, 'CHF');
    }
    
    public function reduce(Bank $bank, string $to)
    {
        $rate = $bank->rate($this->currency, $to);
        
        return new Money($this->amount / $rate, $to);
    }
}