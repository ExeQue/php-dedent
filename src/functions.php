<?php

use ExeQue\Dedent\Dedent;

if (function_exists('dedent') === false) {
    function dedent(string $string, int $tabWidth = 4): string
    {
        return Dedent::dedent($string, $tabWidth);
    }
}