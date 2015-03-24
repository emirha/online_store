<?php

class EventTest extends PHPUnit_Framework_TestCase {

    function testAddProduct() {
        $event = new Event();

        $this->assertEmpty($event->getProducts());

        $event->addProduct(new Product(1,'Name'));
        $this->assertEquals(1,count($event->getProducts()));
    }

    function testSetPrice() {
        $event = new Event();
        $fee = new ServiceFee(3,'EUR');
        $event->setServiceFee($fee);
        $this->assertEquals($event->getServiceFee(),$fee);
    }

}