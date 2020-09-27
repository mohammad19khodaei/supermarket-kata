<?php

namespace Supermarket;

use Exception;

class Catalog
{
    private $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function getPrice(string $productName)
    {
        if (!isset($this->products[$productName])) {
            throw new Exception('Product Not Found');
        }

        return $this->products[$productName];
    }

    /**
     * check input product exists in catalog
     *
     * @param string $productName
     * @return bool
     */
    public function exists(string $productName): bool
    {
        return isset($this->products[$productName]);
    }
}
