<?php

namespace Finance;

class Money implements IExpression
{
    public $amount;
    private $currency;
    
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
    
    /**
     * @param int $multiplier
     *
     * @return IExpression
     */
    public function times(int $multiplier)
    {
        return new Money($this->amount * $multiplier, $this->currency);
    }
    
    /**
     * @param IExpression $addend
     *
     * @return IExpression
     */
    public function plus(IExpression $addend): IExpression
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
        $rate = $this->amount / $bank->rate($this->currency, $to);
        
        return new Money($rate, $to);
    }
}