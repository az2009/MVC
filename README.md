Estrutura MVC basedo na estrutura de Rota/Módulos/Container do magento.

Install

Arquivo de configuração
 - app/Config/application.xml

Configurações

 <config>

    - Nao preciso explicar né
	<connections>
		<host>localhost</host>
		<user>user</user>
		<pass>pass</pass>
		<dbname>db</dbname>
		<charset>SET NAMES utf8</charset>
		<type>mysql</type>
	</connections>

	<path>
	 - Url da aplicação
		<url>http://example.com/mvc</url>

	 - Nome da pasta onde é registrado os módulos
		<path_register>register</path_register>

	 - Nome da pasta onde fica os controllers
		<path_controller>controller</path_controller>

	 - Caminho da pasta onde fica os módulos
		<path_modules>app/modules</path_modules>

	 - Caminho do árquivo de configuração do módulo
		<path_config>/etc/config.xml</path_config>

	 - Sufixo do método dos controllers
		<name_action>Action</name_action>

	 - Sufixo dos árquivos de controller
		<name_controller>Controller</name_controller>

	 - Extensão dos árquivos do módulo
		<ext_file>.php</ext_file>

	 - Mensagem de quando um controller não é encontrado
		<controller_not_found_msg>Controller não encontrado</controller_not_found_msg>

	 - Mensagem de quando uma rota não é encontrada
		<router_not_found_msg>Rota não encontrada</router_not_found_msg>

	 - Nome da pasta que vai as view dos módulos
		<path_view>view</path_view>

	 - Caminho do layout default da aplicação
		<path_layout>app/layout/Layout.phtml</path_layout>

     - Extensão dos árquivos de template
		<ext_file_view>.phtml</ext_file_view>

	 - Rota default:ex
	   http://exemplo.com.br/
	   A rota informa em baixo sera o primeiro módulo que a aplicação irá chamar quando for iniciada
		<router_default>index</router_default>

	</path>

</config>

Declarando um módulo

  - Crie uma árquivo xml com a seguinte estrutura: namespace_nome-do-modulo.xml
    ex: register/exemplo_ex.xml

  - Cria a estrutura do seu módulo em:
     app/modules/ex
      	app/modules/exemplo/ex/block/
      	app/modules/exemplo/ex/controller/
      	app/modules/exemplo/ex/etc/
      	app/modules/exemplo/ex/helper/
      	app/modules/exemplo/ex/model/
      	app/modules/exemplo/ex/view/

    Dentro da pasta modules existe dois módulos de exemplo.

 Estrutura da URL

   http://dominio.com.br/rota/controller/action/id/5/nome/teste
    - rota: rota declarada no arquivo de config do módulo
    - controller do módulo
    - action do módulo
      - Parametros
        id = 5
        nome = teste

         chamada:
           $this->getParam('id') : retorna int 5
           $this->getParams() : retorna Array


           Mais métodos do core, estão nas pastas library/Core/
           													Block - BlockAbstract
           													Controller - ActionAbstract
           													Helper - DataAbstract
           													Model - ModelAbstract

			Exemplo:
					 declarando um controller

			class IndexController extends ActionAbstract {
				public function indexAction(){}
			}


					 Chamando model/helper/view
					 Container::getModel('exemplo');
					 Container::getHelper('exemplo');

					 Chamando a view
					    $this->createBlock('teste') - attr nome block
			                 ->setTitle('teste') - Título da página
			                 ->setJs('script.js') - Inserindo JS
			                 ->setCss('script.css') - Inserindo CSS
			                 ->setHead('<meta name="" content="">')  - HTML extra
			                 ->setHeader('') - Inserindo um valor extra no header
			                 ->setFooter('') - Inserindo um valor extra no footer
			                 ->setTemplate('template'); - Chamando a view


		 Na estrutura toda a regra de negócio vai dentro dos blocos de layout e não no controller
		 as view tem acesso direto ao seu respectivo block através do $this.

		 Enviando um valor para a view:

		No block:

			  $valor = array('ex' => 1);

			  $this->createBlock('teste')
			  	   ->setData($valor)
			       ->setTemplate('template');


		Na view:
			$array = $this->getData();
			var_dump($array) = array('ex' => 1);

		Model

		 A Model extende direto do PDO




































