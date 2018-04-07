<?php

namespace Finance;

class Franc extends Money
{
    public function __construct(int $amount, string $currency)
    {
        parent::__construct($amount,$currency);
    }
    
    public function times(int $multiplier)
    {
        return self::franc($this->amount * $multiplier);
    }
}