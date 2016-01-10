<?php

    namespace Core\Model\Connections;
    use \PDO;
    use \Container;

    class Connect extends \PDO{

        private $type;
        private $host;
        private $dbname;
        private $pass;
        private $user;
        private $charset;

        final public function __construct(){
            self::getConfigDb();

            parent::__construct(
                "$this->type:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->pass",
                array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "$this->charset"
                      ));
        }

        /**
         * Pega as config do banco
         */
        private function getConfigDb(){
            $this->type     = Container::getConfig()->connections->type;
            $this->host     = Container::getConfig()->connections->host;
            $this->dbname   = Container::getConfig()->connections->dbname;
            $this->pass     = Container::getConfig()->connections->pass;
            $this->user     = Container::getConfig()->connections->user;
            $this->charset  = Container::getConfig()->connections->charset;
        }

    }
















?>