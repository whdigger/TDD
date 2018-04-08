<?php

namespace Finance;

interface IExpression
{
    public function reduce(string $to);
}