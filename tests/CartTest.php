<?php

class CartTest extends PHPUnit_Framework_TestCase {

    public function testAddItem() {
        $cart = new Cart();

        $product = $this->product();
        $cartItem = new CartItem($product,2);

        $cart->addItem($cartItem);

        $this->assertNotEmpty($cart->getItems());
    }

    public function testTwoSameArticles() {
        $cart = new Cart();

        $product = $this->product();
        $cartItem = new CartItem($product,1);
        $cart->addItem($cartItem);

        $cartItem = new CartItem($product,1);
        $cart->addItem($cartItem);

        $this->assertEquals(1,count($cart->getItems()));

    }

    public function testClearCart() {
        $cart = new Cart();

        $product1 = $this->product();
        $product2 = $this->product();

        $cartItem = new CartItem($product1,1);
        $cart->addItem($cartItem);

        $cartItem = new CartItem($product2,1);
        $cart->addItem($cartItem);

        $cart->clearCart();

        $this->assertEmpty($cart->getItems());
    }

    public function testCartTotal() {
        $cart = new Cart();

        $product1 = $this->product();
        $product2 = $this->product();

        $cartItem1 = new CartItem($product1,1);
        $cart->addItem($cartItem1);

        $cartItem2 = new CartItem($product2,1);
        $cart->addItem($cartItem2);

        $this->assertEquals(10,$cart->getTotal());
    }

    private function product($price = 5, $id = 1) {
        return new Product($id,'Name',new ServiceFee($price,'EUR'));
    }
}
