<?php


namespace TestWork\rule;


use TestWork\discount\DiscountResult;
use TestWork\Cart;
use TestWork\discount\OrderItem;
use TestWork\rule\base\AbstractDiscount;

class OrderCountDiscount extends AbstractDiscount
{
    /**
     * @var int
     */
    protected int $count;

    /**
     * @var array
     */
    protected iterable $excludeProductSet;

    /**
     * @param $count
     * @param array $excludeProductSet
     * @param $discount
     */
    public function __construct(int $count, array $excludeProductSet, float $discount)
    {
        parent::__construct($discount);
        $this->count = $count;
        $this->excludeProductSet = $excludeProductSet;
    }

    public function calculate(Cart $order) : array
    {
        $count = 0;
        foreach ($order->getCart() as $item) {
            if (!$this->isItemExcluded($item)) {
                ++$count;
            }
        }
        if ($count === $this->count) {
            $total = $order->sum();
            return [new DiscountResult($this, [], $total * $this->discount)];
        }
        return [];
    }

    protected function isItemExcluded(OrderItem $item) : bool
    {
        foreach ($this->excludeProductSet as $exclude) {
            if ($item->equalTo($exclude)) {
                return true;
            }
        }
        return false;
    }

}