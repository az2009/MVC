<?php

    namespace jefferson\teste\model;
    use \Core\Model\ModelAbstract;

    class Teste extends ModelAbstract{

        public function getData(){

            $stm = $this->prepare('SELECT * FROM teste WHERE id =?');
            $stm->bindValue(1,'7');
            $stm->execute();
            return $stm->fetchAll(self::FETCH_ASSOC);

        }

    }
?>