<?php

class ServiceFeeTest extends PHPUnit_Framework_TestCase {

    function testConstructor() {
        $fee = new ServiceFee(5,'Eur');

        $this->assertEquals(5,$fee->getAmount());
        $this->assertEquals('EUR',$fee->getCurrency());
    }
}
