<?php

namespace Supermarket;

class Supermarket
{
    private $items = [];

    private $catalog = [];

    private $offers = [];

    public function __construct(array $catalog, array $offers)
    {
        $this->catalog = $catalog;
        $this->offers = $offers;
    }

    public function addItem(string $item)
    {
        if (!isset($this->items[$item])) {
            $this->items[$item] = 0;
        }
        $this->items[$item] += 1;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item => $count) {
            if ($this->hasOffer($item, $count)) {
                $total += -1 * (intdiv($count, $this->offers[$item][0]) * ($this->offers[$item][0] * $this->catalog[$item] - $this->offers[$item][1]));
            }
            $total += ($this->catalog[$item] ?? 0) * $count;
        }
        return $total;
    }

    protected function hasOffer($item, $count): bool
    {
        return isset($this->offers[$item]) && $count >= $this->offers[$item][0];
    }
}
