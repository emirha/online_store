<?php

class CartItemTest extends PHPUnit_Framework_TestCase {

    function testAddProduct() {
        $cartItem = new CartItem($this->product(),2);

        $this->assertNotEmpty($cartItem->getProduct());
    }

    function testSubTotal() {
        $cartItem = new CartItem($this->product(),2);

        $this->assertEquals(10,$cartItem->getSubTotal());
    }

    private function product($price = 5, $id = 1) {
        return new Product($id,'Name',new ServiceFee($price,'EUR'));
    }
}
