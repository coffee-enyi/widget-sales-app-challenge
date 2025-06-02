<?php

namespace App;

use App\Delivery\DeliveryStrategyInterface;
use App\Offer\OfferStrategyInterface;
use Brick\Money\Money;

class Basket
{
    private array $items = [];

    public function __construct(
        private array $catalogue,
        private DeliveryStrategyInterface $delivery,
        private OfferStrategyInterface $offer
        ) {}

    public function add(string $code): void
    {
        if(isset($this->catalogue[$code]))
        {
            $this->items[] = $this->catalogue[$code];
        }
    }

    public function total(): Money
    {
        $products = $this->offer->apply($this->items);
        
        $subtotal = Money::of(0, 'USD');
        foreach($products as $p)
        {
            $subtotal = $subtotal->plus($p->price);
        }

        $deliveryFee = $this->delivery->getDeliveryFee($subtotal);
        
        return $subtotal->plus($deliveryFee);
    }
}