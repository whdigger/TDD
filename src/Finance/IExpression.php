<?php

namespace Finance;

interface IExpression
{
    public function reduce(Bank $bank, string $to);
}