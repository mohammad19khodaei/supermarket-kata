<?php

namespace Supermarket\Offer;

interface OfferContract
{
    public function getDiscount(int $productCountInShopList, int $unitPrice);
}
