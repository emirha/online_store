<?php

class ServiceFee {

    /**
     * @param $amount
     * @param $currency
     */
    function __construct ($amount, $currency) {
        $this->amount   = $amount;
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getAmount () {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount ($amount) {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency () {
        return strtoupper($this->currency);
    }

    /**
     * @param string $currency
     */
    public function setCurrency ($currency) {
        $this->currency = $currency;
    }

    /**
     * @var float
     */
    private $amount;
    /**
     * @var string
     */
    private $currency;

}