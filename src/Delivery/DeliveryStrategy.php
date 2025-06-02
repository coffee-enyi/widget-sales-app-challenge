<?php

namespace App\Delivery;

use App\Delivery\DeliveryStrategyInterface;
use Brick\Money\Money;

class DeliveryStrategy implements DeliveryStrategyInterface
{
    public function getDeliveryFee(Money $subtotal): Money
    {
        if ($subtotal->isLessThan(Money::of(50, '$'))) {
            return Money::of(4.95, '$');
        }

        if ($subtotal->isLessThan(Money::of(90, '$'))) {
            return Money::of(2.95, '$');
        }

        return Money::of(0, '$');
    }
}