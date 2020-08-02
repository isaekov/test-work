<?php


namespace TestWork\rule;


use TestWork\discount\DiscountResult;
use TestWork\Cart;
use TestWork\product\ProductInterface;
use TestWork\rule\base\AbstractDiscount;

class DiscountRule extends AbstractDiscount
{
    /**
     * @var ProductInterface[]
     */
    protected array $productSet;

    /**
     * DiscountRule constructor.
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
    public function calculate(Cart $order): array
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
            $keyPosition = $this->findProduct($product, $productSet);
            if ($keyPosition === false) {
                return false;
            }
            $productSet[$keyPosition]->setUsedDiscount(true);
            $productsSum += $productSet[$keyPosition]->getProduct()->getPrice();
            $products[] = $productSet[$keyPosition];
            unset($productSet[$keyPosition]);
        }
        $qty = $productsSum * $this->discount;
        return new DiscountResult($this, $products, $qty);
    }
}