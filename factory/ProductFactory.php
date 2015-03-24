<?php

/**
 * Class ProductFactory
 */
class ProductFactory {

    /**
     * @param Event $event
     */
    function __construct(Event $event = null) {
        $this->event = $event;
        $this->db = Db::getInstance();
    }

    /**
     * @return Product[]
     */
    public function getAll() {
        $resultData = array();

        $whereQuery = '';
        if ($this->event) {
            $whereQuery = 'WHERE products.event_id = :event_id ';
        }

        $this->db->prepare($this->selectQuery().' '.$whereQuery);

        if ($this->event) {
            $this->db->addParams(array('event_id' => $this->event->getId()));
        }

        $dbProducts = $this->db->load();

        foreach ($dbProducts as $dbProduct) {
            $resultData[] = $this->createProduct($dbProduct);
        }

        return $resultData;
    }


    /**
     * @param $id
     *
     * @return Product
     */
    public function get($id) {
        $dbProducts = $this->db->prepare($this->selectQuery().' WHERE products.id = :product_id LIMIT 1')
            ->addParams(array('product_id' => $id))
            ->load();

        return $this->createProduct($dbProducts[0]);
    }

    /**
     * @return string
     */
    private function selectQuery() {
        $selectQuery = 'SELECT products.*, product_fees.amount, currencies.code, currencies.title FROM products
                        LEFT OUTER JOIN product_fees ON product_fees.product_id = products.id
                        LEFT OUTER JOIN currencies ON currencies.id = product_fees.currency_id';

        return $selectQuery;
    }

    /**
     * @param $dbProduct
     *
     * @return Product
     */
    private function createProduct($dbProduct) {
        $product = new Product($dbProduct['id'], $dbProduct['name']);
        $product->setEventId($dbProduct['event_id']);

        if ($dbProduct['amount']) {
            $product->setServiceFee(new ServiceFee($dbProduct['amount'],$dbProduct['code']));
        }

        return $product;
    }

    /**
     * @var Event
     */
    private $event;

}