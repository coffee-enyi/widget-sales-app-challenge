<?php

namespace App;

use App\Delivery\DeliveryStrategyInterface;
use App\Offer\OfferStrategyInterface;
use Brick\Money\Money;

class Basket
{
    /** @var Product[] */
    private array $items = [];

    /**
     * @param Product[] $catalogue
     */
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
        $subtotal = Money::of(0, 'USD');
        foreach($this->items as $p)
        {
            $subtotal = $subtotal->plus($p->price);
        }

        $offerDiscountAmt = $this->offer->getDiscount($this->items);

        $subtotal = $subtotal->minus($offerDiscountAmt);

        $deliveryFee = $this->delivery->getDeliveryFee($subtotal);
        
        return $subtotal->plus($deliveryFee);
    }
}