<?php

namespace TestWork\discount;

use TestWork\product\ProductInterface;

class OrderItem
{

    private ProductInterface $product;

    private bool $usedDiscount;

    function __construct(ProductInterface $product)
    {
        $this->product = $product;
        $this->usedDiscount = false;
    }


    public function getProduct(): ProductInterface
    {
        return $this->product;
    }


    public function setUsedDiscount($usedDiscount): void
    {
        $this->usedDiscount = $usedDiscount;
    }

    public function getUsedDiscount(): bool
    {
        return $this->usedDiscount;
    }

    public function equalTo(ProductInterface $product): bool
    {
        return $this->product instanceof $product;
    }
}