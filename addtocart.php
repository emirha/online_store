<?php

include 'bootstrap.php';

$productFactory = new ProductFactory();
$product = $productFactory->get($_GET['product']);

$cart = new Cart();
$cart->addItem(new CartItem($product,1));

header('Location: index.php');