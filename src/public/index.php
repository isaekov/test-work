<?php

use TestWork\Calculator;

use TestWork\discount\DiscountManager;
use TestWork\Cart;
use TestWork\product\Product;
use TestWork\rule\ConcreteDiscount;
use TestWork\rule\ConcreteProductWithDiscount;
use TestWork\rule\OrderCountDiscount;

require_once __DIR__ . "/../vendor/autoload.php";


$productA = new Product('A', 100);
$productB = new Product('B', 100);
$productC = new Product('C', 100);
$productD = new Product('D', 100);
$productE = new Product('E', 100);
$productF = new Product('F', 100);
$productG = new Product('G', 100);
$productH = new Product('H', 100);
$productI = new Product('I', 100);
$productJ = new Product('J', 100);
$productK = new Product('K', 100);
$productL = new Product('L', 100);
$productM = new Product('M', 100);



$discountManager = new DiscountManager();
$discountManager->add(new ConcreteDiscount([$productA, $productB], 0.1));
$discountManager->add(new ConcreteDiscount([$productD, $productE], 0.05));
$discountManager->add(new ConcreteDiscount([$productE, $productF, $productM], 0.05));
$discountManager->add(new ConcreteProductWithDiscount($productA, [$productK, $productL, $productM], 0.05));
$discountManager->add(new OrderCountDiscount(3, [$productA, $productC], 0.05));
$discountManager->add(new OrderCountDiscount(4, [$productA, $productC], 0.1));
$discountManager->add(new OrderCountDiscount(5, [$productA, $productC], 0.2));




$calculator = new Calculator();
$calculator->setDiscountManager($discountManager);


$order = new Cart();
$order->add($productA);
$order->add($productA);
$order->add($productD);
$order->add($productE);
$order->add($productB);
$order->add($productA);
$order->add($productD);
$order->add($productD);

$calculator->setOrder($order);
$res = $calculator->calculate();

echo  $res;
