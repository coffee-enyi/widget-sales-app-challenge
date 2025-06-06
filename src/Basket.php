<?php

namespace App;

use App\Delivery\DeliveryStrategyInterface;
use App\Offer\OfferStrategyInterface;
use App\Offer\OfferFactory;
use Brick\Money\Money;

class Basket
{
    /** @var Product[] */
    private array $items = [];

    /** @var OfferStrategyInterface[] */
    private array $offers = [];

    /**
     * @param Product[] $catalogue
     */
    public function __construct(
        private array $catalogue,
        private DeliveryStrategyInterface $delivery
        ) {}

    /**
     * @param string[] $offerClassNames
     */
    public function setOffers(array $offerClassNames): void
    {
        foreach($offerClassNames as $className) {
            $this->offers[] = OfferFactory::create($className);
        }
    }

    private function totalDiscountFromOffers(): Money
    {
        $totalDiscount = Money::of(0, 'USD');

        foreach($this->offers as $offer) {
            $totalDiscount = $totalDiscount->plus($offer->getDiscount($this->items));
        }

        return $totalDiscount;
    }

    public function add(string $code): void
    {
        if(isset($this->catalogue[$code]))
        {
            $this->items[] = $this->catalogue[$code];
        }
    }

    public function total(): Money
    {
        $subtotal = Money::of(0, 'USD');
        foreach($this->items as $p)
        {
            $subtotal = $subtotal->plus($p->price);
        }

        $subtotal = $subtotal->minus($this->totalDiscountFromOffers());

        $deliveryFee = $this->delivery->getDeliveryFee($subtotal);
        
        return $subtotal->plus($deliveryFee);
    }
}