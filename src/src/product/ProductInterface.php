<?php


namespace TestWork\product;

/**
 * Describes a product instance
 * @package TestWork\product
 */
interface ProductInterface
{
    public function getId(): string;

    public function getPrice(): float;

}