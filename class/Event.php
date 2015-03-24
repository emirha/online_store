<?php

class Event {

    function __construct () {
        $this->products = array();
    }

    /**
     * @return string
     */
    public function getName () {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName ($name) {
        $this->name = $name;
    }

    /**
     * @return Product[]
     */
    public function getProducts () {
        return $this->products;
    }

    /**
     * @param Product[] $products
     */
    public function setProducts ($products) {
        $this->products = $products;
    }

    /**
     * @param Product[] $products
     */
    public function addProduct ($product) {
        $this->products = $product;
    }

    /**
     * @return ServiceFee
     */
    public function getServiceFee () {
        return $this->serviceFee;
    }

    /**
     * @param ServiceFee $serviceFee
     */
    public function setServiceFee ($serviceFee) {
        $this->serviceFee = $serviceFee;
    }

    public function getPrice () {
        $this->getServiceFee()->getAmount();
    }

    /**
     * @return int
     */
    public function getId () {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId ($id) {
        $this->id = $id;
    }


    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Product[]
     */
    private $products;

    /**
     * @var ServiceFee
     */
    private $serviceFee;
}