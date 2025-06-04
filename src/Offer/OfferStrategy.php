<?php

namespace App\Offer;

use App\Offer\OfferStrategyInterface;
use App\Product;
use Brick\Math\RoundingMode;
use Brick\Money\Money;

class OfferStrategy implements OfferStrategyInterface
{
    public function getDiscount(array $products): Money
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

        $discountPrice = Money::of(0, 'USD');
        $count = count($r01s);
        for ($i = 0; $i < $count; $i++) {
            $price = $r01s[$i]->price;
            if($i === 1) { //since key 1 is the 2nd instance
                $discountPrice = $discountPrice->plus(
                    $price->multipliedBy(0.5, RoundingMode::UP)
                );
            }
        }

        return $discountPrice;
    }
}