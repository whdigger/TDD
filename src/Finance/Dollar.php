<?php

namespace Finance;

class Dollar
{
    private $amount;
    
    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }
    
    public function times(int $multiplier)
    {
        return new $this($this->amount * $multiplier);
    }
    
    public function equals($object)
    {
        return $this->amount == $object->amount;
    }
}