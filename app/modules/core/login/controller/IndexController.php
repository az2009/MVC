<?php

    namespace core\navigation\controller;
    use \Core\Controller\ActionAbstract;
    use \Container;

    class IndexController extends ActionAbstract {

        public function indexAction(){

            $this->createBlock('navigationblock')->setTemplate('template');


        }


    }

?>