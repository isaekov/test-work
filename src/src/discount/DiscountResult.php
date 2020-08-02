<?php

namespace TestWork\discount;

use TestWork\rule\base\AbstractDiscount;

class DiscountResult
{

    protected AbstractDiscount $discount;

    protected array $products;

    protected int $discountQty;

    public function __construct(AbstractDiscount $discount, array $products, $discountQty = 0)
    {
        $this->discount = $discount;
        $this->products = $products;
        $this->discountQty = $discountQty;
    }

    public function getDiscountQty() : int
    {
        return $this->discountQty;
    }

}