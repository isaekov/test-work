<?php


namespace TestWork\rule;


use TestWork\Cart;
use TestWork\discount\DiscountResult;
use TestWork\product\ProductInterface;
use TestWork\rule\base\AbstractDiscount;

class SpecialDiscountRule extends AbstractDiscount
{

    protected ProductInterface $product;

    protected array $productSet;

    public function __construct(ProductInterface $product, array $productSet, float $discount)
    {
        parent::__construct($discount);
        $this->product = $product;
        $this->productSet = $productSet;
    }

    /**
     * @param Cart $order
     * @return array|mixed
     */
    public function calculate(Cart $order)
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

    protected function findDiscount(Cart $order)
    {
        $products = [];
        $k2 = false;
        $productSet = $order->getCart();
        $k1 = $this->findProduct($this->product, $productSet);
        if ($k1 === false) {
            return false;
        }

        foreach ($this->productSet as $product) {
            $k2 = $this->findProduct($product, $productSet);
            if ($k2 !== false) {
                break;
            }
        }
        if ($k2 === false) {
            return false;
        }

        $productSet[$k1]->setUsedDiscount(true);
        $productSet[$k2]->setUsedDiscount(true);

        $products[] = $productSet[$k1];
        $products[] = $productSet[$k2];

        unset($productSet[$k1]);
        unset($productSet[$k2]);

        $productsSum = $products[0]->getPrice() + $products[1]->getPrice();
        $qty = $productsSum * $this->discount;

        return new DiscountResult($this, $products, $qty);
    }

}