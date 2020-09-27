<?php

namespace Supermarket\Offer;

class OfferPercent implements OfferContract
{
    /**
     * @var $percent
     */
    private float $percent;

    /**
     * OfferPercent Constructor
     */
    public function __construct(float $percent)
    {
        $this->percent = $percent;
    }

    public function getDiscount(int $productCountInShopList, int $unitPrice)
    {
        return $productCountInShopList * $unitPrice * $this->percent / 100;
    }
}
