<?php

    namespace Core\Block;
    use \Container;

    abstract class BlockAbstract{
        use Navigation;

        public $data;
        public $css;
        public $js;
        public $title;
        public $content;
        public $html;
        public $footer;
        public $header;

        /**
         * Renderiza as views
         * @param unknown $view
         */


        public function setTemplate($view){
            $path = Container::getConfig()->path->path_modules.'/'.Container::getPathModule($view).'/'.Container::getConfig()->path->path_view.'/'.$view.Container::getConfig()->path->ext_file_view;

            if(file_exists($path)){

                $this->content = $path;

            }else{
                $this->content = "View não encontrada";
            }

            require_once(Container::getConfig()->path->path_layout);
        }

        public function setData($data){
            $this->data = $data;
            return $this;
        }

        public function getData(){
            return $this->data;
        }

        public function setTitle($title){
            $this->title = "<title>".$title.'</title>';
            return $this;
        }

        public function setCss($css){
            $this->css .= "<link rel='stylesheet' type='text/css' href=".$css." >";
            return $this;
        }

        public function setJs($js){
            $this->js .= "<script type='text/javascript' src='".$js."'></script>";
            return $this;
        }

        public function setHead($html){
            $this->html .= $html;
            return $this;
        }

        public function setFooter($footer){
            $this->footer .= $footer;
            return $this;
        }

        public function setHeader($header){
            $this->header .= $header;
            return $this;
        }

        public function getContent(){

            if(file_exists($this->content)){
                require_once $this->content;
            }else{
                echo $this->content;
            }

        }
























    }
?>