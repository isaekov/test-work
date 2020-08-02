<?php

namespace TestWork\product;


class Product implements ProductInterface
{
    protected string $id;

    protected float $price;

    public function __construct(string $id, float $price)
    {
        $this->id = $id;
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getId(): string
    {
        return $this->id;
    }
}