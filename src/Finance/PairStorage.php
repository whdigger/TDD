<?php

namespace Finance;

class PairStorage extends \SplObjectStorage
{
    public function getHash($obj)
    {
        return $obj->from . $obj->to;
    }
}