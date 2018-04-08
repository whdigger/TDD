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
}

// $array = new SplObjectStorage();