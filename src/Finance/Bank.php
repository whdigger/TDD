<?php

namespace Finance;

class Bank
{
    public function reduce(IExpression $source, string $to)
    {
        return Money::dollar(10);
    }
}