<?php

namespace Finance;

abstract class Money
{
    protected $amount;
    
    public function equals(Money $money)
    {
        return
            $this->amount == $money->amount &&
            get_class($this) == get_class($money);
    }
    
    abstract public function times(int $multiplier);
    
    /**
     * @param int $amount
     *
     * @return Dollar
     */
    public static function dollar(int $amount)
    {
        return new Dollar($amount);
    }
    
    /**
     * @param int $amount
     *
     * @return Franc
     */
    public static function franc(int $amount)
    {
        return new Franc($amount);
    }
    
}