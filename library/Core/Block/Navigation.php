<?php

    namespace Core\Block;
    use \Container;

    trait Navigation{

        private $nav;
        private $menu;
        private $rt;

        /**
         * Pega os itens declarados nos módulos
         */
        public function navigation(){

            foreach(Container::getViewModules() as $filename){

                $pathModule = simplexml_load_file(Container::getConfig()->path->path_register.'/'.$filename);

                $module     = str_replace('_','/',(string)$pathModule->modules->name);

                $pathConfig = Container::getConfig()->path->path_modules.'/'.$module.Container::getConfig()->path->path_config;

                $config = simplexml_load_file($pathConfig);

                foreach($config->frontend->menu as $item0){

                    foreach($item0 as $item1){
                        $menu[] = array(
                            'name'  => (string)$item1->name,
                            'url'   => Container::getConfig()->path->url.'/'.(string)strtolower($config->frontend->router->name.'/'.(string)$item1->controller),
                            'title' => (string)$item1->title,
                            'child' => (string)$item1->child,
                            'disabled' => (string)$item1->disabled
                        );
                    }

                }
            }

            return self::getMenu(self::formatMenu($menu, ''));

        }


        /**
         * Formata o menu
         * @param unknown $tree
         * @param unknown $parent
         * @return multitype:unknown
         */
        public function formatMenu($tree, $parent){
            $tree2 = array();
            foreach($tree as $i => $item){
                if($item['child'] == $parent){
                    $tree2[$item['name']] = $item;
                    $tree2[$item['name']]['submenu'] = self::formatMenu($tree, $item['name']);
                }
            }
            return $tree2;
        }

        /**
         * Formata o html do menu
         * @param unknown $array
         * @return string
         */
        public function getMenu($array)
        {

            if(empty($this->rt)){
                $class="menu";

                $this->rt = 1;
            }else{
                $class="";
            }

            $this->menu .=  '<ul class="'.$class.'" >';

            foreach($array as $nav)
            {

                if(empty($nav['disabled'])){
                    $this->menu .= '<li>';
                    $this->menu .= '<a href="'.$nav['url'].'">'.$nav['title'].'</a>';
                    if(count($nav['submenu']) >0){
                        self::getMenu($nav['submenu']);
                    }
                    $this->menu .=  '</li>';
                }
            }

            $this->menu .=  '</ul>';

            return $this->menu;
        }


    }