<?php

include 'bootstrap.php';

$cart = new Cart();
$cart->clearCart();

header('Location: index.php');