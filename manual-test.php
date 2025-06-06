<?php
require __DIR__ . '/vendor/autoload.php';

use App\Basket;
use App\Product;
use App\Delivery\DeliveryStrategy;
use Brick\Money\Money;

$products = [
    'B01' => new Product('B01', 'Blue Widget', Money::of(7.95, 'USD')),
    'G01' => new Product('G01', 'Green Widget', Money::of(24.95, 'USD')),
    'R01' => new Product('R01', 'Red Widget', Money::of(32.95, 'USD'))
];

$delivery = new DeliveryStrategy();

$basket = new Basket($products, $delivery);

$basket->setOffers(['BuyOneRedGetSecondHalfPriceOffer']);


// $basket->add('B01');
// $basket->add('G01');

// $basket->add('R01');
// $basket->add('R01');

// $basket->add('R01');
// $basket->add('G01');

$basket->add('B01');
$basket->add('B01');
$basket->add('R01');
$basket->add('R01');
$basket->add('R01');

echo $basket->total()->formatTo('en_US');