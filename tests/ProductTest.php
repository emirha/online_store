<?php

class ProductTest extends PHPUnit_Framework_TestCase {

    function testProductPrice() {
        $product = new Product(1,'Name',new ServiceFee(5,'EUR'));
        $this->assertEquals($product->getPrice(),5);
    }

    function testPriceFromEvent() {

        $event = new Event();
        $event->setServiceFee(new ServiceFee(4,'EUR'));

        $product = new Product(1,'Name');
        $product->setName('Product Name');

        $event->addProduct($product);

        $this->assertEquals(4,$product->getPrice($event));
    }

    function testFullPrice() {
        $event = new Event();
        $event->setServiceFee(new ServiceFee(4,'EUR'));

        $product = new Product(1,'Name');

        $event->addProduct($product);
        $this->assertEquals('EUR 4,00',$product->getReadablePrice($event));
    }
}
