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
     * @return Dollar
     */
    public static function dollar(int $amount): Dollar
    {
        return new Dollar($amount, 'USD');
    }
    
    /**
     * @param int $amount
     *
     * @return Franc
     */
    public static function franc(int $amount): Franc
    {
        return new Franc($amount, 'CHF');
    }
    
    public function __toString()
    {
        return $this->amount . ' ' . $this->currency;
    }
}