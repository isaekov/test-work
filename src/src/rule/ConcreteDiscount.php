<?php


namespace TestWork\rule;


use TestWork\discount\DiscountResult;
use TestWork\Cart;
use TestWork\rule\base\AbstractDiscount;

class ConcreteDiscount extends AbstractDiscount
{
    /**
     * @var array|iterable
     */
    protected iterable $productSet;

    /**
     * ConcreteDiscount constructor.
     * @param array $productSet
     * @param float $discount
     */
    public function __construct(array $productSet, float $discount)
    {
        parent::__construct($discount);
        $this->productSet = $productSet;
    }

    /**
     * @param Cart $order
     * @return array
     */
    public function calculate(Cart $order) : array
    {
        $results = [];
        do {
            $result = $this->findDiscount($order);
            if ($result === false) {
                break;
            }
            $results[] = $result;
        } while (true);
        return $results;
    }

    /**
     * @param Cart $order
     * @return bool|DiscountResult
     */
    protected function findDiscount(Cart $order)
    {
        $productsSum = 0;
        $products = [];
        $productSet = $order->getCart();
        foreach ($this->productSet as $product) {
            $k = $this->findProduct($product, $productSet);
            if ($k === false) {
                return false;
            }
            $productSet[$k]->setUsedDiscount(true);
            $productsSum += $productSet[$k]->getProduct()->getPrice();
            $products[] = $productSet[$k];
            unset($productSet[$k]);
        }
        $qty = $productsSum * $this->discount;
        return new DiscountResult($this, $products, $qty);
    }
}