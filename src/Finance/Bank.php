<?php

namespace Finance;

class Bank
{
    private $rates;
    
    public function __construct()
    {
        $this->rates = new PairStorage();
    }
    
    public function reduce(IExpression $source, string $to)
    {
        return $source->reduce($this, $to);
    }
    
    public function rate(string $from, string $to)
    {
        if ($from == $to) {
            return 1;
        }
        
        $pair = new Pair($from, $to);
        
        return $this->rates[$pair];
    }
    
    public function addRate(string $from, string $to, int $rate)
    {
        $pair = new Pair($from, $to);
        $this->rates[$pair] = $rate;
    }
}