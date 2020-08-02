<?php


namespace TestWork;


use TestWork\discount\OrderItem;
use TestWork\product\Product;

class Cart
{

    /**
     * @var OrderItem[]
     */
    protected iterable $cart;

    /**
     * @return OrderItem[]
     */
    public function getCart() : iterable
    {
        return $this->cart;
    }

    public function add(Product $product) : void
    {
        $this->cart[] = new OrderItem($product);
    }

    public function sum() : int
    {
        $sum = 0;
        foreach ($this->cart as $product) {
            $sum += $product->getProduct()->getPrice();
        }
        return $sum;
    }
}