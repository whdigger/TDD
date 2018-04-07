<?php

namespace Finance;

class Dollar extends Money
{
    public function __construct(int $amount, string $currency)
    {
        parent::__construct($amount,$currency);
    }
    
    public function times(int $multiplier)
    {
        return self::dollar($this->amount * $multiplier);
    }
}