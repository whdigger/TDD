<?php

namespace Finance;

class Money
{
    protected $amount;
    protected $currency;
    
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
}