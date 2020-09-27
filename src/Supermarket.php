<?php

namespace Supermarket;

class Supermarket
{
    private $items = [];

    private Catalog $catalog;

    private array $offers;

    /**
     * Supermarket Constructor
     */
    public function __construct(Catalog $catalog, array $offers)
    {
        $this->catalog = $catalog;
        $this->offers = $offers;
    }

    /**
     *  add input product to shop list
     *
     * @param string $productName
     * @return void
     */
    public function addProduct(string $productName)
    {
        if ($this->catalog->exists($productName)) {
            if (!isset($this->items[$productName])) {
                $this->items[$productName] = 0;
            }
            $this->items[$productName] += 1;
        }
    }

    /**
     *  get total price of shop list
     *
     *  @return int
     */
    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item => $count) {
            $unitPrice = $this->catalog->getPrice($item);
            if ($this->hasOffer($item, $count)) {
                $total -= $this->offers[$item]->getDiscount($count, $unitPrice);
            }
            $total += $unitPrice * $count;
        }
        return $total;
    }

    /**
     * check input item has any offer accordiing to count of item
     *
     * @param string $item
     * @param int $count
     * @return bool
     */
    protected function hasOffer(string $item, int $count): bool
    {
        return isset($this->offers[$item]);
    }
}
