<?php


namespace TestWork;


use TestWork\discount\OrderItem;
use TestWork\product\Product;

class Cart
{

    /**
     * @var OrderItem[]
     */
    protected array $cart;

    /**
     * @return OrderItem[]
     */
    public function getCart(): array
    {
        return $this->cart;
    }

    public function addProduct(Product $product): void
    {
        $this->cart[] = new OrderItem($product);
    }

    public function sum(): int
    {
        $sum = 0;
        foreach ($this->cart as $product) {
            $sum += $product->getProduct()->getPrice();
        }
        return $sum;
    }
}