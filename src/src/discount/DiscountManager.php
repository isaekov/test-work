<?php


namespace TestWork\discount;


use TestWork\Cart;
use TestWork\rule\base\AbstractDiscount;

class DiscountManager
{

    protected iterable $discounts;

    public function add(AbstractDiscount $discount)
    {
        $this->discounts[] = $discount;
    }

    public function getPossibleDiscounts(Cart $order)
    {
        $discounts = [];
        foreach ($this->discounts as $discount) {
            $result = $discount->calculate($order);
            $discounts = array_merge($discounts, $result);
        }
        return $discounts;
    }
}