<?php

namespace Finance;

class Bank
{
    public function reduce(IExpression $source, string $to)
    {
        return $source->reduce($this, $to);
    }
    
    public function rate(string $from, string $to)
    {
        return $from == 'CHF' && $to == 'USD'? 2 : 1;
    }
}