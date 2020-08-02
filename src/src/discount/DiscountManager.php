<?php


namespace TestWork\discount;

use TestWork\Cart;
use TestWork\rule\base\AbstractDiscount;

class DiscountManager
{

    /**
     * @var AbstractDiscount[]
     */
    protected array $discounts;

    public function add(AbstractDiscount $discount): void
    {
        $this->discounts[] = $discount;
    }


    /**
     * @param Cart $order
     * @return DiscountResult[]
     */
    public function getPossibleDiscounts(Cart $order): array
    {
        $discounts = [];
        foreach ($this->discounts as $discount) {
            $result = $discount->calculate($order);
            $discounts = array_merge($discounts, $result);
        }
        return $discounts;
    }
}