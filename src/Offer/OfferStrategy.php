<?php

namespace App\Offer;

use App\Offer\OfferStrategyInterface;
use App\Product;
use Brick\Math\RoundingMode;

class OfferStrategy implements OfferStrategyInterface
{
    public function apply(array $products): array
    {
        $others = [];
        $r01s = [];

        foreach ($products as $product) {
            
            if ($product->code === 'R01') {
                $r01s[] = $product;
            } else {
                $others[] = $product;
            }
        }

        $discounted = [];
        $count = count($r01s);
        for ($i = 0; $i < $count; $i++) {
            $price = $r01s[$i]->price;
            if($i === 1) { //since key 1 is the 2nd instance
                $price = $price->multipliedBy(0.5, RoundingMode::DOWN);
            }
            $discounted[] = new Product('R01', 'Red Widget', $price);
        }

        return [...$others, ...$discounted];
    }
}