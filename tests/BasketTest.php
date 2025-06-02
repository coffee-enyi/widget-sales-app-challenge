<?php

use PHPUnit\Framework\TestCase;
use App\Basket;
use App\Product;
use App\Delivery\DeliveryStrategy;
use App\Offer\OfferStrategy;
use Brick\Money\Money;

class BasketTest extends TestCase
{
    /** @var array<Product> */
    private array $catalogue;

    protected function setUp(): void
    {
        $this->catalogue = [
            'R01' => new Product('R01', 'Red Widget', Money::of(32.95, 'USD')),
            'G01' => new Product('G01', 'Green Widget', Money::of(24.95, 'USD')),
            'B01' => new Product('B01', 'Blue Widget', Money::of(7.95, 'USD')),
        ];
    }

    private function basket(): Basket
    {
        return new Basket(
            $this->catalogue,
            new DeliveryStrategy(),
            new OfferStrategy()
        );
    }

    public function testB01AndG01(): void
    {
        $basket = $this->basket();
        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals('37.85', $basket->total()->getAmount()->__toString());
    }

    public function testR01AndR01(): void
    {
        $basket = $this->basket();
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals('54.37', $basket->total()->getAmount()->__toString());
    }

    public function testR01AndG01(): void
    {
        $basket = $this->basket();
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEquals('60.85', $basket->total()->getAmount()->__toString());
    }

    public function testFiveItems(): void
    {
        $basket = $this->basket();
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals('98.27', $basket->total()->getAmount()->__toString());
    }
}