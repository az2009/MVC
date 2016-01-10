<?php
    final class Container {

        /**
         * Pega a URL current
         * @return array
         */
        final public static function getUrl()
        {

            $url   = explode('/', $_GET['url']);

            $pos = array_search('index.php', $url);

            if($pos === 0){
                unset($url[$pos]);
            }

            $url = self::orderUrl($url);

            return $url;
        }


        /**
         * Ordena o array
         * @param unknown $array
         * @return unknown
         */
        final public static function orderUrl($array = Array()){
            foreach($array as $item){
                $data[] = $item;
            }
            return $data;
        }



        /**
         * Pega todos os parametros da url
         * @return unknown
         */

        final public static function getParams()
         {
            $param   = self::getUrl();

            $y=0;while($y <= 2){
                unset($param[$y]);
                $y++;
            }

            foreach($param as $t ){
                $p[] = array($t);
            }

            $r=0;
            while($r <= count($p)){

                $par[$p[$r][0]] = $p[$r + 1][0];

                $r += 2;
            }

            return array_filter($par);
        }

        /**
         * Pega um parametro especifico
         */

        final public static function getParam($key) {
            $param = self::getParams();
            return $param[$key];
        }

        /**
         * Pega os seguintes parametros da url router|action|controller
         * @return multitype:unknown array
         */
        final public static function getRouter(){
            $url = self::getUrl();

            $path = array(
                'route'      => $url[0],
                'controller' => $url[1],
                'action'     => $url[2],
            );

            if(empty($path['route'])){
                $path['route'] =self::getConfig()->path->router_default;
            }


            return $path;
        }

        /**
         * Pega os módulos instalados
         * @return array
         */
        final public static function getViewModules(){
            $dir = scandir(self::getConfig()->path->path_register);
            unset($dir[0]);
            unset($dir[1]);
            return $dir;
        }

        /**
         * Pega os controllers dos módulos
         * @return multitype:string
         */
        final public static function getController(){

            foreach(self::getViewModules() as $filename){

                $pathModule = simplexml_load_file(self::getConfig()->path->path_register.'/'.$filename);

                $module     = str_replace('_','/',(string)$pathModule->modules->name);

                $pathConfig = self::getConfig()->path->path_modules.'/'.$module.self::getConfig()->path->path_config;

                $config = simplexml_load_file($pathConfig);

                $controller[] = array(
                    'router' => (string)strtolower($config->frontend->router->name),
                    'path'   => $module.'/'.self::getConfig()->path->path_controller,
                    'path_module'  => array(
                        'router'   => (string)strtolower($config->frontend->router->name),
                        'path_dir' => $module

                    )
                );

            }

            return $controller;
        }

        /**
         * Pega a pool do módulo
         * @param unknown $key
         * @return unknown
         */
        final public static function getPathModule(){
            $data = self::getController();
            foreach($data as $item){
                if($item['path_module']['router'] == self::getRouter()['route']){
                    $pool = $item['path_module']['path_dir'];
                }
            }
            return $pool;
        }

        /**
         * Redireciona para a rota especifica
         */
        final public static function router() {

            $ctr = 0;

            $path = self::getRouter();

            foreach(self::getController() as $data){

                if(in_array(strtolower($path['route']), $data )){


                    if(!empty($path['controller'])){
                        $route  = ucfirst(strtolower($path['controller']));
                    }else{
                        $route  = ucfirst('index');
                    }

                    if(!empty($path['action'])){
                        $action = strtolower($path['action']).self::getConfig()->path->name_action;
                    }else{
                        $action = 'index'.self::getConfig()->path->name_action;
                    }

                    /**
                     * Verifica se o controller existe
                     */
                    if(file_exists(self::getConfig()->path->path_modules.'/'.$data['path'].'/'.$route.self::getConfig()->path->name_controller.self::getConfig()->path->ext_file)){

                        $namespace =  str_replace('/','\\','\\'.$data['path'].'/'.$route.self::getConfig()->path->name_controller);

                        $obj = new $namespace;

                        return $obj->$action();

                    }else{
                        echo self::getConfig()->path->controller_not_found_msg;
                    }

                    $ctr++;

                }
            }
            /**
             * Verifica se a rota existe
             */
            if(!$ctr > 0){
                echo self::getConfig()->path->router_not_found_msg;
            }

        }

        /**
         * Instancia o objeto da model
         * @param unknown $model
         * @return mixed
         */
        final public static function getModel($model){
            $fileClass = self::getConfig()->path->path_modules.'/'. self::getPathModule().'/model/'.ucfirst($model).self::getConfig()->path->ext_file;
            if(file_exists($fileClass)){

                $model = str_replace('/', '\\', self::getPathModule().'/model/'.ucfirst($model));
                $obj = new $model();
                return $obj;

            }

        }

        /**
         * Instancia o objeto da helper
         * @param unknown $helper
         * @return mixed
         */
        final public static function getHelper($helper){
            $fileClass = self::getConfig()->path->path_modules.'/'.self::getPathModule().'/helper/'.ucfirst($helper).self::getConfig()->path->ext_file;
            if(file_exists($fileClass)){

                $helper = str_replace('/', '\\', self::getPathModule().'/helper/'.ucfirst($helper));
                $obj = new $helper();
                return $obj;

            }

        }


        /**
         * Instancia o objeto do Block
         * @param unknown $helper
         * @return mixed
         */

        final public static function createBlock($block){
            $fileClass = self::getConfig()->path->path_modules.'/'.self::getPathModule().'/block/'.ucfirst($block).self::getConfig()->path->ext_file;
            if(file_exists($fileClass)){

                $block = str_replace('/', '\\', self::getPathModule().'/block/'.ucfirst($block));
                $obj = new $block();
                return $obj;

            }

        }

        /**
         * Pega as configurações do banco
         */

        final public static function getConfig(){
            $file = "app/Config/application.xml";

            $fileConfig = simplexml_load_file($file);

            return $fileConfig;
        }


    }













?>