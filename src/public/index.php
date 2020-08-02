<?php

use TestWork\{Calculator, Cart};
use TestWork\discount\DiscountManager;
use TestWork\product\Product;
use TestWork\rule\{DiscountRule, SpecialDiscountRule, CountDiscountRule};

require_once __DIR__ . "/../vendor/autoload.php";

$A = new Product('A', 10);
$B = new Product('B', 10);
$C = new Product('C', 10);
$D = new Product('D', 10);
$E = new Product('E', 10);
$F = new Product('F', 10);
$G = new Product('G', 10);
$H = new Product('H', 10);
$I = new Product('I', 10);
$J = new Product('J', 10);
$K = new Product('K', 10);
$L = new Product('L', 10);
$M = new Product('M', 10);


$discountManager = new DiscountManager();
// The rule
$discountManager->add(new DiscountRule([$A, $B], 0.1));
$discountManager->add(new DiscountRule([$D, $E], 0.06));
$discountManager->add(new DiscountRule([$E, $F, $G], 0.03));
$discountManager->add(new SpecialDiscountRule($A, [$K, $L, $M], 0.05));
$discountManager->add(new CountDiscountRule(3, [$A, $C], 0.05));
$discountManager->add(new CountDiscountRule(4, [$A, $C], 0.1));
$discountManager->add(new CountDiscountRule(5, [$A, $C], 0.2));

$calculator = new Calculator();
$calculator->setDiscountManager($discountManager);


$cart = new Cart();
$cart->addProduct($A);
$cart->addProduct($B);

$calculator->setOrder($cart);
$res = $calculator->calculate();

echo  $res;
