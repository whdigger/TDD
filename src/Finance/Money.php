<?php

namespace Finance;

abstract class Money
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
            get_class($this) == get_class($money);
    }
    
    abstract public function times(int $multiplier);
    
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
}