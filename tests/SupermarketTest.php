<?php

use PHPUnit\Framework\TestCase;
use Supermarket\Supermarket;

class SupermarketTest extends TestCase
{

    /**
     * @dataProvider getItemsTestCase
     */
    public function testItemsTotalPrice(string $items, float $expectedPrice)
    {
        $supermarket = new Supermarket(
            [
                'A' => 50,
                'B' => 30,
                'C' => 20,
                'D' => 15
            ],
            [
                'A' => [3, 130],
                'B' => [2,45]
            ]
        );

        foreach (str_split($items) as $item) {
            $supermarket->addItem($item);
        }

        $this->assertEquals($expectedPrice, $supermarket->getTotal());
    }

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
            'ABABA' => ['ABABA', 175]
        ];
    }
}
