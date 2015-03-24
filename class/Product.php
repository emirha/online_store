<?php

class Product {

    function __construct ($id, $name, $serviceFee = null) {
        $this->id         = $id;
        $this->name       = $name;
        $this->serviceFee = $serviceFee;
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

    /**
     * @param Event $event
     *
     * @return float
     *
     * To reduce number of calls to database it is possible to send
     * $event argument, if it is not possible it must be loaded
     * when there is no fee for product in order to calculate product price
     *
     */
    public function getPrice(Event $event = null) {
        if (empty($this->serviceFee)) {
            if (null == $event) {
                $eventFactory = new EventFactory();
                $event = $eventFactory->get($this->event_id);
            }
            $this->setServiceFee($event->getServiceFee());
        }

        return $this->serviceFee->getAmount();
    }

    public function getReadablePrice(Event $event = null) {
        $price = $this->getPrice($event);

        return $this->getServiceFee()->getCurrency().' '.number_format($price,2,',','.');
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
     * @return int
     */
    public function getEventId () {
        return $this->event_id;
    }

    /**
     * @param int $event_id
     */
    public function setEventId ($event_id) {
        $this->event_id = $event_id;
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
     * @var ServiceFee
     */
    private $serviceFee;

    /**
     * @var int
     */
    private $event_id;

}