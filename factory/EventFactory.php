<?php

class EventFactory {

    function __construct () {
        $this->db = Db::getInstance();
    }

    /**
     * @return Event[]
     */
    public function getAll() {
        $resultData = array();

        $dbEvents = $this->db->prepare($this->selectQuery())->load();

        foreach ($dbEvents as $dbEvent) {
            $resultData[] = $this->createEvent($dbEvent);
        }

        return $resultData;
    }

    /**
     * @param $id
     *
     * @return Event
     */
    public function get($id) {
        $dbEvents = $this->db->prepare($this->selectQuery().' WHERE events.id = :event_id LIMIT 1')
                             ->addParams(array('event_id' => $id))
                             ->load();

        return $this->createEvent($dbEvents[0]);
    }

    private function createEvent($dbEvent) {
        $event = new Event();
        $event->setName($dbEvent['name']);
        $event->setId($dbEvent['id']);
        if ($dbEvent['amount']) {
            $event->setServiceFee(new ServiceFee($dbEvent['amount'],$dbEvent['code']));
        }

        return $event;
    }

    /**
     * @return string
     */
    private function selectQuery() {
        $selectQuery = 'SELECT events.*, event_fees.amount, currencies.code, currencies.title FROM events
                                  LEFT OUTER JOIN event_fees ON event_fees.event_id = events.id
                                  LEFT OUTER JOIN currencies ON currencies.id = event_fees.currency_id';

        return $selectQuery;
    }

    private $db;

}