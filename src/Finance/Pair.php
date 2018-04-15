<?php

namespace Finance;

class Pair
{
    public $from;
    public $to;
    
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }
    
    public function equals(Pair $pair)
    {
        return $this->from == $pair->from && $this->to == $pair->to;
    }
    
    public function hashCode()
    {
        return 0;
    }
}