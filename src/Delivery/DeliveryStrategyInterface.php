<?php

namespace App\Delivery;

use Brick\Money\Money;

interface DeliveryStrategyInterface
{
    public function getDeliveryFee(Money $subtotal): Money;
}