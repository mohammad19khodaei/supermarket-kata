<?php

namespace Supermarket\Offer;

class OfferXforY implements OfferContract
{
    /**
     * @var string
     */
    private int $price;

    /**
     * @var int
     */
    private int $count;

    /**
     * OfferXforY Constructor
     */
    public function __construct(int $count, int $price)
    {
        $this->count = $count;
        $this->price = $price;
    }

    /**
     * get discount for the offer
     *
     * @param int $productCountInShopList
     * @param int $unitPrice
     * @return int
     */
    public function getDiscount(int $productCountInShopList, int $unitPrice)
    {
        $discount = 0;
        if ($productCountInShopList >= $this->count) {
            $discount = intdiv($productCountInShopList, $this->count) * ($this->count * $unitPrice - $this->price);
        }
        return $discount;
    }
}
