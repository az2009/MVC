<?php

    namespace Core\Controller;
    use \Container;

    abstract class ActionAbstract {

        /**
         * Retorna o bloco do template
         * @param unknown $block
         * @return mixed
         */
        public function createBlock($block){
            return Container::createBlock($block);
        }

        /**
         * Retorna um parametro especifico via get
         * @param unknown $param
         * @return unknown
         */
        public function getParam($param){
            return Container::getParam($param);
        }

        /**
         * Retorna todos os parametros get
         * @param unknown $params
         * @return unknown
         */
        public function getParams(){
            return Container::getParams();
        }

        /**
         * Chamada quando invocado um método inexistente
         * @param unknown $name
         * @param unknown $arguments
         */
        public function __call($name, $arguments){
            echo "O metodo invocado nao existe: \"$name \" ";
        }

    }


?>