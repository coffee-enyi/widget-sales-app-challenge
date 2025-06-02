<?php

namespace App\Delivery;

use App\Delivery\DeliveryStrategyInterface;
use Brick\Money\Money;

class DeliveryStrategy implements DeliveryStrategyInterface
{
    public function getDeliveryFee(Money $subtotal): Money
    {
        if ($subtotal->isLessThan(Money::of(50, 'USD'))) {
            return Money::of(4.95, 'USD');
        }

        if ($subtotal->isLessThan(Money::of(90, 'USD'))) {
            return Money::of(2.95, 'USD');
        }

        return Money::of(0, 'USD');
    }
}