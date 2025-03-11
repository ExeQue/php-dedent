<?php

namespace ExeQue\Dedent;

function dedent(string $string, int $tabWidth = 4): string
{
    return Dedent::dedent($string, $tabWidth);
}