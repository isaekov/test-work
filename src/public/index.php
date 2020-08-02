<?php

use TestWork\Calculator;

use TestWork\discount\DiscountManager;
use TestWork\Cart;
use TestWork\product\Product;
use TestWork\rule\DiscountRule;
use TestWork\rule\SpecialDiscountRule;
use TestWork\rule\CountDiscountRule;

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
$discountManager->add(new DiscountRule([$productA, $productB], 0.1));
$discountManager->add(new DiscountRule([$productD, $productE], 0.05));
$discountManager->add(new DiscountRule([$productE, $productF, $productM], 0.05));
$discountManager->add(new SpecialDiscountRule($productA, [$productK, $productL, $productM], 0.05));
$discountManager->add(new CountDiscountRule(3, [$productA, $productC], 0.05));
$discountManager->add(new CountDiscountRule(4, [$productA, $productC], 0.1));
$discountManager->add(new CountDiscountRule(5, [$productA, $productC], 0.2));

$calculator = new Calculator();
$calculator->setDiscountManager($discountManager);


$cart = new Cart();
$cart->addProduct($productA);
$cart->addProduct($productD);
$cart->addProduct($productE);
$cart->addProduct($productB);
$cart->addProduct($productA);
$cart->addProduct($productD);
$cart->addProduct($productD);

$calculator->setOrder($cart);
$res = $calculator->calculate();

echo  $res;
