<?php

class Db {

    private static $instance;

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var PDOStatement
     */
    private $query;

    /**
     * @return PDO
     */
    public function getPdo () {
        return $this->pdo;
    }

    /**
     * @return Db
     */
    public static function getInstance() {
        if (empty(self::$instance))
            self::$instance = new Db();

        return self::$instance;
    }

    private function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=emir_paylogic', 'emir_paylogic','mChUMRMt');
    }

    /**
     * @param $queryString
     *
     * @return $this
     */
    public function prepare($queryString) {
        $this->query = $this->pdo->prepare($queryString);
        return $this;
    }

    /**
     * @param array $params
     *
     * @return $this
     */
    public function addParams(array $params) {
        foreach ($params as $k => $v ) {
            $this->query->bindParam(':'.$k,$v);
        }
        return $this;
    }

    /**
     * @param $className
     *
     * @return array
     */
    public function load($className = '') {
        $execute = $this->query->execute();

        if ($execute) {
            if ($className)
                $result = $this->query->fetchAll(PDO::FETCH_CLASS,$className);
            else
                $result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            $this->query = null;

            return $result;
        }
    }
}