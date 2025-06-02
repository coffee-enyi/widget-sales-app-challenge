<?php

namespace App\Offer;

use App\Product;

interface OfferStrategyInterface
{
    /**
     * @param Product[] $products
     * @return Product[] updated product list plus discounts
     */
    public function apply(array $products): array;
}