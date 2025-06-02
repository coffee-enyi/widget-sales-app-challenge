<?php

namespace App;

use Brick\Money\Money;

class Product
{
    public function __construct(
        public string $code,
        public string $name,
        public Money $price
    ) {}
}