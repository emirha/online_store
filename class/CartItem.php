<?php

class CartItem {

    /**
     * @param Product $product
     * @param         $count
     */
    function __construct (Product $product, $count) {
        $this->count   = $count;
        $this->product = $product;
    }

    /**
     * @return Product
     */
    public function getProduct() {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct($product) {
        $this->product = $product;
    }

    /**
     * @return float
     */
    public function getSubTotal() {
        return $this->product->getPrice()*$this->count;
    }

    /**
     * @return string
     */
    public function getReadableSubTotal() {
        return $this->product->getServiceFee()->getCurrency().' '.number_format($this->getSubTotal(),2,',','.');
    }


    /**
     * @return int
     */
    public function getCount () {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount ($count) {
        $this->count = $count;
    }

    /**
     * @var Product
     */
    private $product;

    /**
     * @var int
     */
    private $count;

}