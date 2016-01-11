<?php
    namespace jefferson\teste\controller;
    use Core\Controller\ActionAbstract;
    use Container;
    class IndexController extends ActionAbstract {
        public function indexAction(){
            $this->createBlock('teste')
                 ->setTitle('teste')
                 ->setJs('script.js')
                 ->setCss('script.css')
                 ->setHead('<meta name="" content="">')
                 ->setHeader('')
                 ->setFooter('')
                 ->setData('teste')
                 ->setTemplate('template');


            echo Container::getHelper('Data')->testeData();


        }

    }

?>