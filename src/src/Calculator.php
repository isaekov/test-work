<?php

namespace TestWork;

use TestWork\discount\DiscountManager;

class Calculator
{

    protected Cart $order;

    protected DiscountManager $discountManager;

    public function setOrder(Cart $order) : void
    {
        $this->order = $order;
    }

    public function setDiscountManager(DiscountManager $discountManager) : void
    {
        $this->discountManager = $discountManager;
    }


    public function calculate() : int
    {
        $totalDiscount = 0;
        $totalSum = $this->order->sum();
        $discounts = $this->discountManager->getPossibleDiscounts($this->order);
        foreach ($discounts as $discount) {
            $totalDiscount += $discount->getDiscountQty();
        }
        return $totalSum - $totalDiscount;
    }
}