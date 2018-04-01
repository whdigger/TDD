<?php

namespace Finance;

class Dollar
{
    public $amount;
    
    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }
    
    public function times(int $multiplier)
    {
        return new $this($this->amount * $multiplier);
    }
}