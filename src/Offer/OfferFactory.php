<?php 

namespace App\Offer;

use App\Offer\OfferStrategyInterface;
use App\Offer\BuyOneRedGetSecondHalfPriceOffer;

class OfferFactory
{
    public static function create(string $className): OfferStrategyInterface
    {
        $className = __NAMESPACE__ . '\\' . $className;
        
        if (!class_exists($className)) {
            throw new \InvalidArgumentException("Offer class $className not found.");
        }

        $offer = new $className();
        if (! $offer instanceof OfferStrategyInterface) {
            throw new \LogicException("$className must implement OfferStrategyInterface");
        }

        return $offer;
    }
}