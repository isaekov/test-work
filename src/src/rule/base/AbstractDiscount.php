<?php

namespace TestWork\rule\base;

use TestWork\Cart;
use TestWork\discount\OrderItem;
use TestWork\product\ProductInterface;

abstract class AbstractDiscount
{

    protected float $discount;

    public function __construct($discount)
    {
        $this->discount = $discount;
    }

    /**
     * @param Cart $order
     * @return mixed
     */
    abstract public function calculate(Cart $order);

    /**
     * @param ProductInterface $product
     * @param OrderItem[] $list
     * @return bool|int|string
     */
    protected function findProduct(ProductInterface $product, array $list)
    {
        foreach ($list as $key => $item) {
            if ($item->equalTo($product) && !$item->getUsedDiscount()) {
                return $key;
            }
        }
        return false;
    }

}