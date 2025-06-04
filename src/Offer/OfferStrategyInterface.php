<?php

namespace App\Offer;

use App\Product;
use Brick\Money\Money;

interface OfferStrategyInterface
{
    /**
     * @param Product[] $products
     * @return \Brick\Money\Money The calculated discount amount
     */
    public function getDiscount(array $products): Money;
}