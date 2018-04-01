<?php

namespace Framework\Http;

class Request
{
    public function getQueryParams(): array
    {
        return $_GET;
    }
    
    public function getParserBody()
    {
        return $_POST ?: null;
    }
}