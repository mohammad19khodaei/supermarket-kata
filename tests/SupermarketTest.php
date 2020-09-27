<?php

use PHPUnit\Framework\TestCase;
use Supermarket\Catalog;
use Supermarket\Offer\OfferPercent;
use Supermarket\Offer\OfferXforY;
use Supermarket\Supermarket;

class SupermarketTest extends TestCase
{

    /**
     * @dataProvider getItemsTestCase
     */
    public function testItemsTotalPrice(string $items, float $expectedPrice)
    {
        $supermarket = new Supermarket(
            new Catalog([
                'A' => 50,
                'B' => 30,
                'C' => 20,
                'D' => 100
            ]),
            [
                'A' => new OfferXforY(3, 130),
                'B' => new OfferXforY(2, 45),
                'D' => new OfferPercent(30)
            ]
        );

        foreach (str_split($items) as $item) {
            $supermarket->addProduct($item);
        }

        $this->assertEquals($expectedPrice, $supermarket->getTotal());
    }

    /**
     * test cases
     */
    public function getItemsTestCase()
    {
        return [
            'no items' => ['', 0],
            'A' => ['A', 50],
            'AA' => ['AA', 100],
            'AB' => ['AB', 80],
            'BB' => ['BB', 45],
            'ABAB' => ['ABAB', 145],
            'AAA' => ['AAA', 130],
            'ABABA' => ['ABABA', 175],
            'D' => ['D', 70],
            'BADDBBBBAAAAAA' => ['BADDBBBBAAAAAA', 140+120+310]
        ];
    }
}
